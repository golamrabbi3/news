<?php

namespace App\Http\Controllers\Api\Settings;

use App\Enums\MediaPath;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Settings\SettingRequest;
use App\Models\Setting;
use App\Services\AppSettings;
use App\Services\FileService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            return response()->json([
                'message' => __('Fetched settings successfully.'),
                'data' => [
                    'configurations' => config('settings'),
                    'values' => AppSettings::get()
                ],
            ]);
        } catch (Exception $exception) {
            report($exception);
        }

        return response()->json([
            'message' => __('Failed to fetch settings! Please try again.'),
        ], 400);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SettingRequest $request, string $section): JsonResponse
    {
        try {
            $parameters = $request->validated();

            if (!empty($request->allFiles())) {
                foreach ($request->allFiles() as $attribute => $file) {
                    $parameters[$attribute] = FileService::upload(
                        file: $file,
                        path: MediaPath::Settings,
                        fileName: $attribute,
                        suffix: $section,
                        disk: 'public',
                    );
                }
            }

            $values = Arr::map($parameters, function (string $value, string $key) {
                return ['key' => $key, 'value' => $value];
            });

            Setting::upsert(
                values: $values,
                uniqueBy: 'key',
                update: ['value']
            );

            AppSettings::set();

            return response()->json([
                'message' => __('Settings are updated successfully.'),
            ]);
        } catch (Exception $exception) {
            report($exception);
        }

        return response()->json([
            'message' => __('Failed to update the settings'),
        ], 400);
    }
}

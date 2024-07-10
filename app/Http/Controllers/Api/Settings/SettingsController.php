<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Settings\SettingRequest;
use App\Models\Setting;
use App\Services\AppSettings;
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
                'data' => AppSettings::get(),
            ]);
        } catch (Exception $exception) {
            report($exception);
        }

        return response()->json([
            'message' => __('Failed to fetch settings! Please try again.'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SettingRequest $request, string $section): JsonResponse
    {
        // TODO::upload image if there is any image file.
        $values = Arr::map($request->validated(), function (string $value, string $key) {
            return ['key' => $key, 'value' => $value];
        });

        try {
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
        ]);
    }
}

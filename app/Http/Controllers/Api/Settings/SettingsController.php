<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Exception;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return response()->json([
                'message' => __('Fetched settings successfully.'),
                'data' => Setting::pluck('value', 'key'),
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
    public function store(Request $request)
    {
        try {
            Setting::updateOrCreate($request->all());

            return response()->json([
                'message' => __('Settings are updated successfully.'),
            ]);
        } catch (Exception $exception) {
            report($exception);
        }

        return response()->json([
            'message' => __('Settings are updated successfully.'),
        ]);
    }
}

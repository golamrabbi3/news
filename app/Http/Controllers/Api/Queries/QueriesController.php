<?php

namespace App\Http\Controllers\Api\Queries;

use App\Enums\PaginatedNumber;
use App\Http\Controllers\Controller;
use App\Http\Resources\Queries\QueryCollection;
use App\Http\Resources\Queries\QueryResource;
use App\Models\Query;
use Exception;

class QueriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = new QueryCollection(
                Query::latest()->paginate(PaginatedNumber::Queries)
            );

            return response()->json([
                'message' => __('Fetched query list successfully.'),
                'data' => $data->response()->getData(true),
            ]);
        } catch (Exception $e) {
            report($e);
        }

        return response()->json([
            'message' => __('Failed to fetch query list.'),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Query $query)
    {
        return response()->json([
            'message' => __('Fetched query successfully.'),
            'data' => new QueryResource($query),
        ]);
    }
}

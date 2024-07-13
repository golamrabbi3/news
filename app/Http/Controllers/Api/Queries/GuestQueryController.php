<?php

namespace App\Http\Controllers\Api\Queries;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Query\QueryRequest;
use App\Mail\Api\Query\QueryMail;
use App\Models\Query;
use App\Services\AppSettings;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class GuestQueryController extends Controller
{
    public function __invoke(QueryRequest $request): JsonResponse
    {
        try {
            $query = Query::create($request->validated());
            Mail::to(AppSettings::get('company_email'))
                ->send(new QueryMail($query));

            return response()->json([
                'message' => __('The query has been sent successfully. We will reply soon, Thanks.'),
            ]);
        } catch (Exception $exception) {
            report($exception);
        }

        return response()->json([
            'message' => __('Failed to send the query! Please try again.'),
        ]);
    }
}

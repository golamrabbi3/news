<?php

namespace App\Http\Controllers\Api\Notifications;

use App\Enums\PaginatedNumber;
use App\Http\Controllers\Controller;
use App\Http\Resources\Notifications\NotificationCollection;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;

class NotificationsController extends Controller
{
    public function index($status = null): JsonResponse
    {
        try {
            $user = request()->user();
            $data = (new NotificationCollection(
                $status == 'unread' ?
                $user->unreadNotifications()->latest()->paginate(PaginatedNumber::UnreadNotifications) :
                $user->notifications()->latest()->paginate(PaginatedNumber::Notifications)
            ));

            return response()->json([
                'message' => __('Fetched notification list successfully.'),
                'data' => $data->response()->getData(true),
            ]);
        } catch(Exception $exception) {
            report($exception);
        }

        return response()->json([
            'message' => __('Failed to fetch notifications! Please try again.')
        ], 400);
    }

    public function markAsRead(string $id = null): JsonResponse
    {
        try {
            request()->user()->unreadNotifications()
                ->when(!empty($id), function (Builder $builder) use ($id) {
                    return $builder->whereId($id);
                })->update(['read_at' => now()]);

            return response()->json([
                'message' => __('The notification(s) marked as read.')
            ]);
        } catch (Exception $exception) {
            report($exception);
        }

        return response()->json([
            'message' => __('Failed to make the notification(s) as read! Please try again.'),
        ], 400);
    }

    public function destroy(string $id = null): JsonResponse
    {
        try {
            request()->user()->notifications()
                ->when(!empty($id), function (Builder $builder) use ($id) {
                    return $builder->whereId($id);
                })->delete();

            return response()->json([
                'message' => __('The notification(s) deleted successfully.')
            ]);
        } catch (Exception $exception) {
            report($exception);
        }

        return response()->json([
            'message' => __('Failed to delete the notification(s)! Please try again.')
        ], 400);
    }
}

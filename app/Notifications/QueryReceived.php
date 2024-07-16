<?php

namespace App\Notifications;

use App\Models\Query;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class QueryReceived extends Notification
{
    use Queueable;

    public Query $query;

    /**
     * Create a new notification instance.
     */
    public function __construct(Query $query)
    {
        $this->query = $query;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }


    public function toDatabase(object $notifiable): array
    {
        return [
            'icon' => null,
            'title' => __('You got a new query'),
            'message' => __('An user just has sent an query through app query form.'),
            'action_url' => route('user.queries.show', $this->query->id),
        ];
    }
}

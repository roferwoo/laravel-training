<?php

namespace App\Http\Controllers\Api\V1;

use App\Transformers\NotificationTransformer;
use Illuminate\Notifications\DatabaseNotification as Notification;

class NotificationsController extends ApiController
{
    public function index()
    {
        $notifications = $this->user->notifications()->paginate(20);

        return $this->response->paginator($notifications, new NotificationTransformer());
    }

    public function stats()
    {
        return $this->response->array([
            'unread_count' => $this->user()->notification_count,
        ]);
    }

    // public function read()
    // {
    //     $this->user()->markAsRead();
    //
    //     return $this->response->noContent();
    // }

    public function read(Notification $notification)
    {
        $notification->id ? $this->user()->markAsRead($notification) : $this->user()->markAsRead();

        return $this->response->noContent();
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Transformers\NotificationTransformer;

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
}

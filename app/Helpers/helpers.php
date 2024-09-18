<?php

use App\Models\Notification;

function notification(string $type) : int
{
    return Notification::where('type', $type)->count();
}

function deleteNotification(string $type): void
{
    $notification = Notification::where('type', $type)->first();
    $notification->delete();
}

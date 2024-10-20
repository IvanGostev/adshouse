<?php

use App\Models\House;
use App\Models\Notification;
use App\Models\UserTariff;

function notification(string $type) : int
{
    if ($type == 'house') {
        return House::where('status', 'moderation')->count();
    }
    if ($type == 'link') {
        return UserTariff::where('status', 'moderation')->count();
    }
    return Notification::where('type', $type)->count();
}

function deleteNotification(string $type): void
{
    $notification = Notification::where('type', $type)->first();
    $notification->delete();
}

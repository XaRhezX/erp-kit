<?php

namespace App\Traits\Notifications;

use Illuminate\Notifications\RoutesNotifications;

trait Notifiable
{
	use HasDatabaseNotifications, RoutesNotifications;
}
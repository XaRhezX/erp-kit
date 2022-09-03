<?php

namespace App\Traits\Notifications;

use App\Models\Notification;

trait HasDatabaseNotifications
{
	/**
	 * Get the entity's notifications.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphMany
	 */
	public function notifications()
	{
		return $this->morphMany(Notification::class, 'notifiable')->latest();
	}

	/**
	 * Get the entity's read notifications.
	 *
	 * @return \Illuminate\Database\Query\Builder
	 */
	public function readNotifications()
	{
		return $this->notifications()->read();
	}

	/**
	 * Get the entity's unread notifications.
	 *
	 * @return \Illuminate\Database\Query\Builder
	 */
	public function unreadNotifications()
	{
		return $this->notifications()->unread();
	}
}
<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class BaseNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * BaseNotification constructor.
     */
    public function __construct()
    {
        $this->setQueueDefaults();
    }

    /**
     * Set the queue settings.
     *
     * @return  void
     */
    protected function setQueueDefaults()
    {
        $this->onQueue('notifications');
    }
}
<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;

/**
 * Абстрактный класс триггерного уведомления.
 */
abstract class TriggerNotification extends BaseNotification
{
    /**
     * Текст сообщения.
     *
     * @var string
     */
    protected string $message;

    /**
     * Инициализация.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setQueueDefaults();
    }

    /**
     * Получение каналов отправки уведомления.
     */
    public function via(): array
    {
        return ['mail'];
    }

    /**
     * Представление в виде email.
     *
     * @return MailMessage
     */
    abstract public function toMail(): MailMessage;
}

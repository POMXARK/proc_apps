<?php

namespace App\Notifications;

use App\Models\Stmt;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Отправка сообщения.
 */
final class StmtNotification  extends TriggerNotification
{
    /**
     * Заявка.
     *
     * @var Stmt
     */
    private Stmt $stmt;


    /**
     * Инициализация.
     */
    public function __construct(Stmt $stmt)
    {
        parent::__construct();
        $this->stmt = $stmt;
    }

    /**
     * Сборка письма.
     */
    public function toMail(): MailMessage
    {
        /** @var MailMessage $mailMessage */
        $mailMessage = app(MailMessage::class);

        return $mailMessage
            ->subject('Ответ по заявке:')
            ->from($this->stmt->email, $this->stmt->name)
            ->view('stmt', ['stmt' => $this->stmt]);
    }
}

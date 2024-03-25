<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property $id
 * @property $comment Комментарий
 * @property $email Почта
 * @property $name Имя пользователя
 * @property $message Сообщение пользователя
 */
class Stmt extends Model
{
    use HasFactory;
    use SoftDeletes;

    /** @var array */
    public $fillable = ['name', 'email', 'message', 'status', 'comment'];

    /** @var array */
    protected array $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Заявка не рассмотрена.
     */
    const STATUS_ACTIVE = 'Active';

    /**
     * Заявка рассмотрена.
     */
    const STATUS_RESOLVED = 'Resolved';
}

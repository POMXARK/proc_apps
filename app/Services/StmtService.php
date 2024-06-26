<?php

namespace App\Services;

use App\Models\Stmt;
use App\Notifications\StmtNotification;
use App\Repositories\StmtRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Notification;
use Tests\Services\StmtServiceTest;

/**
 * Сервис заявок.
 *
 * @see StmtServiceTest
 */
class StmtService
{
    /**
     * Репозиторий заявок.
     *
     * @var StmtRepositoryInterface
     */
    private StmtRepositoryInterface $stmtRepository;

    public function __construct(StmtRepositoryInterface $stmtRepository)
    {
        $this->stmtRepository = $stmtRepository;
    }

    /**
     * Все заявки с фильтрацией по статусу и дате.
     */
    public function search(?string $status, ?string $created_at, ?string $updated_at): Collection
    {
        return $this->stmtRepository->search($status, $created_at, $updated_at);
    }

    /**
     * Вернуть заявку.
     */
    public function findById(string $id): Stmt
    {
        return $this->stmtRepository->findById($id);
    }

    /**
     * Создание заявки.
     */
    public function create(array $data): Stmt
    {
        return $this->stmtRepository->createFromArray($data);
    }

    /**
     * Ответить на заявку.
     */
    public function update(Stmt $stmt, array $data): Stmt
    {
        $data['status'] = Stmt::STATUS_RESOLVED;
        $model = $this->stmtRepository->updateFromArray($stmt, $data);

        Notification::route('mail', $stmt->email)
            ->notify(app(StmtNotification::class, $stmt->toArray()));

        return $model;
    }

    /**
     * Удалить заявку.
     *
     * @throws Exception
     */
    public function delete(Stmt $stmt): void
    {
        $this->stmtRepository->delete($stmt);
    }
}

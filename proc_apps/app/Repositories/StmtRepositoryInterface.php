<?php

namespace App\Repositories;

use App\Models\Stmt;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;

/**
 * Интерфейс репозитория заявок.
 */
interface StmtRepositoryInterface
{
    /**
     * Поиск моделей.
     *
     * @return Collection
     */
    public function search(?string $status, ?string $created_at, ?string $updated_at): Collection;

    /**
     * Поиск модели по идентификатору.
     *
     * @throws QueryException
     */
    public function findById(string $id);

    /**
     * Создание из массива.
     *
     * @throws QueryException
     */
    public function createFromArray(array $data): Stmt;

    /**
     * Обновление из массива.
     *
     * @throws QueryException
     */
    public function updateFromArray(Stmt $stmt, array $data): Stmt;

    /**
     * Удаление модели.
     *
     * @throws Exception
     */
    public function delete(Stmt $stmt): void;
}

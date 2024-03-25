<?php

namespace App\Repositories;

use App\Models\Stmt;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;

class StmtRepository implements StmtRepositoryInterface
{
    /**
     * Поиск моделей.
     *
     * @return Collection
     */
    public function search(?string $status, ?string $created_at, ?string $updated_at): Collection
    {
        $query = Stmt::query();

        if ($status) {
            $query = $query->where('status', $status);
        }
        if ($created_at) {
            $query = $query->where('created_at','like', $created_at . '%');
        }
        if ($updated_at) {
            $query = $query->where('updated_at', 'like', $updated_at . '%');
        }

        return $query->get();
    }

    /**
     * Поиск модели по идентификатору.
     *
     * @throws QueryException
     */
    public function findById(string $id)
    {
        /** @var Stmt $stmt */
        return Stmt::query()->find($id);
    }

    /**
     * Создание из массива.
     *
     * @throws QueryException
     */
    public function createFromArray(array $data): Stmt
    {
        return Stmt::query()->create($data);
    }

    /**
     * Обновление из массива.
     *
     * @throws QueryException
     */
    public function updateFromArray(Stmt $stmt, array $data): Stmt
    {
        $stmt->update($data);

        return $stmt;
    }

    /**
     * Удаление модели.
     *
     * @throws Exception
     */
    public function delete(Stmt $stmt): void
    {
        $stmt->delete();
    }
}

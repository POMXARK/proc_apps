<?php

namespace Tests\Services;

use App\Models\Stmt;
use App\Services\StmtService;
use Exception;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * Тесты сервиса заявок.
 *
 * @group StmtService
 * @see StmtService
 */
final class StmtServiceTest  extends TestCase
{
    use DatabaseTransactions;

    /**
     * Успешная выборка заявок с фильтрацией.
     */
    public function testSearchFilterSuccess(): void
    {
        $stmtService = app(StmtService::class);
        $count = 5;
        $params = [
            'created_at' => '2024-03-24T10:22:29.000000Z',
            'updated_at' => '2024-03-24T10:22:29.000000Z',
            'status' => Stmt::STATUS_RESOLVED,
        ];
        Stmt::factory()->count($count)->create($params);

        $stmtService->search($params['created_at'], $params['updated_at'], $params['status']);

        $this->assertSame($count, Stmt::all()->count());
    }

    /**
     * Успешно вернуть заявку.
     */
    public function testFindByIdSuccess(): void
    {
        $stmtService = app(StmtService::class);
        $stmt = Stmt::factory()->create();

        $model = $stmtService->findById($stmt->id);

        $this->assertSame($model->id, $stmt->id);
    }

    /**
     * Успешное создание заявки.
     */
    public function testCreateSuccess(): void
    {
        $stmtService = app(StmtService::class);
        $data = [
            'name' => 'name',
            'email' => 'email@email.email',
            'message' => 'messages',
        ];

        $stmtService->create($data);

        $this->assertDatabaseHas('stmts', $data);
    }

    /**
     * Успешное обновление заявки.
     */
    public function testUpdateSuccess(): void
    {
        $stmtService = app(StmtService::class);
        $stmt = Stmt::factory()->create();
        $data = [
            'name' => 'name',
            'email' => 'email@email.email',
            'message' => 'messages',
        ];

        $stmtService->update($stmt, $data);

        $this->assertDatabaseHas('stmts', $data);
    }

    /**
     * Успешное удаление заявки.
     *
     * @throws Exception
     */
    public function testDeleteSuccess(): void
    {
        $stmtService = app(StmtService::class);
        $stmt = Stmt::factory()->create();

        $stmtService->delete($stmt);

        $this->assertSoftDeleted('stmts', ['id' => $stmt->id]);
    }
}

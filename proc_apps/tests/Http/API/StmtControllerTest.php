<?php

namespace Tests\Http\API;

use App\Models\Stmt;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

/**
 * Тесты контроллера для работы с заявками.
 *
 * @group StmtController
 * @see StmtController
 */
final class StmtControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Ошибка, если запрос выполняется неавторизованным пользователем.
     */
    public function testAuthError(): void
    {
        $this->withoutExceptionHandling();

        $this->expectException(AuthenticationException::class);

        $this->post(route('stmts.index'));
    }

    /**
     * Успешное получения заявок с предварительной фильтрацией.
     */
    public function testIndexFilterSuccess(): void
    {
        Sanctum::actingAs(User::factory()->create());
        $params = [
            'created_at' => '2024-03-24T10:22:29.000000Z',
            'updated_at' => '2024-03-24T10:22:29.000000Z',
            'status' => Stmt::STATUS_RESOLVED,
        ];
        Stmt::factory()->count(5)->create($params);

        $response = $this->get(route('stmts.index', $params));

        $response->assertOk();
    }

    /**
     * Успешное создание заявки.
     */
    public function testStoreSuccess(): void
    {
        Sanctum::actingAs(User::factory()->create());
        $data = [
            'name' => 'name',
            'email' => 'email@email.email',
            'message' => 'messages',
        ];

        $response = $this->post(route('stmts.store'), $data);

        $response->assertOk();
    }

    /**
     * Ошибка создание заявки.
     */
    public function testStoreError(): void
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();

        $this->expectException(ValidationException::class);

        $this->post(route('stmts.store'));
    }

    /**
     * Успешное обновление заявки.
     */
    public function testUpdateSuccess(): void
    {
        Notification::fake();
        Sanctum::actingAs(User::factory()->create());
        $stmt = Stmt::factory()->create();
        $data = [
            'name' => 'name',
            'email' => 'email@email.email',
            'message' => 'updated message',
            'comment' => 'comment',
        ];

        $response = $this->put(route('stmts.update', $stmt), $data);

        $response->assertOk();
    }

    /**
     * Ошибка обновление заявки.
     */
    public function testUpdateError(): void
    {
        Sanctum::actingAs(User::factory()->create());
        $stmt = Stmt::factory()->create();
        $this->withoutExceptionHandling();

        $this->expectException(ValidationException::class);

        $this->put(route('stmts.update', $stmt));
    }

    /**
     * Успешное получение заявки.
     */
    public function testShowSuccess(): void
    {
        Sanctum::actingAs(User::factory()->create());
        $stmt = Stmt::factory()->create();

        $response = $this->delete(route('stmts.show', $stmt));

        $response->assertOk();
    }

    /**
     * Успешное удаление заявки.
     */
    public function testDeleteSuccess(): void
    {
        Sanctum::actingAs(User::factory()->create());
        $stmt = Stmt::factory()->create();

        $response = $this->delete(route('stmts.update', $stmt));

        $response->assertOk();
    }
}

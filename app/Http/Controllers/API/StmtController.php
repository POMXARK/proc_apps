<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStmtRequest;
use App\Http\Requests\UpdateStmtRequest;
use App\Models\Stmt;
use App\Services\StmtService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\BodyParam;
use Tests\Http\API\StmtControllerTest;
use Throwable;

/**
 * Контролер заявки.
 *
 * @see StmtControllerTest
 */
#[Authenticated]
class StmtController extends Controller
{
    /**
     * Сервис заявок.
     *
     * @var StmtService
     */
    private StmtService $stmtService;

    public function __construct(StmtService $stmtService)
    {
        $this->stmtService = $stmtService;
    }

    /**
     * Все заявки с фильтрацией по статусу и дате.
     */
    public function index(Request $request): JsonResponse
    {
        return response()->json(['data' => $this->stmtService
            ->search(
                $request->query('status'),
                $request->query('created_at'),
                $request->query('updated_at'),
            )]);
    }

    /**
     * Создание заявки.
     */
    #[BodyParam("message", "string")]
    public function store(StoreStmtRequest $request): JsonResponse
    {
       return  response()->json(['data' =>  $this->stmtService->create($request->validated())]);
    }

    /**
     * Вернуть заявку.
     */
    public function show(Stmt $stmt): JsonResponse
    {
        return response()->json(['data' => $this->stmtService->findById($stmt->id)]);
    }

    /**
     * Обновить заявку.
     *
     * @throws Throwable
     */
    public function update(UpdateStmtRequest $request, Stmt $stmt): JsonResponse
    {
        return  response()->json(['data' =>  $this->stmtService->update($stmt, $request->validated())]);
    }

    /**
     * Удалить заявку.
     *
     * @throws Exception
     */
    public function destroy(Stmt $stmt): JsonResponse
    {
        $this->stmtService->delete($stmt);

        return response()->json(['status' => true]);
    }
}

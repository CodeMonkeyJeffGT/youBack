<?php
namespace App\Controller;

use App\Service\ColumnService;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * 学校控制器
 * 
 * @method JsonResponse list(ColumnService $ColumnService)
 */
class ColumnController extends Controller
{
    public function list(ColumnService $ColumnService): JsonResponse
    {
        
    }

    public function info($id, ColumnService $ColumnService): JsonResponse
    {

    }

    public function apply(ColumnService $ColumnService): JsonResponse
    {

    }

    public function updateInfo($id, ColumnService $ColumnService): JsonResponse
    {

    }
}

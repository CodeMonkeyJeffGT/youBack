<?php
namespace App\Controller;

use App\Service\FollowColumnService;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * 学校控制器
 * 
 * @method JsonResponse list(FollowColumnService $followColumnService)
 */
class FollowColumnController extends Controller
{
    public function list(FollowColumnService $followColumnService): JsonResponse
    {
        
    }

    public function info($id, FollowColumnService $followColumnService): JsonResponse
    {

    }

    public function apply(FollowColumnService $followColumnService): JsonResponse
    {

    }

    public function updateInfo($id, FollowColumnService $followColumnService): JsonResponse
    {

    }
}

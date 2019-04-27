<?php
namespace App\Controller;

use App\Service\FollowUserService;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * 学校控制器
 * 
 * @method JsonResponse list(FollowUserService $followUserService)
 */
class FollowUserController extends Controller
{
    public function list(FollowUserService $followUserService): JsonResponse
    {
        
    }
}

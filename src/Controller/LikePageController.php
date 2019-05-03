<?php
namespace App\Controller;

use App\Service\UserService;
use App\Service\LikePageService;
use App\Service\PageService;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * 学校控制器
 * 
 * @method JsonResponse list(SchoolService $schoolService)
 */
class LikePageController extends Controller
{
    public function number($pid, LikePageService $likePageService, PageService $pageService): JsonResponse
    {
        $page = $pageService->getPage($pid);
        if (empty($page)) {
            return $this->error(static::ERROR, '动态不存在');
        }
        $number = $likePageService->getNumber($page);
        return $this->success($number);
    }

    public function like($pid, LikePageService $likePageService, UserService $userService, PageService $pageService): JsonResponse
    {
        $checkRst = $this->checkParam('HEADER', array(
            static::TOKEN_NAME => array('type' => 'jwt', 'required' => false),
        ));
        if ($checkRst !== static::OK) {
            return $this->error($checkRst);
        }
        $user = $userService->getUser($this->params[static::TOKEN_NAME]['id']);
        if (is_null($user)) {
            return $this->error(static::ERROR, '用户不存在');
        }
        $page = $pageService->getPage($pid);
        if (empty($page)) {
            return $this->error(static::ERROR, '动态不存在');
        }
        $rst = $likePageService->like($user, $page);
        return $rst ? $this->success() : $this->error(static::ERROR, '点赞失败');
    }

    public function unlike($pid, LikePageService $likePageService, UserService $userService, PageService $pageService): JsonResponse
    {
        $checkRst = $this->checkParam('HEADER', array(
            static::TOKEN_NAME => array('type' => 'jwt', 'required' => false),
        ));
        if ($checkRst !== static::OK) {
            return $this->error($checkRst);
        }
        $user = $userService->getUser($this->params[static::TOKEN_NAME]['id']);
        if (is_null($user)) {
            return $this->error(static::ERROR, '用户不存在');
        }
        $page = $pageService->getPage($pid);
        if (empty($page)) {
            return $this->error(static::ERROR, '动态不存在');
        }
        $rst = $likePageService->unlike($user, $page);
        return $rst ? $this->success() : $this->error(static::ERROR, '取消点赞失败');
    }
}

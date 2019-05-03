<?php
namespace App\Controller;

use App\Service\UserService;
use App\Service\CollectPageService;
use App\Service\PageService;
use App\Service\LikePageService;
use App\Service\PageCommentService;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * 学校控制器
 * 
 * @method JsonResponse list(FollowColumnService $followColumnService)
 */
class CollectPageController extends Controller
{
    public function list(UserService $userService, CollectPageService $collectPageService, LikePageService $likePageService, PageCommentService $pageCommentService): JsonResponse
    {
        $checkRst = $this->checkParam('HEADER', array(
            static::TOKEN_NAME => array('type' => 'jwt', 'required' => false),
        ));
        if ($checkRst !== static::OK) {
            return $this->error($checkRst);
        }
        $user = $userService->getUser($this->params[static::TOKEN_NAME]['id']);
        if (empty($user)) {
            return $this->error(static::ERROR, '用户不存在');
        }
        $pages = $collectPageService->list($user);
        foreach ($pages as $key => $value) {
            $pages[$key] = array(
                'id' => $value->getPage()->getId(),
                'name' => $value->getPage()->getName(),
                'content' => $value->getPage()->getContent(),
                'user' => array(
                    'id' => $value->getPage()->getUser()->getId(),
                    'nickname' => $value->getPage()->getUser()->getNickName(),
                    'sex' => $value->getPage()->getUser()->getSex(),
                    'headpic' => $value->getPage()->getUser()->getHeadpic(),
                    'sign' => $value->getPage()->getUser()->getSign(),
                    'created' => $value->getPage()->getUser()->getCreated()->format('Y-m-d H:i:s'),
                    'school' => array(
                        'id' => $value->getPage()->getUser()->getSchool()->getId(),
                        'name' => $value->getPage()->getUser()->getSchool()->getName(),
                    ),
                ),
                'column' => array(
                    'name' => $value->getPage()->getAcolumn()->getName(),
                    'id' => $value->getPage()->getAcolumn()->getId(),
                    'type' => $value->getPage()->getAcolumn()->getType(),
                ),
                'created' => $value->getPage()->getCreated()->format('Y-m-d H:i:s'),
                'isLike' => ( ! empty($likePageService->checkLike($user, $value->getPage()))),
                'likeNum' => $likePageService->getNumber($value->getPage()),
                'commentNum' => $pageCommentService->getNumber($value->getPage()),
                'collectNum' => $collectPageService->getNumber($value->getPage()),
            );
        }
        return $this->success($pages);
    }

    public function collect($pid, UserService $userService, PageService $pageService, CollectPageService $collectPageService): JsonResponse
    {
        $checkRst = $this->checkParam('HEADER', array(
            static::TOKEN_NAME => array('type' => 'jwt', 'required' => false),
        ));
        if ($checkRst !== static::OK) {
            return $this->error($checkRst);
        }
        $user = $userService->getUser($this->params[static::TOKEN_NAME]['id']);
        if (empty($user)) {
            return $this->error(static::ERROR, '用户不存在');
        }
        $page = $pageService->getPage($pid);
        if (empty($page)) {
            return $this->error(static::ERROR, '动态不存在');
        }
        $rst = $collectPageService->collect($user, $page);
        return $rst ? $this->success() : $this->error(static::ERROR, '收藏失败');
    }

    public function uncollect($pid, UserService $userService, PageService $pageService, CollectPageService $collectPageService): JsonResponse
    {
        $checkRst = $this->checkParam('HEADER', array(
            static::TOKEN_NAME => array('type' => 'jwt', 'required' => false),
        ));
        if ($checkRst !== static::OK) {
            return $this->error($checkRst);
        }
        $user = $userService->getUser($this->params[static::TOKEN_NAME]['id']);
        if (empty($user)) {
            return $this->error(static::ERROR, '用户不存在');
        }
        $page = $pageService->getPage($pid);
        if (empty($page)) {
            return $this->error(static::ERROR, '动态不存在');
        }
        $rst = $collectPageService->uncollect($user, $page);
        return $rst ? $this->success() : $this->error(static::ERROR, '取消收藏失败');

    }
}
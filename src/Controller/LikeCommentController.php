<?php
namespace App\Controller;

use App\Service\UserService;
use App\Service\LikeCommentService;
use App\Service\PageCommentService;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * 学校控制器
 * 
 * @method JsonResponse list(SchoolService $schoolService)
 */
class LikeCommentController extends Controller
{
    public function number($cid, LikeCommentService $likeCommentService, UserService $userService, PageCommentService $pageCommentService): JsonResponse
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
        $comment = $pageCommentService->getComment($cid);
        if (empty($comment)) {
            return $this->error(static::ERROR, '动态不存在');
        }
        $isLike = ( ! empty($likeCommentService->checkLike($user, $comment)));
        $number = $likeCommentService->getNumber($comment);
        return $this->success(array(
            'number' => $number,
            'isLike' => $isLike,
        ));
    }

    public function like($cid, LikeCommentService $likeCommentService, UserService $userService, PageCommentService $pageCommentService): JsonResponse
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
        $comment = $pageCommentService->getComment($cid);
        if (empty($comment)) {
            return $this->error(static::ERROR, '动态不存在');
        }
        $rst = $likeCommentService->like($user, $comment);
        return $rst ? $this->success() : $this->error(static::ERROR, '点赞失败');
    }

    public function unlike($cid, LikeCommentService $likeCommentService, UserService $userService, PageCommentService $pageCommentService): JsonResponse
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
        $comment = $pageCommentService->getComment($cid);
        if (empty($comment)) {
            return $this->error(static::ERROR, '动态不存在');
        }
        $rst = $likeCommentService->unlike($user, $comment);
        return $rst ? $this->success() : $this->error(static::ERROR, '取消点赞失败');
    }
}

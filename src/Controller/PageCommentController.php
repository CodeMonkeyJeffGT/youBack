<?php
namespace App\Controller;

use App\Service\PageCommentService;
use App\Service\PageService;
use App\Service\UserService;
use App\Service\LikeCommentService;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * 学校控制器
 * 
 * @method JsonResponse list(PageCommentService $pageCommentService)
 */
class PageCommentController extends Controller
{
    public function list($pid, PageCommentService $pageCommentService, PageService $pageService, LikeCommentService $likeCommentService): JsonResponse
    {
        $page = $pageService->getPage($pid);
        if (empty($page)) {
            return $this->error(static::ERROR, '动态不存在');
        }
        $comments = $pageCommentService->list($page);
        foreach ($comments as $key => $value) {
            $comments[$key] = array(
                'id' => $value->getId(),
                'content' => $value->getContent(),
                'created' => $value->getCreated()->format('Y-m-d H:i:s'),
                'page' => $value->getPage()->getId(),
                'user' => array(
                    'id' => $value->getUser()->getId(),
                    'nickname' => $value->getUser()->getNickName(),
                    'sex' => $value->getUser()->getSex(),
                    'headpic' => $value->getUser()->getHeadpic(),
                    'sign' => $value->getUser()->getSign(),
                    'created' => $value->getUser()->getCreated()->format('Y-m-d H:i:s'),
                    'school' => array(
                        'id' => $value->getUser()->getSchool()->getId(),
                        'name' => $value->getUser()->getSchool()->getName(),
                    ),
                ),
                'reply' => null,
                'father' => null,
                'like' => $likeCommentService->getNumber($value),
            );
            if ( ! is_null($value->getFather())) {
                $comments[$key]['father'] = array(
                    'id' => $value->getFather()->getId(),
                );
                if ( ! is_null($value->getReply())) {
                    $comments[$key]['reply'] = array(
                        'id' => $value->getReply()->getId(),
                        'nickname' => $value->getReply()->getNickName(),
                    );
                }
            }
        }
        return $this->success($comments);
    }

    public function publish($pid, PageCommentService $pageCommentService, PageService $pageService, UserService $userService): JsonResponse
    {
        $checkRst = $this->checkParam('HEADER', array(
            static::TOKEN_NAME => array('type' =>  'jwt', 'required' => false),
        ));
        if ($checkRst !== static::OK) {
            return $this->error($checkRst);
        }
        $checkRst = $this->checkParam('JSON', array(
            'content' => array('type' => 'string'),
            'reply' => array('type' => 'number', 'required' => false, 'default' => null),
            'father' => array('type' => 'number', 'required' => false, 'default' => null),
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
        $reply = null;
        $father = $this->params['father'];
        if ( ! is_null($father)) {
            $father = $pageCommentService->getComment($this->params['father']);
            $reply = $this->params['reply'];
            if ( ! is_null($reply)) {
                $reply = $userService->getUser($this->params['reply']);
            }
        }
        $comment = $pageCommentService->publish($user, $page, $this->params['content'], $reply, $father);
        $comment = array(
            'id' => $comment->getId(),
            'content' => $comment->getContent(),
            'created' => $comment->getCreated()->format('Y-m-d H:i:s'),
        );
        return $this->success($comment);
    }

    public function delete($pid, $cid, PageCommentService $pageCommentService, PageService $pageService, UserService $userService): JsonResponse
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
            return $this->error(static::ERROR, '评论不存在');
        }
        $pageCommentService->deleteComment($comment);
        return $this->success();
    }
}

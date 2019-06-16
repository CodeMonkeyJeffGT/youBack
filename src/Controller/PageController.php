<?php
namespace App\Controller;

use App\Service\UserService;
use App\Service\PageService;
use App\Service\ColumnService;
use App\Service\ColumnClassificationService;
use App\Service\LikePageService;
use App\Service\PageCommentService;
use App\Service\CollectPageService;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * 学校控制器
 * 
 * @method JsonResponse list(PageService $pageService)
 */
class PageController extends Controller
{
    public function others($uid, PageService $pageService, UserService $userService, ColumnService $columnService, ColumnClassificationService $columnClassificationService, LikePageService $likePageService, PageCommentService $pageCommentService, CollectPageService $collectPageService): JsonResponse
    {
        $checkRst = $this->checkParam('HEADER', array(
            static::TOKEN_NAME => array('type' => 'jwt', 'required' => false),
        ));
        if ($checkRst !== static::OK) {
            return $this->error($checkRst);
        }
        $this->checkParam('GET', array(
            'lastId' => array('type' => 'number', 'required' => false, 'default' => 0),
            'limit' => array('type' => 'number', 'required' => false, 'default' => 20),
        ));
        $user = $userService->getUser($uid);
        $pages = $pageService->userPages($user, $this->params['lastId'], $this->params['limit']);
        foreach ($pages as $key => $value) {
            $pages[$key] = array(
                'id' => $value->getId(),
                'name' => $value->getName(),
                'content' => $value->getContent(),
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
                'column' => array(
                    'name' => $value->getAcolumn()->getName(),
                    'id' => $value->getAcolumn()->getId(),
                    'type' => $value->getAcolumn()->getType(),
                ),
                'created' => $value->getCreated()->format('Y-m-d H:i:s'),
                'isLike' => $likePageService->checkLike($user, $value),
                'isCollect' => $collectPageService->checkCollect($user, $value),
                'likeNum' => $likePageService->getNumber($value),
                'commentNum' => $pageCommentService->getNumber($value),
                'collectNum' => $collectPageService->getNumber($value),
            );
        }
        return $this->success($pages);
    }

    public function mine(PageService $pageService, UserService $userService, ColumnService $columnService, ColumnClassificationService $columnClassificationService, LikePageService $likePageService, PageCommentService $pageCommentService, CollectPageService $collectPageService): JsonResponse
    {
        $checkRst = $this->checkParam('HEADER', array(
            static::TOKEN_NAME => array('type' => 'jwt', 'required' => false),
        ));
        if ($checkRst !== static::OK) {
            return $this->error($checkRst);
        }
        $this->checkParam('GET', array(
            'lastId' => array('type' => 'number', 'required' => false, 'default' => 0),
            'limit' => array('type' => 'number', 'required' => false, 'default' => 20),
        ));
        $user = $userService->getUser($this->params[static::TOKEN_NAME]['id']);
        $pages = $pageService->userPages($user, $this->params['lastId'], $this->params['limit']);
        foreach ($pages as $key => $value) {
            $pages[$key] = array(
                'id' => $value->getId(),
                'name' => $value->getName(),
                'content' => $value->getContent(),
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
                'column' => array(
                    'name' => $value->getAcolumn()->getName(),
                    'id' => $value->getAcolumn()->getId(),
                    'type' => $value->getAcolumn()->getType(),
                ),
                'created' => $value->getCreated()->format('Y-m-d H:i:s'),
                'isLike' => $likePageService->checkLike($user, $value),
                'isCollect' => $collectPageService->checkCollect($user, $value),
                'likeNum' => $likePageService->getNumber($value),
                'commentNum' => $pageCommentService->getNumber($value),
                'collectNum' => $collectPageService->getNumber($value),
            );
        }
        return $this->success($pages);
    }

    public function info($id, PageService $pageService, UserService $userService, ColumnService $columnService, ColumnClassificationService $columnClassificationService, LikePageService $likePageService, PageCommentService $pageCommentService, CollectPageService $collectPageService): JsonResponse
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
        $page = $pageService->info($id);
        $page = array(
            'id' => $page->getId(),
            'name' => $page->getName(),
            'content' => $page->getContent(),
            'user' => array(
                'id' => $page->getUser()->getId(),
                'nickname' => $page->getUser()->getNickName(),
                'sex' => $page->getUser()->getSex(),
                'headpic' => $page->getUser()->getHeadpic(),
                'sign' => $page->getUser()->getSign(),
                'created' => $page->getUser()->getCreated()->format('Y-m-d H:i:s'),
                'school' => array(
                    'id' => $page->getUser()->getSchool()->getId(),
                    'name' => $page->getUser()->getSchool()->getName(),
                ),
            ),
            'column' => array(
                'name' => $page->getAcolumn()->getName(),
                'id' => $page->getAcolumn()->getId(),
                'type' => $page->getAcolumn()->getType(),
            ),
            'created' => $page->getCreated()->format('Y-m-d H:i:s'),
            'isLike' => $likePageService->checkLike($user, $page),
            'isCollect' => $collectPageService->checkCollect($user, $page),
            'likeNum' => $likePageService->getNumber($page),
            'commentNum' => $pageCommentService->getNumber($page),
            'collectNum' => $collectPageService->getNumber($page),
        );
        return $this->success($page);
    }

    public function list(PageService $pageService, UserService $userService, ColumnService $columnService, ColumnClassificationService $columnClassificationService, LikePageService $likePageService, PageCommentService $pageCommentService, CollectPageService $collectPageService): JsonResponse
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
        $this->checkParam('GET', array(
            'columnId' => array('type' => 'number', 'required' => false, 'default' => null),
            'classId' => array('type' => 'number', 'required' => false, 'default' => null),
            'sp' => array('type' => 'string', 'required' => false, 'default' => ''),
            'query' => array('type' => 'string', 'required' => false, 'default' => ''),
            'lastId' => array('type' => 'number', 'required' => false, 'default' => 0),
            'limit' => array('type' => 'number', 'required' => false, 'default' => 20),
        ));
        if ( ! empty($this->params['columnId'])) {
            $column = $columnService->getColumn($this->params['columnId']);
            if (empty($column)) {
                return $this->error(static::ERROR, '版块不存在');
            }
        } elseif ($this->params['columnId'] === 0) {
            $column = 0;
        } elseif ($this->params['columnId'] === null) {
            $column = null;
        }
        if ( ! empty($this->params['classId'])) {
            $columnClass = $columnClassificationService->getClass($this->params['classId']);
            if (empty($columnClass)) {
                return $this->error(static::ERROR, '分类不存在');
            }
        } elseif ($this->params['classId'] === 0) {
            $columnClass = 0;
        } elseif ($this->params['classId'] === null) {
            $columnClass = null;
        }
        $pages = $pageService->list($column, $columnClass, $this->params['query'], $this->params['lastId'], $this->params['limit']);
        foreach ($pages as $key => $value) {
            $pages[$key] = array(
                'id' => $value->getId(),
                'name' => $value->getName(),
                'content' => $value->getContent(),
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
                'column' => array(
                    'name' => $value->getAcolumn()->getName(),
                    'id' => $value->getAcolumn()->getId(),
                    'type' => $value->getAcolumn()->getType(),
                ),
                'created' => $value->getCreated()->format('Y-m-d H:i:s'),
                'isLike' => $likePageService->checkLike($user, $value),
                'isCollect' => $collectPageService->checkCollect($user, $value),
                'likeNum' => $likePageService->getNumber($value),
                'commentNum' => $pageCommentService->getNumber($value),
                'collectNum' => $collectPageService->getNumber($value),
            );
        }
        return $this->success($pages);
    }

    public function publish(PageService $pageService, UserService $userService, ColumnService $columnService, ColumnClassificationService $columnClassificationService): JsonResponse
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
        $checkRst = $this->checkParam('JSON', array(
            'columnId' => array('type' => 'number'),
            'classId' => array('type' => 'number', 'required' => false, 'default' => null),
            'name' => array('type' => 'string'),
            'content' => array('type' => 'string'),
        ));
        if ($checkRst !== static::OK) {
            return $this->error($checkRst);
        }
        $column = $columnService->getColumn($this->params['columnId']);
        if (empty($column)) {
            return $this->error(static::ERROR, '版块不存在');
        }
        if ( ! empty($this->params['classId'])) {
            $columnClass = $columnClassificationService->getClass($this->params['classId']);
            if (empty($columnClass)) {
                return $this->error(static::ERROR, '分类不存在');
            }
        } else {
            $columnClass = null;
        }
        $page = $pageService->publish($user, $column, $columnClass, $this->params['name'], $this->params['content']);
        if (empty($page)) {
            return $this->error(static::ERROR, '发布失败');
        }
        $page = array(
            'id' => $page->getId(),
            'name' => $page->getName(),
            'content' => $page->getContent(),
            'user' => array(
                'id' => $page->getUser()->getId(),
                'nickname' => $page->getUser()->getNickName(),
                'sex' => $page->getUser()->getSex(),
                'headpic' => $page->getUser()->getHeadpic(),
                'sign' => $page->getUser()->getSign(),
                'created' => $page->getUser()->getCreated()->format('Y-m-d H:i:s'),
                'school' => array(
                    'id' => $page->getUser()->getSchool()->getId(),
                    'name' => $page->getUser()->getSchool()->getName(),
                ),
            ),
            'column' => $page->getAcolumn()->getId(),
            'created' => $page->getCreated()->format('Y-m-d H:i:s'),
        );
        return $this->success($page);
    }

    public function delete($id, PageService $pageService, UserService $userService): JsonResponse
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
        $page = $pageService->getPage($id);
        if (is_null($page)) {
            return $this->error(static::ERROR, '帖子不存在');
        }
        if ($page->getUser()->getId() !== $user->getId()) {
            return $this->error(static::FORBIDEN, '这不是你的帖子');
        }
        $pageService->delete($page);
        return $this->success();
    }
}

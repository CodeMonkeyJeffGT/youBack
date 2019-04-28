<?php
namespace App\Controller;

use App\Service\UserService;
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
        $checkRst = $this->checkParam('HEADER', array(
            'signature' => array('type' => 'jwt', 'required' => false),
        ));
        if ($checkRst !== static::OK) {
            return $this->error($checkRst);
        }
        $list = $followUserService->list($this->params['signature']['id']);
        return $this->success($list);
    }

    public function number(FollowUserService $followUserService): JsonResponse
    {
        $checkRst = $this->checkParam('HEADER', array(
            'signature' => array('type' => 'jwt', 'required' => false),
        ));
        if ($checkRst !== static::OK) {
            return $this->error($checkRst);
        }
        $number = $followUserService->number($this->params['signature']['id']);
        return $this->success($number);
    }

    public function othersNumber($id, FollowUserService $followUserService, UserService $userService): JsonResponse
    {
        $checkRst = $this->checkParam('HEADER', array(
            'signature' => array('type' => 'jwt', 'required' => false),
        ));
        if ($checkRst !== static::OK) {
            return $this->error($checkRst);
        }
        $user = $userService->getUser($id);
        if (is_null($user)) {
            return $this->error(static::ERROR, '用户不存在');
        }
        $number = $followUserService->number($id);
        return $this->success($number);
    }

    public function follow($id, FollowUserService $followUserService, UserService $userService): JsonResponse
    {
        $checkRst = $this->checkParam('HEADER', array(
            'signature' => array('type' => 'jwt', 'required' => false),
        ));
        if ($this->params['signature']['id'] == $id) {
            return $this->error(static::ERROR, '不可关注自己');
        }
        if ($checkRst !== static::OK) {
            return $this->error($checkRst);
        }
        $user = $userService->getUser($id);
        if (is_null($user)) {
            return $this->error(static::ERROR, '用户不存在');
        }
        $follow = $followUserService->follow($this->params['signature']['id'], $id);
        return $follow ? $this->success() : $this->error(static::ERROR, '关注失败');
    }

    public function unfollow($id, FollowUserService $followUserService, UserService $userService): JsonResponse
    {
        $checkRst = $this->checkParam('HEADER', array(
            'signature' => array('type' => 'jwt', 'required' => false),
        ));
        if ($this->params['signature']['id'] == $id) {
            return $this->error(static::ERROR, '不可取消关注自己');
        }
        if ($checkRst !== static::OK) {
            return $this->error($checkRst);
        }
        $user = $userService->getUser($id);
        if (is_null($user)) {
            return $this->error(static::ERROR, '用户不存在');
        }
        $unfollow = $followUserService->unfollow($this->params['signature']['id'], $id);
        return $unfollow ? $this->success() : $this->error(static::ERROR, '取消关注失败');
    }
}

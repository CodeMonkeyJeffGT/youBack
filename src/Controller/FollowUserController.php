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
    public function list(FollowUserService $followUserService, UserService $userService): JsonResponse
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
        $list = $followUserService->list($user);
        foreach ($list['follows'] as $key => $value) {
            $list['follows'][$key] = array(
                'id' => $value->getId(),
                'nickname' => $value->getNickName(),
                'sex' => $value->getSex(),
                'headpic' => $value->getHeadpic(),
                'sign' => $value->getSign(),
                'created' => $value->getCreated()->format('Y-m-d H:i:s'),
                'school' => array(
                    'id' => $value->getSchool()->getId(),
                    'name' => $value->getSchool()->getName(),
                ),
            );
        }
        foreach ($list['followed'] as $key => $value) {
            $list['followed'][$key] = array(
                'id' => $value->getId(),
                'nickname' => $value->getNickName(),
                'sex' => $value->getSex(),
                'headpic' => $value->getHeadpic(),
                'sign' => $value->getSign(),
                'created' => $value->getCreated()->format('Y-m-d H:i:s'),
                'school' => array(
                    'id' => $value->getSchool()->getId(),
                    'name' => $value->getSchool()->getName(),
                ),
            );
        }
        return $this->success($list);
    }

    public function number(FollowUserService $followUserService, UserService $userService): JsonResponse
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
        $number = $followUserService->number($user);
        return $this->success($number);
    }

    public function othersNumber($id, FollowUserService $followUserService, UserService $userService): JsonResponse
    {
        $checkRst = $this->checkParam('HEADER', array(
            static::TOKEN_NAME => array('type' => 'jwt', 'required' => false),
        ));
        if ($checkRst !== static::OK) {
            return $this->error($checkRst);
        }
        $user = $userService->getUser($id);
        if (is_null($user)) {
            return $this->error(static::ERROR, '用户不存在');
        }
        $number = $followUserService->number($user);
        return $this->success($number);
    }

    public function follow($id, FollowUserService $followUserService, UserService $userService): JsonResponse
    {
        $checkRst = $this->checkParam('HEADER', array(
            static::TOKEN_NAME => array('type' => 'jwt', 'required' => false),
        ));
        if ($this->params[static::TOKEN_NAME]['id'] == $id) {
            return $this->error(static::ERROR, '不可关注自己');
        }
        if ($checkRst !== static::OK) {
            return $this->error($checkRst);
        }
        $user = $userService->getUser($this->params[static::TOKEN_NAME]['id']);
        if (is_null($user)) {
            return $this->error(static::ERROR, '用户不存在');
        }
        $follow = $userService->getUser($id);
        if (is_null($follow)) {
            return $this->error(static::ERROR, '用户不存在');
        }
        $rst = $followUserService->follow($user, $follow);
        return $rst ? $this->success() : $this->error(static::ERROR, '关注失败');
    }

    public function unfollow($id, FollowUserService $followUserService, UserService $userService): JsonResponse
    {
        $checkRst = $this->checkParam('HEADER', array(
            static::TOKEN_NAME => array('type' => 'jwt', 'required' => false),
        ));
        if ($this->params[static::TOKEN_NAME]['id'] == $id) {
            return $this->error(static::ERROR, '不可取消关注自己');
        }
        if ($checkRst !== static::OK) {
            return $this->error($checkRst);
        }
        $user = $userService->getUser($this->params[static::TOKEN_NAME]['id']);
        if (is_null($user)) {
            return $this->error(static::ERROR, '用户不存在');
        }
        $follow = $userService->getUser($id);
        if (is_null($follow)) {
            return $this->error(static::ERROR, '用户不存在');
        }
        $rst = $followUserService->unfollow($user, $follow);
        return $rst ? $this->success() : $this->error(static::ERROR, '取消关注失败');
    }
}

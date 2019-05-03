<?php
namespace App\Controller;

use App\Service\UserService;
use App\Service\ColumnService;
use App\Service\FollowColumnService;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * 学校控制器
 * 
 * @method JsonResponse list(FollowColumnService $followColumnService)
 */
class FollowColumnController extends Controller
{
    public function list(FollowColumnService $followColumnService, UserService $userService): JsonResponse
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
        $columns = $followColumnService->list($user);
        foreach ($columns as $key => $value) {
            $columns[$key] = array(
                'id' => $value->getId(),
                'name' => $value->getName(),
                'description' => $value->getDescription(),
                'type' => $value->getType(),
                'created' => $value->getCreated()->format('Y-m-d H:i:s'),
                'owner' => array(
                    'id' => $value->getOwner()->getId(),
                    'nickname' => $value->getOwner()->getNickName(),
                    'sex' => $value->getOwner()->getSex(),
                    'headpic' => $value->getOwner()->getHeadpic(),
                    'sign' => $value->getOwner()->getSign(),
                    'created' => $value->getOwner()->getCreated()->format('Y-m-d H:i:s'),
                    'school' => array(
                        'id' => $value->getOwner()->getSchool()->getId(),
                        'name' => $value->getOwner()->getSchool()->getName(),
                    ),
                ),
                'followNum' => $followColumnService->getFollowNumber($value),
                'school' => null,
            );
            if ( ! is_null($value->getSchool())) {
                $columns[$key]['school'] = array(
                    'id' => $value->getSchool()->getId(),
                    'name' => $value->getSchool()->getName(),
                );
            }
        }
        return $this->success($columns);
    }

    public function follow($id, FollowColumnService $followColumnService, UserService $userService, ColumnService $columnService): JsonResponse
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
        $column = $columnService->getColumn($id);
        if (empty($column)) {
            return $this->error(static::ERROR, '论坛不存在');
        }
        $rst = $followColumnService->follow($user, $column);
        return $rst ? $this->success() : $this->error(static::ERROR, '关注失败');
    }

    public function unfollow($id, FollowColumnService $followColumnService, UserService $userService, ColumnService $columnService): JsonResponse
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
        $column = $columnService->getColumn($id);
        if (empty($column)) {
            return $this->error(static::ERROR, '论坛不存在');
        }
        $rst = $followColumnService->unfollow($user, $column);
        return $rst ? $this->success() : $this->error(static::ERROR, '取消关注失败');

    }

    public function number(FollowColumnService $followColumnService, UserService $userService): JsonResponse
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
        $number = $followColumnService->number($user);
        return $this->success($number);
    }

    public function othersNumber($id, FollowColumnService $followColumnService, UserService $userService): JsonResponse
    {
        $user = $userService->getUser($id);
        if (empty($user)) {
            return $this->error(static::ERROR, '用户不存在');
        }
        $number = $followColumnService->number($user);
        return $this->success($number);
    }
}

<?php
namespace App\Controller;

use App\Service\UserService;
use App\Service\FollowUserService;
use App\Service\SchoolService;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * 用户控制器
 * 
 * @method JsonResponse auth(UserService $userService)
 * @method JsonResponse info(UserService $userService)
 * @method JsonResponse updateInfo(UserService $userService)
 * @method JsonResponse othersInfo($id, UserService $userService)
 */
class UserController extends Controller
{
    public function auth(UserService $userService, SchoolService $schoolService): JsonResponse
    {
        $checkRst = $this->checkParam('JSON', array(
            'schoolId' => array('type' => 'number'),
            'account' => array('type' => 'string'),
            'password' => array('type' => 'string'),
            static::TOKEN_NAME => array('type' => 'string', 'required' => false, 'default' => ''),
            'others' => array('type' => 'array', 'required' => false, 'default' => array()),
        ));
        if ($checkRst !== static::OK) {
            return $this->error($checkRst);
        }
        $school = $schoolService->getSchool($this->params['schoolId']);
        if (is_null($school)) {
            return $this->error(static::ERROR, 'id为' . $this->params['schoolId'] . '的学校不存在，请勿修改程序');
        }
        $schoolSer = $this->container->get('App\\Service\School\\School' . $school->getClassName() . 'Service');
        $rst = $schoolSer->auth($this->params['account'], $this->params['password'], $this->params[static::TOKEN_NAME], $this->params['others']);
        if ($rst === false) {
            return $this->error(static::ERROR, '登录失败');
        }
        $user = $userService->checkExist($this->params['account'], $school);
        if (empty($user)) {
            $info = $schoolSer->info($rst);
            $user = $userService->insert($this->params['account'], $school, $info['name'], $info['sex']);
        }
        $userService->updateLastPassword($user, md5($this->params['password']));
        $jwt = $this->encodeJwt(array(
            'id' => $user->getId(),
            static::TOKEN_NAME => $rst,
        ));
        return $this->success($jwt);

    }

    public function info(UserService $userService): JsonResponse
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
        $user = array(
            'id' => $user->getId(),
            'nickname' => $user->getNickName(),
            'sex' => $user->getSex(),
            'headpic' => $user->getHeadpic(),
            'sign' => $user->getSign(),
            'created' => $user->getCreated()->format('Y-m-d H:i:s'),
            'school' => array(
                'id' => $user->getSchool()->getId(),
                'name' => $user->getSchool()->getName(),
            ),
        );
        return $this->success($user);
    }

    public function updateInfo(UserService $userService): JsonResponse
    {
        //todo
    }

    public function othersInfo($id, UserService $userService, FollowUserService $followUserService): JsonResponse
    {
        $checkRst = $this->checkParam('HEADER', array(
            static::TOKEN_NAME => array('type' => 'jwt', 'required' => false),
        ));
        if ($checkRst !== static::OK) {
            return $this->error($checkRst);
        }
        $me = $userService->getUser($this->params[static::TOKEN_NAME]['id']);
        $user = $userService->getUser($id);
        if (empty($user)) {
            return $this->error(static::ERROR, '用户不存在');
        }
        $user = array(
            'id' => $user->getId(),
            'nickname' => $user->getNickName(),
            'sex' => $user->getSex(),
            'headpic' => $user->getHeadpic(),
            'sign' => $user->getSign(),
            'created' => $user->getCreated()->format('Y-m-d H:i:s'),
            'school' => array(
                'id' => $user->getSchool()->getId(),
                'name' => $user->getSchool()->getName(),
            ),
            'isFollowed' => $followUserService->checkFollow($user, $me),
            'isFollows' => $followUserService->checkFollow($me, $user),
            'isMe' => $user->getId() == $me->getId(),
        );
        return $this->success($user);
    }

    public function search(UserService $userService): JsonResponse
    {
        $checkRst = $this->checkParam('GET', array(
            'query' => array('type' => 'string', 'required' => false, 'default' => ''),
            'lastId' => array('type' => 'number', 'required' => false, 'default' => 0),
            'limit' => array('type' => 'number', 'required' => false, 'default' => 20),
        ));
        if ($checkRst !== static::OK) {
            return $this->error($checkRst);
        }
        $users = $userService->search($this->params['query'], $this->params['lastId'], $this->params['limit']);
        foreach ($users as $key => $value) {
            $users[$key] = array(
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
        return $this->success($users);
    }
}

<?php
namespace App\Controller;

use App\Service\UserService;
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
            'signature' => array('type' => 'string'),
            'others' => array('type' => 'array'),
        ));
        if ($checkRst !== static::OK) {
            return $this->error($checkRst);
        }
        $className = $schoolService->getSchoolClassName($this->params['schoolId']);
        if (false === $className) {
            return $this->error(static::ERROR, 'id为' . $this->params['schoolId'] . '的学校不存在，请勿修改程序');
        }
        $school = $this->container->get('App\\Service\School\\School' . $className . 'Service');
        $rst = $school->auth($this->params['account'], $this->params['password'], $this->params['signature'], $this->params['others']);
        if ($rst === false) {
            return $this->error(static::ERROR, '登录失败');
        }
        $user = $userService->checkExist($this->params['account'], $this->params['schoolId']);
        if (false === $user) {
            $info = $school->info($rst);
            $user = $userService->insert($this->params['account'], $this->params['schoolId'], $info['name'], $info['sex']);
        }
        $userService->updateLastPassword($user, md5($this->params['password']));
        $jwt = $this->encodeJwt(array(
            'id' => $user->getId(),
            'signature' => $rst,
        ));
        return $this->success($jwt);

    }

    public function info(UserService $userService): JsonResponse
    {
        $checkRst = $this->checkParam('HEADER', array(
            'signature' => array('type' => 'jwt', 'required' => false),
        ));
        if ($checkRst !== static::OK) {
            return $this->error($checkRst);
        }
        $user = $userService->getUser($this->params['signature']['id']);
        if (is_null($user)) {
            return $this->error(static::ERROR, '用户不存在');
        }
        return $this->success($user);
    }

    public function updateInfo(UserService $userService): JsonResponse
    {
        //todo
    }

    public function othersInfo($id, UserService $userService): JsonResponse
    {
        $user = $userService->getUser($id);
        if (is_null($user)) {
            return $this->error(static::ERROR, '用户不存在');
        }
        return $this->success($user);
    }
}

<?php
namespace App\Controller;

use App\Service\UserService;
use App\Service\SchoolService;
use App\Service\FollowUserService;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * 用户控制器
 * 
 * @method JsonResponse auth(UserService $userService)
 * @method JsonResponse info(UserService $userService, FollowUserService $followUserService)
 * @method JsonResponse updateInfo(UserService $userService)
 * @method JsonResponse othersInfo($id, UserService $userService, FollowUserService $followUserService)
 */
class UserController extends Controller
{
    public function auth(UserService $userService, SchoolService $schoolService): JsonResponse
    {
        $checkRst = $this->checkParam('POST', array(
            'schoolId' => array('type' => 'number'),
            'account' => array('type' => 'string'),
            'password' => array('type' => 'string'),
            'signature' => array('type' => 'string'),
            'others' => array('type' => 'json'),
        ));
        if ($checkRst === 1) {
            return $this->error(static::PARAM_MISS);
        } elseif ($checkRst === 2) {
            return $this->error(static::INVALID_ARGUMENT);
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
        if (false === $userService->checkExist($this->params['account'], $this->params['schoolId'])) {
            $info = $school->info($rst);
            $userService->insert($this->params['account'], $this->params['schoolId'], $info['name'], $info['sex']);
        } else {
            $userService->updateLastPassword($this->params['password']);
        }
        $jwt = $this->encodeJwt(array(
            'signature' => $rst,
        ));
        return $this->success($jwt);

    }

    public function info(UserService $userService, FollowUserService $followUserService): JsonResponse
    {
        $checkRst = $this->checkParam('GET', array(
        ));
        return $this->success($checkRst);
    }

    public function updateInfo(UserService $userService): JsonResponse
    {
        
    }

    public function othersInfo($id, UserService $userService, FollowUserService $followUserService): JsonResponse
    {

    }
}

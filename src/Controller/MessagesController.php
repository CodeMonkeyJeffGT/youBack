<?php
namespace App\Controller;

use App\Service\UserService;
use App\Service\MessageService;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * 学校控制器
 * 
 * @method JsonResponse list(FollowColumnService $followColumnService)
 */
class MessagesController extends Controller
{
    public function list(UserService $userService, MessageService $messageService): JsonResponse
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
        $users = $messageService->list($user);
        foreach ($users as $key => $value) {
            $users[$key] = array(
                'id' => $value['id'],
                'nickname' => $value['nickname'],
                'sex' => $value['sex'],
                'headpic' => $value['headpic'],
                'sign' => $value['sign'],
                'created' => $value['created'],
                'school' => array(
                    'id' => $value['school_id'],
                    'name' => $value['school_name'],
                ),
            );
        }
        return $this->success($users);
    }

}
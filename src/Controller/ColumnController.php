<?php
namespace App\Controller;

use App\Service\UserService;
use App\Service\ColumnService;
use App\Service\FollowColumnService;
use App\Service\ColumnClassificationService;
use App\Service\PageService;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * 学校控制器
 * 
 * @method JsonResponse list(ColumnService $columnService)
 */
class ColumnController extends Controller
{
    public function list(ColumnService $columnService, FollowColumnService $followColumnService): JsonResponse
    {
        $this->checkParam('GET', array(
            'query' => array('type' => 'string', 'required' => false, 'default' => ''),
            'lastId' => array('type' => 'number', 'required' => false, 'default' => 0),
            'limit' => array('type' => 'number', 'required' => false, 'default' => 20),
        ));
        $columns = $columnService->list($this->params['query'], $this->params['lastId'], $this->params['limit']);
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

    public function info($id, UserService $userService, ColumnService $columnService, FollowColumnService $followColumnService, ColumnClassificationService $columnClassificationService, PageService $pageService): JsonResponse
    {
        $columnObj = $columnService->getColumn($id);
        if (empty($columnObj)) {
            return $this->error(static::ERROR, '版块不存在');
        }
        $checkRst = $this->checkParam('HEADER', array(
            static::TOKEN_NAME => array('type' => 'jwt', 'required' => false),
        ));
        if ($checkRst !== static::OK) {
            return $this->error($checkRst);
        }
        $user = $userService->getUser($this->params[static::TOKEN_NAME]['id']);
        $classifications = $columnClassificationService->getClassifications($columnObj);
        foreach ($classifications as $key => $value) {
            $classifications[$key] = array(
                'id' => $value->getId(),
                'name' => $value->getName(),
                'removable' => $value->getRemovable(),
            );
        }
        $column = array(
            'id' => $columnObj->getId(),
            'name' => $columnObj->getName(),
            'description' => $columnObj->getDescription(),
            'type' => $columnObj->getType(),
            'created' => $columnObj->getCreated()->format('Y-m-d H:i:s'),
            'owner' => array(
                'id' => $columnObj->getOwner()->getId(),
                'nickname' => $columnObj->getOwner()->getNickName(),
                'sex' => $columnObj->getOwner()->getSex(),
                'headpic' => $columnObj->getOwner()->getHeadpic(),
                'sign' => $columnObj->getOwner()->getSign(),
                'created' => $columnObj->getOwner()->getCreated()->format('Y-m-d H:i:s'),
                'school' => array(
                    'id' => $columnObj->getOwner()->getSchool()->getId(),
                    'name' => $columnObj->getOwner()->getSchool()->getName(),
                ),
            ),
            'followNum' => $followColumnService->getFollowNumber($columnObj),
            'pageNum' => $pageService->getNumber($columnObj),
            'classification' => $classifications,
            'school' => null,
            'isFollowed' => $followColumnService->checkFollow($user, $columnObj),
        );
        if ( ! is_null($columnObj->getSchool())) {
            $column['school'] = array(
                'id' => $columnObj->getSchool()->getId(),
                'name' => $columnObj->getSchool()->getName(),
            );
        }
        return $this->success($column);
    }

    public function apply(ColumnService $columnService, UserService $userService, FollowColumnService $followColumnService): JsonResponse
    {
        $checkRst = $this->checkParam('HEADER', array(
            static::TOKEN_NAME => array('type' => 'jwt', 'required' => false),
        ));
        if ($checkRst !== static::OK) {
            return $this->error($checkRst);
        }
        $checkRst = $this->checkParam('JSON', array(
            'name' => array('type' => 'string'),
            'description' => array('type' => 'string'),
        ));
        if ($checkRst !== static::OK) {
            return $this->error($checkRst);
        }
        $user = $userService->getUser($this->params[static::TOKEN_NAME]['id']);
        if (is_null($user)) {
            return $this->error(static::ERROR, '用户不存在');
        }
        $columnObj = $columnService->apply($user, $this->params['name'], $this->params['description']);
        if (empty($columnObj)) {
            return $this->error(static::ERROR, '论坛申请失败');
        }
        $column = array(
            'id' => $columnObj->getId(),
            'name' => $columnObj->getName(),
            'description' => $columnObj->getDescription(),
            'type' => $columnObj->getType(),
            'created' => $columnObj->getCreated()->format('Y-m-d H:i:s'),
            'owner' => array(
                'id' => $columnObj->getOwner()->getId(),
                'nickname' => $columnObj->getOwner()->getNickName(),
                'sex' => $columnObj->getOwner()->getSex(),
                'headpic' => $columnObj->getOwner()->getHeadpic(),
                'sign' => $columnObj->getOwner()->getSign(),
                'created' => $columnObj->getOwner()->getCreated()->format('Y-m-d H:i:s'),
                'school' => array(
                    'id' => $columnObj->getOwner()->getSchool()->getId(),
                    'name' => $columnObj->getOwner()->getSchool()->getName(),
                ),
            ),
            'followNum' => $followColumnService->getFollowNumber($columnObj),
            'school' => null,
        );
        if ( ! is_null($columnObj->getSchool())) {
            $column['school'] = array(
                'id' => $columnObj->getSchool()->getId(),
                'name' => $columnObj->getSchool()->getName(),
            );
        }
        return $this->success($column);
    }

    public function updateInfo($id, ColumnService $columnService, UserService $userService, ColumnClassificationService $columnClassificationService): JsonResponse
    {
        $checkRst = $this->checkParam('HEADER', array(
            static::TOKEN_NAME => array('type' => 'jwt', 'required' => false),
        ));
        if ($checkRst !== static::OK) {
            return $this->error($checkRst);
        }
        $checkRst = $this->checkParam('JSON', array(
            'description' => array('type' => 'string'),
            'classifications' => array('type' => 'array'),
        ));
        if ($checkRst !== static::OK) {
            return $this->error($checkRst);
        }
        $user = $userService->getUser($this->params[static::TOKEN_NAME]['id']);
        if (is_null($user)) {
            return $this->error(static::ERROR, '用户不存在');
        }
        $columnObj = $columnService->getColumn($id);
        if (empty($columnObj)) {
            return $this->error(static::ERROR, '版块不存在');
        }
        if ($columnObj->getOwner()->getId() !== $user->getId()) {
            return $this->error(static::FORBIDEN);
        }
        $columnService->updateInfo($columnObj, $this->params['description']);
        $columnClassificationService->updateInfo($columnObj, $this->params['classifications']);
        return $this->success();
    }
}

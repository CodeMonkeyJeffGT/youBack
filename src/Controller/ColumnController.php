<?php
namespace App\Controller;

use App\Service\ColumnService;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * 学校控制器
 * 
 * @method JsonResponse list(ColumnService $ColumnService)
 */
class ColumnController extends Controller
{
    public function list(ColumnService $ColumnService): JsonResponse
    {
        $this->checkParam('GET', array(
            'query' => array('type' => 'string', 'required' => false, 'default' => ''),
            'lastId' => array('type' => 'number', 'required' => false, 'default' => 0),
            'limit' => array('type' => 'number', 'required' => false, 'default' => 20),
        ));
        $rst = $ColumnService->list($this->params['query'], $this->params['lastId'], $this->params['limit']);
        return $this->success($rst);
    }

    public function info($id, ColumnService $ColumnService): JsonResponse
    {
        $rst = $ColumnService->getColumn($id);
        if (is_null($rst)) {
            return $this->error(static::ERROR, '论坛不存在');
        }
        return $this->success($rst);
    }

    public function apply(ColumnService $ColumnService): JsonResponse
    {
        $checkRst = $this->checkParam('HEADER', array(
            static::TOKEN_NAME => array('type' => 'jwt', 'required' => false),
        ));
        if ($checkRst !== static::OK) {
            return $this->error($checkRst);
        }
        $rst = $ColumnService->apply($this->params[static::TOKEN_NAME]['id'], $id);
        if (is_null($rst)) {
            return $this->error(static::ERROR, '论坛申请失败');
        }
        return $this->success($rst);
    }

    public function updateInfo($id, ColumnService $ColumnService): JsonResponse
    {
        $checkRst = $this->checkParam('HEADER', array(
            static::TOKEN_NAME => array('type' => 'jwt', 'required' => false),
        ));
        if ($checkRst !== static::OK) {
            return $this->error($checkRst);
        }
        $checkRst = $this->checkParam('PUT', array(
            'description' => array('type' => 'string'),
            'classifications' => array('type' => 'array'),
        ));
        if ($checkRst !== static::OK) {
            return $this->error($checkRst);
        }

    }
}

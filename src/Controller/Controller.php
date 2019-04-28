<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as FrameController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * 基础控制器，提供
 *      统一数据解析
 *      统一数据相应
 * @method mixed        decodeJwt(string $code)
 * @method string       encodeJwt(array $payload)
 * @method string       getWholeUrl(string $url, $opts = array())
 * @method int          checkParam(string $method, $params, $others = array())
 * @method JsonResponse success($data = null, string $message = null, $code = null)
 * @method JsonResponse error($code = null, string $message = null, $data = null)
 * @method JsonResponse toSign(string $message = null, $data = null, $code = null)
 * @method JsonResponse toUrl(string $message = null, $data = null, $code = null)
 * @method JsonResponse return($data = null, string $message = null, $code = null)
 */
abstract class Controller extends FrameController
{
    //数据处理用request对象
    protected $request;
    //接收到的参数
    protected $params;
    //错误文本
    protected $errMsg = array();
    //程序开始时间
    protected $startTime;

    protected const OK = 0;
    protected const NOT_AUTH = 1;
    protected const ERROR = 2;
    protected const FORBIDEN = 3;
    protected const PARAM_MISS = 4;
    protected const INVALID_ARGUMENT = 5;
    protected const REDIRECT = 6;
    
    /**
     * 设置 request
     */
    public function __construct()
    {
        $this->request = Request::createFromGlobals();
        date_default_timezone_set('PRC');
        $startTime = time();
        $this->setErrMsg();
    }

    /**
     * 解码及验证 Jwt
     * @param string         $code       待解码字符串
     * 
     * @return array|bool
     */
    protected function decodeJwt(string $code)
    {
        $exp = explode('.', $code);
        if (count($exp) < 3) {
            return false;
        }
        list($header, $payload, $signature) = $exp;
        if (hash('sha256', $header . '.' . $payload) !== $signature) {
            return false;
        }
        $payload = json_decode(base64_decode($payload), true);
        if ($payload['expire'] < time()) {
            return false;
        }
        unset($payload['expire']);
        return $payload;
    }

    /**
     * 编码 Jwt
     * @param array         $payload       待编码数据组
     * 
     * @return string
     */
    protected function encodeJwt(array $payload): string
    {
        $header = array(
            'alg' => 'HS256',
            'typ' => 'jwt',
        );
        $payload['expire'] = time() + 3600;
        $code = base64_encode(json_encode($header)) . '.' . base64_encode(json_encode($payload));
        $code .= '.' . hash('sha256', $code);
        return $code;
    }

    /**
     * 获取完整 url
     * @param string        $url        短url（route里名称）
     * @param array         $opts       额外配置
     * 
     * @return string
     */
    protected function getWholeUrl(string $url, $opts = array()): string
    {
        return $this->generateUrl(
            $url,
            $opts,
            UrlGeneratorInterface::ABSOLUTE_URL
        );
    }

    /**
     * 检查参数是否正确
     * @param string        $method     
     * @param array         $params     参数规则列表
     * @param array         $others     参数的额外检查回调函数
     * 
     * @return int  0:通过 1:参数缺失 2:参数不合法
     */
    protected function checkParam(string $method, $params, $others = array()): int
    {
        $tmpParams = array();
        //获取参数
        switch ($method) {
            case 'GET':
                $tmpParams = $this->request->query->all();
                break;
            case 'POST':
            case 'PUT':
            case 'DELETE':
                $tmpParams = $this->request->request->all();
                break;
            case 'JSON':
                $tmpParams = json_decode(file_get_contents('PHP://INPUT'));
                break;
        }
        //检验参数是否符合规则
        foreach ($params as $param => $rule) {
            if (
                ! isset($tmpParams[$param]) 
                && (
                    ! isset($rule['required']) 
                    || $rule['required'] !== false
                )
            ) {
                return 1;
            } else {
                $tmpParams[$param] = $tmpParams[$param] ?? null;
            }

            if ( ! isset ($rule['type'])) {
                continue;
            }

            switch ($rule['type']) {
                case 'number':
                    if ( ! is_numeric($tmpParams[$param])) {
                        return 2;
                    }
                    break;
                case 'string':
                    break;
                case 'json':
                    $tmpParams[$param] = json_decode($tmpParams[$param], true);
                    break;
                case 'jwt':
                    $tmpParams[$param] = $this->decodeJwt((string)$tmpParams[$param]);
                    if (false === $tmpParams[$param]) {
                        return 3;
                    }
            }

            if (isset($others[$param]) && $others[$param]($tmpParams[$param]) === false) {
                return 2;
            }
            $this->params[$param] = $tmpParams[$param];
        }
        return 0;
    }

    /**
     * 返回格式化数据：请求成功
     * @param mixed         $data       返回数据
     * @param string        $message    提示信息
     * @param mixed         $code       返回类型代码
     * 
     * @return JsonResponse
     */
    protected function success($data = null, string $message = null, $code = null): JsonResponse
    {
        return $this->return($data, $code, $message);
    }

    /**
     * 返回格式化数据：通用失败
     * @param string        $message    提示信息
     * @param mixed         $code       返回类型代码
     * @param mixed         $data       返回数据
     * 
     * @return JsonResponse
     */
    protected function error($code = null, string $message = null, $data = null): JsonResponse
    {
        $code = $code ?? static::ERROR;
        return $this->return($data, $code, $message);
    }

    /**
     * 返回格式化数据：未登录
     * @param string        $message    提示信息
     * @param mixed         $data       返回数据
     * @param mixed         $code       返回类型代码
     * 
     * @return JsonResponse
     */
    protected function toSign(string $message = null, $data = null, $code = null): JsonResponse
    {
        $code = $code ?? static::NOT_AUTH;
        return $this->return($data, $code, $message);
    }

    /**
     * 返回格式化数据：跳转到指定url
     * @param string        $message    提示信息
     * @param mixed         $data       返回数据        array('url' => $url);
     * @param mixed         $code       返回类型代码
     * 
     * @return JsonResponse
     */
    protected function toUrl($data = null, string $message = null, $code = null): JsonResponse
    {
        $code = $code ?? static::REDIRECT;
        return $this->return($data, $code, $message);
    }

    /**
     * 返回格式化数据
     * @param mixed         $data       返回数据
     * @param mixed         $code       返回类型代码
     * @param string        $message    提示信息
     * 
     * @return JsonResponse
     */
    protected function return($data = null, $code = null, string $message = null): JsonResponse
    {
        $code    = $code ?? static::OK;
        $message = $message ?? $this->errMsg[$code];
        return $this->json(array(
            'data' => $data ?? array(),
            'code' => $code,
            'message' => $message,
        ));
    }

    /**
     * 设置错误信息文本
     */
    private function setErrMsg()
    {
        $this->errMsg = array(
            static::OK => 'OK',
            static::NOT_AUTH => '请登录',
            static::ERROR => '出错了',
            static::FORBIDEN => '您没有权限这么做',
            static::PARAM_MISS => '参数缺失',
            static::INVALID_ARGUMENT => '参数不合法',
            static::REDIRECT => '自动跳转中，请稍候',
        ) + $this->errMsg;
    }

}
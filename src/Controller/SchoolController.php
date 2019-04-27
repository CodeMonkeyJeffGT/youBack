<?php
namespace App\Controller;

use App\Service\SchoolService;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * 学校控制器
 * 
 * @method JsonResponse list(SchoolService $schoolService)
 */
class SchoolController extends Controller
{
    public function list(SchoolService $schoolService): JsonResponse
    {
        $schools = $schoolService->list();
        return $this->success($schools);
    }

    public function getNeeds($id, SchoolService $schoolService): JsonResponse
    {
        $className = $schoolService->getSchoolClassName($id);
        if (false === $className) {
            return $this->error(static::ERROR, 'id为' . $id . '的学校不存在，请勿修改程序');
        }
        $school = $this->container->get('App\\Service\School\\School' . $className . 'Service');
        return $this->success($school->getNeeds());
    }
}

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
        foreach ($schools as $key => $value) {
            $schools[$key] = array(
                'id' => $value->getId(),
                'name' => $value->getName(),
            );
        }
        return $this->success($schools);
    }

    public function getNeeds($id, SchoolService $schoolService): JsonResponse
    {
        $school = $schoolService->getSchool($id);
        if (is_null($school)) {
            return $this->error(static::ERROR, 'id为' . $id . '的学校不存在，请勿修改程序');
        }
        $school = $this->container->get('App\\Service\School\\School' . $school->getClassName() . 'Service');
        return $this->success($school->getNeeds());
    }
}

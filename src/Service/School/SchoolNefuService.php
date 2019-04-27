<?php
namespace App\Service\School;
use App\Entity\School;
use Nefu\Nefuer;

class SchoolNefuService implements SchoolDefaultInterface
{
    private $entityManager;

    public function __construct(\Doctrine\ORM\EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * 获取除账号密码外其他需要信息，如验证码等（可选，如不需要直接返回空数组）
     * @return array
     */
    public function getNeeds(): array
    {
        return array();
    }

    /**
     * 登录并返回身份id（cookie或其他可行内容)
     * @param string        $account    账号
     * @param string        $password   密码
     * @param string        $signature  身份id
     * @param array         $others     其他所需信息（如验证码等）
     * 
     * @return string|bool
     */
    public function auth(string $account, string $password, string $signature = '', array $others = array())
    {
        $nefuer = new Nefuer();
        $password = strtoupper(md5($password));
        if (0 === $nefuer->login($account, $password)['code']) {
            return json_encode($nefuer->getCookie());
        } else {
            return false;
        }
    }

    /**
     * 获取个人信息
     * 至少包含姓名：name、性别：sex
     * 
     * @param string        $signature  身份id
     * 
     * @return array
     */
    public function info(string $signature)
    {
        $signature = json_decode($signature, true);
        $nefuer = new Nefuer();
        $nefuer->login(null, null, $signature);
        return $nefuer->info();
    }
    
    /**
     * 获取成绩
     * @param string        $signature  身份id
     * @param array         $opts       其他参数
     * 
     * @return array
     */
    public function getScore(string $signature, array $opts = array()): array
    {
        $signature = json_decode($signature, true);
        $nefuer = new Nefuer();
        $nefuer->login(null, null, $signature);
        return array(
            'all' => $nefuer->scoreAll(),
            'item' => $nefuer->scoreItem(),
        );
    }
    
    /**
     * 获取课表
     * @param string        $signature  身份id
     * @param array         $opts       其他参数
     * 
     * @return array
     */
    public function getLesson(string $signature, array $opts = array()): array
    {
        $signature = json_decode($signature, true);

    }

    /**
     * 获取考试
     * @param string        $signature  身份id
     * @param array         $opts       其他参数
     * 
     * @return array
     */
    public function getExam(string $signature, array $opts = array()): array
    {
        $signature = json_decode($signature, true);
        
    }
}
<?php
namespace App\Service;
use App\Entity\FollowUser;
use App\Entity\User;

class FollowUserService
{
    private $entityManager;
    private $followUserDb;
    private $userDb;

    public function __construct(\Doctrine\ORM\EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->followUserDb = $this->entityManager->getRepository(FollowUser::class);
        $this->userDb = $this->entityManager->getRepository(User::class);
    }

    public function list($id)
    {
        $follows = $this->followUserDb->follows($id);
        $followed = $this->followUserDb->followed($id);
        foreach ($follows as $key => $value) {
            $follows[$key] = $value->getFid();
        }
        $follows = $this->userDb->listUser(implode(',', $follows));
        foreach ($followed as $key => $value) {
            $followed[$key] = $value->getUid();
        }
        $followed = $this->userDb->listUser(implode(',', $followed));
        return array(
            'follows' => $follows,
            'followed' => $followed,
        );
    }

    public function number($id)
    {
        $followsNum = count($this->followUserDb->follows($id));
        $followedNum = count($this->followUserDb->followed($id));
        return array(
            'followsNum' => $followsNum,
            'followedNum' => $followedNum,
        );
    }

    public function follow($uId, $fId)
    {
        if (in_array(null, array($this->userDb->getUser($uId), $this->userDb->getUser($fId)))) {
            return false;
        }
        if ($this->followUserDb->checkFollow($uId, $fId)) {
            return false;
        }
        $this->followUserDb->follow($uId, $fId);
        return true;
    }

    public function unFollow($uId, $fId)
    {
        if (in_array(null, array($this->userDb->getUser($uId), $this->userDb->getUser($fId)))) {
            return false;
        }
        $followUser = $this->followUserDb->checkFollow($uId, $fId);
        if ($followUser === false) {
            return false;
        }
        $this->followUserDb->unfollow($followUser);
        return true;
    }
}
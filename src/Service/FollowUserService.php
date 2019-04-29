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

    public function list($user)
    {
        $follows = $this->followUserDb->follows($user);
        $followed = $this->followUserDb->followed($user);
        foreach ($follows as $key => $value) {
            $follows[$key] = $value->getFollow();
        }
        foreach ($followed as $key => $value) {
            $followed[$key] = $value->getUser();
        }
        return array(
            'follows' => $follows,
            'followed' => $followed,
        );
    }

    public function number($user)
    {
        $followsNum = count($this->followUserDb->follows($user));
        $followedNum = count($this->followUserDb->followed($user));
        return array(
            'followsNum' => $followsNum,
            'followedNum' => $followedNum,
        );
    }

    public function follow($user, $follow)
    {
        if ($this->followUserDb->checkFollow($user, $follow)) {
            return false;
        }
        $this->followUserDb->follow($user, $follow);
        return true;
    }

    public function unFollow($user, $follow)
    {
        $followUser = $this->followUserDb->checkFollow($user, $follow);
        if ($followUser === false) {
            return false;
        }
        $this->followUserDb->unfollow($followUser);
        return true;
    }
}
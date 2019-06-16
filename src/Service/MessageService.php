<?php
namespace App\Service;
use App\Entity\Message;

class MessageService
{
    private $entityManager;

    public function __construct(\Doctrine\ORM\EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->messageDb = $this->entityManager->getRepository(Message::class);
    }

    public function list($user): array
    {
        return $this->messageDb->list($user);
    }

    public function detail($user, $to): array
    {
        return $this->messageDb->detail($user, $to);
    }

    public function send($user, $to, $msg)
    {
        return $this->messageDb->send($user, $to, $msg);
    }
}
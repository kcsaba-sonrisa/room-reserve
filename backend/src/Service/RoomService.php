<?php

namespace App\Service;

use App\Repository\RoomRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Room;
use Doctrine\ORM\EntityNotFoundException;

final readonly class RoomService
{
    public function __construct(
        private RoomRepository $roomRepository,
        private EntityManagerInterface $em
    ) {}

    public function create(string $name, int $bedNumber): Room
    {
        $room = new Room($name, $bedNumber);
        $this->em->persist($room);
        $this->em->flush();

        return $room;
    }

    /** @return Room[] */
    public function getAll(): array {
        return $this->roomRepository->findAll();
    }

    public function update(int $id, string $name, int $bedNumber): Room {
        $room = $this->getById($id);
        $room->update($name, $bedNumber);
        $this->em->flush();

        return $room;
    }

    public function getById(int $id): Room {
        $room = $this->roomRepository->find($id);
        if (!$room) {
            throw new EntityNotFoundException("Sorry, We didn't find your required room");
        }

        return $room;
    }
}

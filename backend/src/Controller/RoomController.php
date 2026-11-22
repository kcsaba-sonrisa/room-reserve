<?php

declare(strict_types=1);

namespace App\Controller;

use App\Request\Room\RoomCreateDTO;
use App\Request\Room\RoomUpdateDTO;
use App\Service\RoomService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/room')]
class RoomController extends AbstractController
{
    #[Route('/save', methods: ['POST'])]
    public function saveRoom(#[MapRequestPayload] RoomCreateDTO $dto, RoomService $service): Response {
        $newRoom = $service->create($dto->name, $dto->bedNumber);

        return $this->json($newRoom);
    }

    #[Route('/update', methods: ['PUT'])]
    public function updateRoom(#[MapRequestPayload] RoomUpdateDTO $dto, RoomService $service): Response {
        $room = $service->update($dto->id, $dto->name, $dto->bedNumber);

        return $this->json($room);
    }

    #[Route('/{id}', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function showRoom(int $id, RoomService $service): Response {
        $room = $service->getById($id);

        return $this->json($room);
    }

    #[Route('/all', methods: ['GET'])]
    public function showAll(RoomService $service): Response {
        $allRooms = $service->getAll();

        return $this->json($allRooms);
    }
}

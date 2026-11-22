<?php

namespace App\Request\Room;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class RoomUpdateDTO
{

    public function __construct(
        #[Assert\NotNull]
        #[Assert\Positive]
        public int $id,

        public string $name,

        #[Assert\Positive]
        public int $bedNumber
    ) {}
}

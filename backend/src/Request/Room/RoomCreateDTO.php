<?php

namespace App\Request\Room;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class RoomCreateDTO
{
    public function __construct(
        #[Assert\NotNull]
        public string $name,

        #[Assert\NotNull]
        #[Assert\Positive]
        public int $bedNumber
    ) {}
}

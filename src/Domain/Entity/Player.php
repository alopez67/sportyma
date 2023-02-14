<?php

namespace App\Domain\Entity;

use App\Domain\Exception\ValidationException;
use Symfony\Component\Uid\Uuid;

/**
 *
 */
class Player implements EntityInterface
{
    /**
     * @var Uuid
     */
    private Uuid $id;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var Team
     */
    private Team $team;

    /**
     * @throws ValidationException
     */
    public function __construct(Uuid $id, string $name)
    {
        $this->id = $id;
        if (mb_strlen($name) > 255) {
            throw new ValidationException("Name must have less than 255 characters.");
        }
        $this->name = $name;
    }

    /**
     * @return Uuid
     */
    public function getId(): Uuid
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param Team $team
     * @return Team
     */
    public function setTeam(Team $team): Player
    {
        $this->team = $team;
        return $this;
    }
}
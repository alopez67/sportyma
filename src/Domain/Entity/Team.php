<?php

namespace App\Domain\Entity;

use Doctrine\Common\Collections\Collection;

class Team implements EntityInterface
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var Collection|null
     */
    private ?Collection $players;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getId(): int
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
     * @param string $name
     */
    public function setName(string $name): Team
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param Player $player
     * @return $this
     */
    public function addPlayer(Player $player): Team
    {
        if (!$this->getPlayers()->contains($player)) {
            $this->players->add($player);
            $player->setTeam($this);
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }
}
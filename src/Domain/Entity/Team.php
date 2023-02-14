<?php

namespace App\Domain\Entity;

use App\Domain\Exception\ValidationException;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Team implements EntityInterface
{
    public const GAME_TYPE_AWAY = 0;
    public const GAME_TYPE_HOME = 1;

    /**
     * @var int
     */
    private int $id;
    /**
     * @var string
     */
    private string $name;

    /**
     * @var Collection
     */
    private ?Collection $players;
    /**
     * @var Collection
     */
    private ?Collection $awayGames;
    /**
     * @var Collection
     */
    private ?Collection $homeGames;

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
     *
     * @return Team
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

    /**
     * @param Game $game
     * @param int $gameType
     * @return $this
     * @throws ValidationException
     */
    public function addGame(Game $game, int $gameType): Team
    {
        switch ($gameType) {
            case self::GAME_TYPE_AWAY:
                if (!$this->getAwayGames()->contains($game)) {
                    $this->awayGames->add($game);
                    $game->setAwayTeam($this);
                }
                break;
            case self::GAME_TYPE_HOME:
                if (!$this->getHomeGames()->contains($game)) {
                    $this->homeGames->add($game);
                    $game->setHomeTeam($this);
                }
                break;
            default:
                throw new ValidationException('Invalid game type');
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getAwayGames(): Collection
    {
        return $this->awayGames;
    }

    /**
     * @return Collection
     */
    public function getHomeGames(): Collection
    {
        return $this->homeGames;
    }

    /**
     * @return array
     */
    public function getAllGames(): array
    {
        return array_merge($this->getAwayGames()->toArray(), $this->getHomeGames()->toArray());
    }
}
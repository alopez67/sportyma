<?php

namespace App\Domain\Entity;

class Game implements EntityInterface
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
     * @var Team
     */
    private Team $homeTeam;
    /**
     * @var Team
     */
    private Team $awayTeam;

    /**
     * @param string $name
     * @param Team $homeTeam
     * @param Team $awayTeam
     */
    public function __construct(string $name, Team $homeTeam, Team $awayTeam)
    {
        $this->name = $name;
        $this->homeTeam = $homeTeam;
        $this->awayTeam = $awayTeam;
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
    public function setName(string $name): Game
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Team
     */
    public function getAwayTeam(): Team
    {
        return $this->awayTeam;
    }

    /**
     * @param Team $awayTeam
     */
    public function setAwayTeam(Team $awayTeam): Game
    {
        $awayTeam->addGame($this, Team::GAME_TYPE_AWAY);
        $this->awayTeam = $awayTeam;

        return $this;
    }

    /**
     * @return Team
     */
    public function getHomeTeam(): Team
    {
        return $this->homeTeam;
    }

    /**
     * @param Team $homeTeam
     */
    public function setHomeTeam(Team $homeTeam): Game
    {
        $homeTeam->addGame($this, Team::GAME_TYPE_HOME);
        $this->homeTeam = $homeTeam;

        return $this;
    }


}
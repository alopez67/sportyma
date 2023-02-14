<?php

namespace App\Infrastructure\Symfony\Command;

use App\UseCase\AddPlayerToTeam\Request;
use App\UseCase\AddPlayerToTeam\UseCase;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: self::COMMAND_NAME,
    description: 'Add player to team.',
    hidden: false
)]
final class AddPlayerToTeamCommand extends Command
{
    public const COMMAND_NAME = "app:team:addplayer";

    // Better use player id since names aren't unique
    public const ARGUMENT_PLAYER_ID = "player_id";
    public const ARGUMENT_TEAM_NAME = "team";

    public function __construct(private readonly UseCase $useCase)
    {
        parent::__construct();
    }

    public function configure(): void
    {
        $this->addArgument(self::ARGUMENT_PLAYER_ID, InputArgument::REQUIRED, 'The ID of the player');
        $this->addArgument(self::ARGUMENT_TEAM_NAME, InputArgument::REQUIRED, 'The name of the team');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $response = $this->useCase->execute(new Request(
            $input->getArgument(self::ARGUMENT_PLAYER_ID),
            $input->getArgument(self::ARGUMENT_TEAM_NAME)
        ));

        $table = new Table($output);
        $rows = [];

        foreach ($response->getTeam()->getPlayers() as $player) {
            $rows[] = [
                $player->getId(),
                $player->getName(),
            ];
        }

        $table
            ->setHeaders(['Id', 'Name'])
            ->setRows($rows);

        $table->render();

        return Command::SUCCESS;
    }
}
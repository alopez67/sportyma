<?php

namespace App\Infrastructure\Symfony\Command;

use App\UseCase\GetGames\Request;
use App\UseCase\GetGames\UseCase;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: self::COMMAND_NAME,
    description: 'Display games.',
    hidden: false
)]
final class GetGamesCommand extends Command
{
    public const COMMAND_NAME = "app:game:list";

    public const ARGUMENT_TEAM_NAME = "team";

    public function __construct(private readonly UseCase $useCase)
    {
        parent::__construct();
    }

    public function configure(): void
    {
        $this->addArgument(self::ARGUMENT_TEAM_NAME, InputArgument::OPTIONAL, 'Team name');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $response = $this->useCase->execute(new Request($input->getArgument(self::ARGUMENT_TEAM_NAME)));

        $table = new Table($output);
        $rows = [];

        foreach ($response->getGames() as $game) {
            $rows[] = [
                $game->getId(),
                $game->getName(),
                $game->getHomeTeam()->getName(),
                $game->getAwayTeam()->getName(),
            ];
        }

        $table
            ->setHeaders(['Id', 'Name', 'Home Team', 'Away Team'])
            ->setRows($rows);

        $table->render();

        return Command::SUCCESS;
    }
}
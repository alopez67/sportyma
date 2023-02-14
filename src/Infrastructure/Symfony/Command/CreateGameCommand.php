<?php

namespace App\Infrastructure\Symfony\Command;

use App\Domain\Exception\ValidationException;
use App\UseCase\CreateGame\Request;
use App\UseCase\CreateGame\UseCase;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: self::COMMAND_NAME,
    description: 'Create match between two existing teams.',
    hidden: false
)]
final class CreateGameCommand extends Command
{
    public const COMMAND_NAME = "app:game:create";

    // Better use player id since names aren't unique
    public const ARGUMENT_GAME_NAME = "name";
    public const ARGUMENT_TEAM_HOME_NAME = "home";
    public const ARGUMENT_TEAM_AWAY_NAME = "away";

    public function __construct(private readonly UseCase $useCase)
    {
        parent::__construct();
    }

    public function configure(): void
    {
        $this->addArgument(self::ARGUMENT_GAME_NAME, InputArgument::REQUIRED, 'The name of the game');
        $this->addArgument(self::ARGUMENT_TEAM_HOME_NAME, InputArgument::REQUIRED, 'The name of the team playing at home');
        $this->addArgument(self::ARGUMENT_TEAM_AWAY_NAME, InputArgument::REQUIRED, 'The name of the stranger team');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        try {
            $response = $this->useCase->execute(new Request(
                $input->getArgument(self::ARGUMENT_GAME_NAME),
                $input->getArgument(self::ARGUMENT_TEAM_HOME_NAME),
                $input->getArgument(self::ARGUMENT_TEAM_AWAY_NAME)
            ));
        } catch (ValidationException $validation) {
            $io->error($validation->getMessage());
            return Command::FAILURE;
        }

        $io->success(sprintf('Game between %s and %s has been created. Id is : %d',
            $response->getGame()->getHomeTeam()->getName(),
            $response->getGame()->getAwayTeam()->getName(),
            $response->getGame()->getId()));

        return Command::SUCCESS;
    }
}
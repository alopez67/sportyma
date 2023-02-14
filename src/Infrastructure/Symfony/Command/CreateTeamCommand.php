<?php

namespace App\Infrastructure\Symfony\Command;

use App\UseCase\CreateTeam\Request;
use App\UseCase\CreateTeam\UseCase;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: self::COMMAND_NAME,
    description: 'Creates new team.',
    hidden: false
)]
final class CreateTeamCommand extends Command
{
    public const COMMAND_NAME = 'app:team:create';
    public const ARGUMENT_TEAM_NAME = 'name';

    public function __construct(private readonly UseCase $useCase)
    {
        parent::__construct();
    }

    public function configure(): void
    {
        $this->addArgument(self::ARGUMENT_TEAM_NAME, InputArgument::REQUIRED, 'The name of the team');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        try {
            $response = $this->useCase->execute(new Request($input->getArgument(self::ARGUMENT_TEAM_NAME)));
        } catch (\Exception $doctrineException) {
            $io->error($doctrineException->getMessage());
            return Command::FAILURE;
        }

        $io->success('Team has been created with ID : ' . $response->getId());

        return Command::SUCCESS;
    }
}
<?php

namespace UseCase;

use App\Infrastructure\Symfony\Command\CreateGameCommand;
use App\Infrastructure\Symfony\Command\CreateTeamCommand;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;

class CreateGameTest extends KernelTestCase
{
    public function setUp(): void
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $command = $application->find(CreateTeamCommand::COMMAND_NAME);

        $commandTester = new CommandTester($command);

        $r = $commandTester->execute([
            CreateTeamCommand::ARGUMENT_TEAM_NAME => 'TestTeamGame1'
        ]);

        $r = $commandTester->execute([
            CreateTeamCommand::ARGUMENT_TEAM_NAME => 'TestTeamGame2'
        ]);
    }

    public function testExecute(): void
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $command = $application->find(CreateGameCommand::COMMAND_NAME);
        $commandTester = new CommandTester($command);
        $r = $commandTester->execute([
            CreateGameCommand::ARGUMENT_GAME_NAME => 'TestCreateGame1',
            CreateGameCommand::ARGUMENT_TEAM_AWAY_NAME => 'TestTeamGame1',
            CreateGameCommand::ARGUMENT_TEAM_HOME_NAME => 'TestTeamGame2',
        ]);

        $this->assertSame(Command::SUCCESS, $r);
    }
}
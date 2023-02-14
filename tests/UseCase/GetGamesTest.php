<?php

namespace App\Tests\UseCase;

use App\Infrastructure\Symfony\Command\CreateGameCommand;
use App\Infrastructure\Symfony\Command\CreateTeamCommand;
use App\Infrastructure\Symfony\Command\GetGamesCommand;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;

class GetGamesTest extends KernelTestCase
{
    public function setUp(): void
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $command = $application->find(CreateTeamCommand::COMMAND_NAME);

        $commandTester = new CommandTester($command);

        $r = $commandTester->execute([
            CreateTeamCommand::ARGUMENT_TEAM_NAME => 'TestGetGames1'
        ]);

        $r = $commandTester->execute([
            CreateTeamCommand::ARGUMENT_TEAM_NAME => 'TestGetGames2'
        ]);

        $command = $application->find(CreateGameCommand::COMMAND_NAME);
        $commandTester = new CommandTester($command);
        $r = $commandTester->execute([
            CreateGameCommand::ARGUMENT_GAME_NAME => 'TestGetGameName',
            CreateGameCommand::ARGUMENT_TEAM_AWAY_NAME => 'TestGetGames1',
            CreateGameCommand::ARGUMENT_TEAM_HOME_NAME => 'TestGetGames1',
        ]);
    }


    public function testExecute(): void
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $command = $application->find(GetGamesCommand::COMMAND_NAME);
        $commandTester = new CommandTester($command);
        $r = $commandTester->execute(array());
        $this->assertSame(Command::SUCCESS, $r);
    }

    public function testExecuteWithTeam(): void
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $command = $application->find(GetGamesCommand::COMMAND_NAME);
        $commandTester = new CommandTester($command);
        $r = $commandTester->execute([
            GetGamesCommand::ARGUMENT_TEAM_NAME => 'TestGetGames1'
        ]);
        $this->assertSame(Command::SUCCESS, $r);
    }
}
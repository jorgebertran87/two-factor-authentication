<?php

namespace App\Command;

use App\Authenticator\Application\QueryBus;
use App\Authenticator\Application\RetrieveVerificationQuery;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RetrieveVerificationCommand extends Command
{
    protected static $defaultName = 'verification:retrieve';

    private QueryBus $bus;

    private const PHONE_NUMBER_ARGUMENT = 'phoneNumber';

    public function __construct(QueryBus $bus)
    {
        $this->bus = $bus;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Retrieves the verification info.')
        ->setHelp('This command allows you to get a code and a verification id to authenticate');

        $this->addArgument(self::PHONE_NUMBER_ARGUMENT, InputArgument::REQUIRED, 'The phone number of the user.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $phoneNumber = $input->getArgument(self::PHONE_NUMBER_ARGUMENT);
        $query = new RetrieveVerificationQuery($phoneNumber);
        $verification = $this->bus->handle($query);

        $output->writeln('Verification ID: '. (string)$verification->id());
        $output->writeln('Code: '. (string)$verification->code()->value());

        return Command::SUCCESS;
    }
}

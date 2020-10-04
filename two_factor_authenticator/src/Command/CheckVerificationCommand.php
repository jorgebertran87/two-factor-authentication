<?php

namespace App\Command;

use App\Authenticator\Application\CheckVerificationQuery;
use App\Authenticator\Application\QueryBus;
use App\Authenticator\Application\RetrieveVerificationQuery;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CheckVerificationCommand extends Command
{
    protected static $defaultName = 'verification:check';

    private QueryBus $bus;

    private const OUTPUT_ACCESS_DENIED = 'Oops...access denied';
    private const VERIFICATION_ID_ARGUMENT = 'verificationId';
    private const CODE_ARGUMENT = 'code';

    public function __construct(QueryBus $bus)
    {
        $this->bus = $bus;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Checks the verification info.')
        ->setHelp('This command checks if the code and the verification id provided have access');

        $this->addArgument(self::VERIFICATION_ID_ARGUMENT, InputArgument::REQUIRED, 'The Verification ID.');
        $this->addArgument(self::CODE_ARGUMENT, InputArgument::REQUIRED, 'The code.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $verificationId = $input->getArgument(self::VERIFICATION_ID_ARGUMENT);
        $code = $input->getArgument(self::CODE_ARGUMENT);

        try {
            $query = new CheckVerificationQuery($verificationId, $code);

            $verification = $this->bus->handle($query);

            $output->writeln($verification ? 'You have access!' : self::OUTPUT_ACCESS_DENIED);
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $output->writeln($e->getMessage());
        }

        return Command::FAILURE;



        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;
    }
}

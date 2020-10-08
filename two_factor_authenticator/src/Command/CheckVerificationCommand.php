<?php

namespace App\Command;

use App\Authenticator\Application\CheckVerificationQuery;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CheckVerificationCommand extends AbstractCommand
{
    protected static $defaultName = 'verification:check';

    private const OUTPUT_ACCESS_DENIED = 'Oops...access denied';
    private const VERIFICATION_ID_ARGUMENT = 'verificationId';
    private const CODE_ARGUMENT = 'code';

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
        } catch (\Exception $e) {
            $output->writeln($e->getMessage());
        }
    }
}

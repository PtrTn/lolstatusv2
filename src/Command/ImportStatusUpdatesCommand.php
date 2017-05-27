<?php

namespace Command;

use Import\StatusImportService;
use Knp\Command\Command;
use Model\Region;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportStatusUpdatesCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName("import:statusupdate")
            ->setDescription("Load service incidents from League of Legends status page API");
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $app = $this->getSilexApplication();

        /** @var StatusImportService $service */
        $service = $app[StatusImportService::class];
        $region = Region::euWest();

        $output->writeln('Checking for new status updates');
        $count = $service->checkForNewStatusUpdates($region);
        $output->writeln(sprintf('Found %d status updates', $count));

        // todo: Register twitter handler on event
        // todo: Notify admin on any exceptions
        return;
    }
}

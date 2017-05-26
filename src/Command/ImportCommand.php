<?php

namespace Command;

use Import\StatusImportService;
use Knp\Command\Command;
use EventSubscriber\NewIncidentEventSubscriber;
use Model\Region;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName("import")
            ->setDescription("Load service status data from API");
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
        $region = Region::latinAmericaNorth();

        $output->writeln('Checking for new or updated incidents');
        $service->checkForNewOrUpdatedIncidentsInRegion($region);
        $output->writeln('Done checking for incidents');

        // todo: Register twitter handler on event
        // todo: Register facebook handler on event
        return;
    }
}

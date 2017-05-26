<?php

namespace Command;

use Import\StatusImportService;
use Knp\Command\Command;
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
        $output->writeln('Loading service data');
        /** @var StatusImportService $service */
        $service = $app[StatusImportService::class];
        $region = Region::latinAmericaNorth();
        $incidents = $service->getIncidentsForRegion($region);
        $output->writeln(sprintf('Found %d incidents', count($incidents)));
        // todo: Diff current status with stored messages
        // todo: Throw event for every new update
        // todo: Register twitter handler on event
        // todo: Register facebook handler on event
        return;
    }
}

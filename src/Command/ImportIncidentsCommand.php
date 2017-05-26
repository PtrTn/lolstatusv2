<?php

namespace Command;

use Import\StatusImportService;
use Knp\Command\Command;
use Model\Region;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportIncidentsCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName("import:incidents")
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

        $output->writeln('Checking for new or updated incidents');
        $service->checkForNewOrUpdatedIncidentsInRegion($region);
        $output->writeln('Done checking for incidents');

        // todo: Register twitter handler on event
        return;
    }
}

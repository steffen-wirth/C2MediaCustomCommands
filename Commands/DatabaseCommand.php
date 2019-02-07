<?php
/**
* C2 Media Custom Cli Commands
 */

namespace C2MediaStandard\Commands;

use Shopware\Commands\ShopwareCommand;
use Shopware\Components\Install\Database;
use Shopware\Components\Migrations\Manager;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * @category C2MediaStandard
 *
 * @copyright Copyright (c) C2Media
 */
class DatabaseCommand extends ShopwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('sw:database:dump')
            ->setDescription('dump shopware database');

        $this->addOption(
            'no',
            null,
            InputOption::VALUE_OPTIONAL,
            'use no db credentials'
        );

    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $dbConfig = $this->getContainer()->getParameter('shopware.db');

        $exec = "mysqldump -h " . $dbConfig['host'] . " -u " . $dbConfig['username'] . " -p'" . $dbConfig['password'] . "' --single-transaction " . $dbConfig['dbname'] . ' > $(date +"%m_%d_%Y")_dbdump.sql';

        try {
            exec($exec);
            $io->success('Databasedump was successfully created.');
        } catch (\Exception $e) {
            $io->error($e->getMessage());
        }

    }
}

<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Setup\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;
use Magento\Framework\Setup\Lists;
use Magento\Setup\Model\ObjectManagerProvider;

/**
 * Command prints list of cron jobs
 */
class InfoCronListCommand extends Command
{
    /**
     * List model provides lists of available options for currency, language locales, timezones
     *
     * @var Lists
     */
    private $lists;

    /**
     * @var \Magento\Cron\Model\ConfigInterface
     */
    private $cronConfig;

    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @param Lists $lists
     */
    public function __construct(Lists $lists, ObjectManagerProvider $objectManagerProvider)
    {
        $this->lists = $lists;
        $this->objectManager = $objectManagerProvider->get();
//        \Magento\Cron\Model\ConfigInterface $cronConfig,
//        $this->cronConfig = $cronConfig;
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('info:cron:list')
            ->setDescription('Displays the list of cron jobs');

        parent::configure();
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $table = $this->getHelperSet()->get('table');
        $table->setHeaders(['Currency', 'Code']);

        /** @var \Magento\Cron\Model\ConfigInterface $cronConfig */
        $cronConfig = $this->objectManager->get(\Magento\Cron\Model\ConfigInterface::class);
        var_dump($cronConfig);
        $jobs = $cronConfig->getJobs();
        var_dump($jobs);
//        $jobs = $this->cronConfig->getJobs();
//        var_dump($jobs);

//        foreach ($this->lists->getCurrencyList() as $key => $currency) {
//            $table->addRow([$currency, $key]);
//        }

        $table->render($output);
    }
}

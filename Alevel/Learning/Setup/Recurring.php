<?php

namespace Alevel\Learning\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Psr\Log\LoggerInterface;

/**
 * Class Recurring
 */
class Recurring implements InstallSchemaInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Recurring constructor.
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param SchemaSetupInterface   $setup
     * @param ModuleContextInterface $context
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $this->logger->info(sprintf("%s is called", self::class));
    }
}

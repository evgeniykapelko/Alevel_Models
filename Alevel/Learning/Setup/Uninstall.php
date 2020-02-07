<?php

namespace Alevel\Learning\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UninstallInterface;

/**
 * Class Uninstall
 * @package Alevel\Learning\Setup
 */
class Uninstall implements UninstallInterface
{
    /**
     * Invoked when remove-data flag is set during module uninstall.
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     *
     * @return void
     */
    public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $this->dropTable($setup, 'alevel_learning_model');
    }

    /**
     * @param SchemaSetupInterface $setup
     * @param string $tableName
     */
    private function dropTable(SchemaSetupInterface $setup, $tableName)
    {
        $connection = $setup->getConnection();
        $connection->dropTable($this->getTableNameWithPrefix($setup, $tableName));
    }

    /**
     * @param SchemaSetupInterface $setup
     * @param string $tableName
     *
     * @return string
     */
    private function getTableNameWithPrefix(SchemaSetupInterface $setup, $tableName)
    {
        return $setup->getTable($tableName);
    }
}

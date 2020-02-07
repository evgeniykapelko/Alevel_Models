<?php

namespace Alevel\Learning\Setup;

use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

/**
 * Class InstallSchema
 * @package Alevel\Learning\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface   $setup
     * @param ModuleContextInterface $context
     *
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $table = $setup->getConnection()
            ->newTable($setup->getTable('alevel_learning_model'))
            ->addColumn(
                'entity_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'primary'  => true, 'nullable' => false],
                'Entity Id'
            )->addColumn(
                'name',
                Table::TYPE_TEXT,
                null,
                [ 'nullable' => false],
                'Name'
            )->addColumn(
                'email',
                Table::TYPE_TEXT,
                null,
                ['nullable' => false],
                'Email'
            )->addColumn(
                'content',
                Table::TYPE_TEXT,
                null,
                ['nullable' => false],
                'Content'
            )->addColumn(
                'enabled',
                Table::TYPE_BOOLEAN,
                null,
                ['nullable' => false, 'unsigned' => true, 'default' => 1],
                'Enabled'
            )->addColumn(
                'updated_at',
                Table::TYPE_DATETIME,
                null,
                ['nullable' => false, 'default' => new \Zend_Db_Expr('CURRENT_TIMESTAMP')],
                'Updated At'
            )->addIndex(
                $setup->getIdxName($setup->getTable('alevel_learning_model'), ['entity_id'], AdapterInterface::INDEX_TYPE_INDEX),
                ['entity_id'],
                [
                    'type' => AdapterInterface::INDEX_TYPE_INDEX
                ]
            );
        $setup->getConnection()->createTable($table);

        $setup->endSetup();
    }
}
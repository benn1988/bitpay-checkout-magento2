<?php

namespace Bitpay\BPCheckout\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Zend_Db_Exception;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * @inheritdoc
     *
     * @throws Zend_Db_Exception
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();
       
        //START table setup
        $table = $installer->getConnection()->newTable(
            $installer->getTable('bitpay_transactions')
        )->addColumn(
            'id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true],
            'ID'
        )->addColumn(
            'order_id',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Order ID'
        )->addColumn(
            'transaction_id',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Transaction ID'
        )->addColumn(
            'transaction_status',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Transaction Status'
        )->addColumn(
            'date_added',
            Table::TYPE_TIMESTAMP,
            255,
            ['nullable' => false,'default' => Table::TIMESTAMP_INIT_UPDATE],
            'Date Added'
        );
        $installer->getConnection()->createTable($table);
        //END   table setup
        $installer->endSetup();
    }
}

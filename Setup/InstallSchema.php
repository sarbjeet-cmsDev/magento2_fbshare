<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Expert\FbShare\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup)
    {
        $installer = $setup;
        $installer->startSetup();

        //add coulmn to quote
        $installer->getConnection()->addColumn(
            $installer->getTable("quote"),
            "fbdiscount",
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                'length' => '10,4',
                'default' => 0,
                'comment' => 'Facebook Discount'
            ]
        );
        $installer->getConnection()->addColumn(
            $installer->getTable("quote"),
            "fbuserid",
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length' => 20,
                'nullable' => true,
                'comment' => 'Facebook UserID'
            ]
        );
        //add coulmn to quote
        $installer->getConnection()->addColumn(
            $installer->getTable("quote_item"),
            "fbdiscount",
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                'length' => '10,4',
                'default' => 0,
                'comment' => 'Facebook Discount'
            ]
        );
        //add coulmn to sales_order
        $installer->getConnection()->addColumn(
            $installer->getTable("sales_order"),
            "fbdiscount",
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                'length' => '10,4',
                'default' => 0,
                'comment' => 'Facebook Discount'
            ]
        );
        $installer->getConnection()->addColumn(
            $installer->getTable("sales_order"),
            "fbuserid",
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length' => 20,
                'nullable' => true,
                'comment' => 'Facebook UserID'
            ]
        );
        //add coulmn to sales_order_item
        $installer->getConnection()->addColumn(
            $installer->getTable("sales_order_item"),
            "fbdiscount",
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                'length' => '10,4',
                'default' => 0,
                'comment' => 'Facebook Discount'
            ]
        );
        $installer->endSetup();
    }
}

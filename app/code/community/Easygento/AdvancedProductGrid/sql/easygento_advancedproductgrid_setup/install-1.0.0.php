<?php
/**
 * This file is part of Easygento_AdvancedProductGrid for Magento.
 *
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author Phuong LE <sony@menincode.com> <@>
 * @category Easygento
 * @package Easygento_AdvancedProductGrid
 * @copyright Copyright (c) 2017 Easygento (Menincode)
 */

try {

    /* @var $conn Varien_Db_Adapter_Interface */
    /* @var $installer Mage_Core_Model_Resource_Setup */
    $installer = $this;
    $installer->startSetup();

    $table = $installer->getConnection()
        ->newTable($installer->getTable('easygento_advancedproductgrid/product_attribute'))
        ->addColumn('advanced_attribute_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'identity'  => true,
            'unsigned'  => true,
            'nullable'  => false,
            'primary'   => true,
        ), 'Attribute ID')
        ->addColumn('attribute_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
            'unsigned'  => true,
            'nullable'  => false,
            'default'   => '0',
        ), 'Mage Attribute Id')
        ->addIndex(
            $installer->getIdxName(
                'easygento_advancedproductgrid/product_attribute',
                array('attribute_id'),
                Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
            ),
            array('attribute_id'),
            array('type' => Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE))
        ->addForeignKey(
            $installer->getFkName('easygento_advancedproductgrid/product_attribute', 'attribute_id', 'eav/attribute', 'attribute_id'),
            'attribute_id', $installer->getTable('eav/attribute'), 'attribute_id',
            Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
        ->setComment('advanced product / Attribute relations');

    $installer->getConnection()->createTable($table);
    $installer->endSetup();

} catch (Exception $e) {
    // Silence is golden
    Mage::logException($e);
    if (Mage::getIsDeveloperMode()) {
        Mage::throwException($e->getMessage());
    }
}
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

/**
 * Attribute Grid
 * @package Easygento_AdvancedProductGrid
 */
class Easygento_AdvancedProductGrid_Block_Adminhtml_Product_Attribute_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

// Easygento Tag NEW_CONST

// Easygento Tag NEW_VAR

    /**
     * Get collection object
     * @return Easygento_AdvancedProductGrid_Model_Resource_Product_Attribute_Collection
     */
    public function getCollection()
    {
        if (!parent::getCollection()) {
            $collection = Mage::getResourceModel('easygento_advancedproductgrid/product_attribute_collection');
            $this->setCollection($collection);
        }

        return parent::getCollection();
    }

    /**
     * Prepare columns
     * @return Easygento_AdvancedProductGrid_Block_Adminhtml_Product_Attribute_Grid
     */
    protected function _prepareColumns()
    {
        /** @var Easygento_AdvancedProductGrid_Helper_Data $helper */
        $helper = Mage::helper('easygento_advancedproductgrid');

        $this->addColumn('advanced_attribute_id', array(
            'header' => $helper->__('ID'),
            'index' => 'advanced_attribute_id',
            'type' => 'number'
        ));

        $this->addColumn('title', array(
            'header' => $helper->__('Attribute Code'),
            'type' => 'text',
            'index' => 'attribute_id',
            'renderer' => 'easygento_advancedproductgrid/adminhtml_product_renderer_attribute',
            'filter_condition_callback' => array($this, '_filter')
        ));
        return parent::_prepareColumns();
    }

    /**
     * Add Mass Action Item
     */
    protected function _prepareMassaction()
    {
        $help = Mage::helper('easygento_advancedproductgrid');

        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('easygento_advancedproductgrid');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => $help->__('Delete'),
            'url' => $this->getUrl('*/*/delete'),
            'confirm' => $help->__('Are you sure?')
        ));
    }

    /**
     * @param $collection
     * @param $column
     * @return $this
     */
    protected function _filter($collection, $column)
    {
        if (!$value = $column->getFilter()->getValue()) {
            return $this;
        }
        $this->getCollection()->getSelect()
            ->joinInner(
                array('eav_attribute' => $this->getCollection()->getTable('eav/attribute')),
                'main_table.attribute_id = eav_attribute.attribute_id',
                array('attribute_code' => 'eav_attribute.attribute_code'))
            ->where(
                "eav_attribute.attribute_code like ?"
                , "%$value%");

        return $this;
    }

// Easygento Tag NEW_METHOD

}
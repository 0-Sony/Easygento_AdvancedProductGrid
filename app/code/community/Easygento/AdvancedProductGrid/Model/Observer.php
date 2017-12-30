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
 * Observer Model
 * @package Easygento_AdvancedProductGrid
 */
class Easygento_AdvancedProductGrid_Model_Observer
{
    /**
     * @var Easygento_AdvancedProductGrid_Model_Resource_Product_Attribute_Collection
     */
    protected $_collection;
    /**
     * @var Mage_Catalog_Model_Entity_Attribute
     */
    protected $_catalogEntityAttribute;


    public function __construct()
    {
        $this->_collection = Mage::getModel('easygento_advancedproductgrid/product_attribute')->getCollection();
        $this->_catalogEntityAttribute = Mage::getModel('catalog/entity_attribute');
    }

// Easygento Tag NEW_CONST

// Easygento Tag NEW_VAR

    /**
     * @event core_block_abstract_prepare_layout_before
     * @param Varien_Event_Observer $observer
     * @return $this
     */
    public function addCustomColumn(Varien_Event_Observer $observer)
    {
        $block = $observer->getBlock();
        if (!isset($block)) {
            return $this;
        }

        if ($block->getType() == 'adminhtml/catalog_product_grid') {

            foreach ($this->_collection as $attribute) {
                $model = clone $this->_catalogEntityAttribute;
                $model->load($attribute->getAttributeId());
                $rendererType = $model->getFrontendInput();
                /* @var $block Mage_Adminhtml_Block_Customer_Grid */

                $data = array(
                    'header' => $model->getFrontendLabel(),
                    'type' => $rendererType,
                    'index' => $model->getAttributeCode(),
                );

                if ($rendererType == 'select' || $rendererType == 'boolean') {
                    $data['type'] = 'options';
                    $data['options'] = $this->_getAttributeOptions($model->getAttributeCode());
                }

                if ($rendererType == 'media_image') {
                    $data['renderer'] = 'easygento_advancedproductgrid/adminhtml_widget_grid_renderer_media';
                }

                if ($rendererType == 'price') {
                    $data['currency_code'] = $this->_getStore()->getBaseCurrency()->getCode();
                }

                /** @TODO make the position of the column selectable */
                $block->addColumnAfter($model->getAttributeCode(), $data, 'name');
            }
        }
    }

    /**
     * @event catalog_product_collection_load_before
     * @param Varien_Event_Observer $observer
     * @return $this
     */
    public function catalogProductCollectionLoadBefore(Varien_Event_Observer $observer)
    {
        if (Mage::app()->getRequest()->getControllerName() == 'catalog_product') {

            /** @var Mage_Catalog_Model_Resource_Product_Collection $collection */
            $collection = $observer->getCollection();

            $eavAttributeModel = Mage::getModel('catalog/entity_attribute');
            foreach ($this->_collection as $attribute) {
                $model = clone $eavAttributeModel;
                $model->load($attribute->getAttributeId());
                $collection->addAttributeToSelect($model->getAttributeCode());
            }
        }

        return $this;
    }

    /**
     * @param $attributeCode
     * @return array
     */
    protected function _getAttributeOptions($attributeCode)
    {
        $attribute = Mage::getModel('eav/config')->getAttribute(Mage_Catalog_Model_Product::ENTITY, $attributeCode);
        $options = array();
        foreach ($attribute->getSource()->getAllOptions(false, true) as $option) {
            $options[$option['value']] = $option['label'];
        }
        return $options;
    }

    /**
     * @return Mage_Core_Model_Store
     */
    protected function _getStore()
    {
        $storeId = (int) Mage::app()->getRequest()->getParam('store', 0);
        return Mage::app()->getStore($storeId);
    }
// Easygento Tag NEW_METHOD

}
<?php
/**
 * This file is part of AntoineK_Slider for Magento.
 *
 * @license All rights reserved
 * @author Antoine Kociuba <antoine.kociuba@gmail.com>
 * @category AntoineK
 * @package AntoineK_Slider
 * @copyright Copyright (c) 2014 Antoine Kociuba (http://www.antoinekociuba.com)
 */

/**
 * Slider Tab
 * @package AntoineK_Slider
 */
class Easygento_AdvancedProductGrid_Block_Adminhtml_Product_Attribute_Edit_Tab_Attribute
    extends Mage_Adminhtml_Block_Widget
{

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('easygento/advancedproductgrid/attribute.phtml');
    }

    /**
     * Preparing layout, adding buttons
     *
     * @return Mage_Eav_Block_Adminhtml_Attribute_Edit_Options_Abstract
     */
    protected function _prepareLayout()
    {
        /** @var Easygento_AdvancedProductGrid_Helper_Data $helper */
        $helper = Mage::helper('easygento_advancedproductgrid');

        $this->setChild('delete_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData([
                    'label' => $helper->__('Delete'),
                    'class' => 'delete delete-option'
                ]));

        $this->setChild('add_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData([
                    'label' => $helper->__('Add Option'),
                    'class' => 'add',
                    'id' => 'add_new_option_button'
                ]));
        return parent::_prepareLayout();
    }

    /**
     * Retrieve HTML of delete button
     *
     * @return string
     */
    public function getDeleteButtonHtml()
    {
        return $this->getChildHtml('delete_button');
    }

    /**
     * Retrieve HTML of add button
     *
     * @return string
     */
    public function getAddNewButtonHtml()
    {
        return $this->getChildHtml('add_button');
    }

    /**
     * @return Mage_Core_Model_Store
     */
    public function getStoreAdmin()
    {
        return Mage::getModel('core/store')->load(Mage_Core_Model_App::ADMIN_STORE_ID);
    }

    /**
     * @return array|mixed
     */
    public function getOptionValues()
    {
        $values = $this->getData('option_values');
        if (is_null($values)) {
            $eavModel = Mage::getModel('eav/entity_attribute');
            $values = [];
            $attributeCollection = Mage::getResourceModel('easygento_advancedproductgrid/product_attribute_collection');

            foreach ($attributeCollection as $attribute) {
                $eav = clone $eavModel;
                $attributeCode = $eav->load($attribute->getAttributeId())->getAttributeCode();
                $value = [];
                $value['id'] = $attribute->getData('advanced_attribute_id');
                $value['store' . $this->getStoreAdmin()->getId()] = $attributeCode;
                $values[] = new Varien_Object($value);
            }
            $this->setData('option_values', $values);
        }

        return $values;
    }
}

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
 * Attribute Form Container
 * @package Easygento_AdvancedProductGrid
 */
class Easygento_AdvancedProductGrid_Block_Adminhtml_Product_Attribute_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

// Easygento Tag NEW_CONST

// Easygento Tag NEW_VAR

    /**
     * Constructor Override
     * @return Easygento_AdvancedProductGrid_Block_Adminhtml_Product_Attribute_Edit
     */
    protected function _construct()
    {
        parent::_construct();

        $this->_blockGroup = 'easygento_advancedproductgrid';
        $this->_controller = 'adminhtml_product_attribute';
        $this->_mode       = 'edit';

        $this->setFormActionUrl($this->getUrl('*/*/save', ['id' => $this->_getObject()->getId()]));

        return $this;
    }

    /**
     * The header
     * @return string
     */
    public function getHeaderText()
    {
        if ($this->_getObject()->getId()) {
            $header = 'Edit Attribute';
        } else {
            $header = Mage::helper('easygento_advancedproductgrid')->__('Attribute Product List to use in Product Grid');
        }
        return $this->__($header);
    }

    /**
     * Retrieve the attribute
     * @return Easygento_AdvancedProductGrid_Model_Product_Attribute
     */
    protected function _getObject()
    {
        return Mage::registry('current_attribute');
    }

// Easygento Tag NEW_METHOD

}
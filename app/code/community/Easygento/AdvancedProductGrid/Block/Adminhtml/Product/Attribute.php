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
 * Attribut Grid Container
 * @package Easygento_AdvancedProductGrid
 */
class Easygento_AdvancedProductGrid_Block_Adminhtml_Product_Attribute extends Mage_Adminhtml_Block_Widget_Grid_Container
{

// Easygento Tag NEW_CONST

// Easygento Tag NEW_VAR

    /**
     * Constructor Override
     * @return Easygento_AdvancedProductGrid_Block_Adminhtml_Product_Attribute
     */
    protected function _construct()
    {
        parent::_construct();

        $this->_blockGroup = 'easygento_advancedproductgrid';
        $this->_controller = 'adminhtml_product_attribute';
        $this->_headerText = $this->__('Grid of Advanced Attributes');
        $this->_addButtonLabel = $this->__('Add Advanced Attribute');

        return $this;
    }

    /**
     * Prepare Layout
     * @return Easygento_AdvancedProductGrid_Block_Adminhtml_Product_Attribute
     */
    protected function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

// Easygento Tag NEW_METHOD

}
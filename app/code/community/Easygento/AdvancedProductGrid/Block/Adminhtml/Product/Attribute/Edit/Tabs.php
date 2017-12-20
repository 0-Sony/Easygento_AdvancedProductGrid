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
 * Slider Form
 * @package AntoineK_Slider
 */
class Easygento_AdvancedProductGrid_Block_Adminhtml_Product_Attribute_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    const TAB_ATTRIBUTE_BLOCK = 'easygento_advancedproductgrid/adminhtml_product_attribute_edit_tab_attribute';
// Easygento Tag NEW_CONST

// Easygento Tag NEW_VAR

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('advanced_product_attribute_tab');
        $this->setDestElementId('edit_form');
        $this->setTitle($this->__('Attribute Information'));
    }

    /**
     * Before toHtml
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _beforeToHtml()
    {
        /** @var Easygento_AdvancedProductGrid_Helper_Data $helper */
        $helper = Mage::helper('easygento_advancedproductgrid');

        $this->addTab('advanced product attributes', [
            'label' => $helper->__('Advanced Product Attributes'),
            'title'     => $helper->__('Advanced Product Attributes'),
            'content'   => $this->getLayout()->createBlock(self::TAB_ATTRIBUTE_BLOCK)->toHtml(),
            'active'    => true
        ]);

        return parent::_beforeToHtml();
    }

// Easygento Tag NEW_METHOD

}
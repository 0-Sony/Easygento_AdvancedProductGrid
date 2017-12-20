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
 * Product_Attribute Model
 * @package Easygento_AdvancedProductGrid
 */
class Easygento_AdvancedProductGrid_Model_Product_Attribute extends Mage_Core_Model_Abstract
{

// Easygento Tag NEW_CONST

// Easygento Tag NEW_VAR

    /**
     * Prefix of model events names
     * @var string
     */
    protected $_eventPrefix = 'product_attribute';

    /**
     * Parameter name in event
     * In observe method you can use $observer->getEvent()->getObject() in this case
     * @var string
     */
    protected $_eventObject = 'product_attribute';

    /**
     * Product_Attribut Constructor
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init('easygento_advancedproductgrid/product_attribute');
    }

// Easygento Tag NEW_METHOD

}
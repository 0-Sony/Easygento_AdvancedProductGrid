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
 * Resource Model of Product_Attribut
 * @package Easygento_AdvancedProductGrid
 */
class Easygento_AdvancedProductGrid_Model_Resource_Product_Attribute extends Mage_Core_Model_Resource_Db_Abstract
{

// Easygento Tag NEW_CONST

// Easygento Tag NEW_VAR

    /**
     * Product_Attribute Resource Constructor
     * @return void
     */
    protected function _construct()
    {
        $this->_init('easygento_advancedproductgrid/product_attribute', 'advanced_attribute_id');
    }

    /**
     * @return $this
     */
    public function truncate() {
        $this->_getWriteAdapter()->query('TRUNCATE TABLE '.$this->getMainTable());
        return $this;
    }

// Easygento Tag NEW_METHOD

}
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
 * Adminhtml_Product_Renderer_Attribute Block
 * @package Easygento_AdvancedProductGrid
 */
class Easygento_AdvancedProductGrid_Block_Adminhtml_Product_Renderer_Attribute extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{

// Easygento Tag NEW_CONST

// Easygento Tag NEW_VAR

    /**
     * @var Mage_Eav_Model_Entity_Attribute
     */
    protected $_attributeModel;

    public function __construct()
    {
        parent::__construct();
        $this->_attributeModel = Mage::getModel('eav/entity_attribute');
    }

    /**
     * @param Varien_Object $row
     * @return string
     */
    public function render(Varien_Object $row)
    {
        $attributeId = $row->getData('attribute_id');
        $this->_attributeModel->load($attributeId);
        return $this->_attributeModel->getFrontend()->getLabel();

    }
// Easygento Tag NEW_METHOD

}
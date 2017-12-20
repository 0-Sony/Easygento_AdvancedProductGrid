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
 * Adminhtml_Widget_Grid_Renderer_Media Block
 * @package Easygento_AdvancedProductGrid
 */
class Easygento_AdvancedProductGrid_Block_Adminhtml_Widget_Grid_Renderer_Media extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{

// Easygento Tag NEW_CONST

// Easygento Tag NEW_VAR

    /**
     * @param Varien_Object $row
     *
     * @return mixed
     */
    public function render(Varien_Object $row)
    {
        $imagePath = $row->getData($this->getColumn()->getIndex());
        if ($imagePath != '') {
            return '<img src=' . Mage::getBaseUrl('media') . 'catalog/product' . $imagePath . ' width=100>';
        } else {
            return 'No picture';
        }
    }

// Easygento Tag NEW_METHOD

}
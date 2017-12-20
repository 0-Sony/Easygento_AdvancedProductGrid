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
 * Attribute Form
 * @package Easygento_AdvancedProductGrid
 */
class Easygento_AdvancedProductGrid_Block_Adminhtml_Product_Attribute_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

// Easygento Tag NEW_CONST

// Easygento Tag NEW_VAR

    /**
     * Prepare form before rendering HTML
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form([
            'id'        => 'edit_form',
            'action'    => $this->getData('action'),
            'method'    => 'post',
            'enctype'   => 'multipart/form-data'
        ]);

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

// Easygento Tag NEW_METHOD

}
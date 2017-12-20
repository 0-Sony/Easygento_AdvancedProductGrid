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
 * Adminhtml_Advancedproductgrid_Product_Attribute Controller
 * @package Easygento_AdvancedProductGrid
 */
class Easygento_AdvancedProductGrid_Adminhtml_Advancedproductgrid_Product_AttributeController extends Mage_Adminhtml_Controller_Action
{

// Easygento Tag NEW_CONST

// Easygento Tag NEW_VAR

    /**
     * Pre dispatch
     * @return void
     */
    public function preDispatch()
    {
        // Title
        $this->_title($this->__('Manage Attribute'));

        return parent::preDispatch();
    }

    /**
     * List
     * @return void
     */
    public function indexAction()
    {
        $this->_forward('grid');
    }

    /**
     * Grid
     * @return void
     */
    public function gridAction()
    {
        // Layout
        $this->loadLayout();

        // Title
        $this->_title($this->__('Grid'));

        // Content
        $grid = $this->getLayout()->createBlock('easygento_advancedproductgrid/adminhtml_product_attribute', 'grid');
        $this->_addContent($grid);

        // Render
        $this->renderLayout();
    }

    /**
     * New attribute
     * @return void
     */
    public function newAction()
    {
        $this->_forward('edit');
    }

    /**
     * Edit attribute
     * @return void
     */
    public function editAction()
    {
        // Object
        $object = Mage::getModel('easygento_advancedproductgrid/product_attribute')->load($this->getRequest()->getParam('id', false));
        Mage::register('current_attribute', $object);

        // Layout
        $this->loadLayout();

        // Content
        $edit = $this->getLayout()->createBlock('easygento_advancedproductgrid/adminhtml_product_attribute_edit', 'edit_form');
        $this->_addContent($edit);

        // Render
        $this->renderLayout();
    }

    /**
     * Save attribute
     * @return void
     */
    public function saveAction()
    {
        $this->_truncateTable();

        $options = $this->getRequest()->getParam('option');
        $values = $options['value'];
        $deleteOption = $options['delete'];

        $attributeCode = [];
        foreach ($values as $options => $code) {
            if ($deleteOption[$options] == '') {
                $attributeCode[] = $code[0];
            }
        }

        $catalogEntityAttribute = Mage::getModel('catalog/entity_attribute');

        /** @var Easygento_AdvancedProductGrid_Model_Product_Attribute $object */
        $object = Mage::getModel('easygento_advancedproductgrid/product_attribute');

        foreach ($attributeCode as $code) {
            $model = clone $catalogEntityAttribute;
            $model->loadByCode(Mage_Catalog_Model_Product::ENTITY, $code);

            if ($model->getId()) {
                try {
                    $obj = clone $object;
                    $obj->load($model->getId(), 'attribute_id');
                    if (!$obj->getId()) {
                        $obj->setData('attribute_id', $model->getId());
                        $obj->save();
                    }
                } catch (Exception $e) {
                    Mage::logException($e);
                    if (Mage::getIsDeveloperMode()) {
                        Mage::throwException($e->getMessage());
                    }

                    $this->_getSession()->addError($this->__('An error occurred.'));
                    $this->_redirectReferer();
                    return;
                }
            } else {
                $this->_getSession()->addError($this->__('This attribute code does not exist : %s', $code));
            }
        }

        // Success
        $this->_getSession()->addSuccess($this->__('Attribute saved successfully.'));
        $this->_redirect('*/*/index');
    }

    /**
     * Delete attribute
     * @return void
     */
    public function deleteAction()
    {
        // Object
        $attributeIds = $this->getRequest()->getParam('easygento_advancedproductgrid');

        if (!is_array($attributeIds)) {
            $this->_getSession()->addError($this->__('Please select an attribute(s).'));
        } else {
            if (!empty($attributeIds)) {
                try {
                    $attribute = Mage::getModel('easygento_advancedproductgrid/product_attribute');
                    foreach ($attributeIds as $id) {
                        $model = clone $attribute;
                        $model->load($id);
                        $model->delete();
                    }
                    $this->_getSession()->addSuccess(
                        $this->__('Total of %d record(s) have been deleted.', count($attributeIds))
                    );
                } catch (Mage_Core_Model_Exception $e) {
                    $this->_getSession()->addError($e->getMessage());
                } catch (Mage_Core_Exception $e) {
                    $this->_getSession()->addError($e->getMessage());
                } catch (Exception $e) {
                    $this->_getSession()
                        ->addException($e, $this->__('An error occurred while deleting attribute.'));
                }
            }
        }

        $this->_redirect('*/*/index');
    }

    /**
     * Truncate
     */
    protected function _truncateTable()
    {
        Mage::getResourceModel('easygento_advancedproductgrid/product_attribute')->truncate();
    }

    /**
     * Is allowed?
     * @return bool
     */
    protected function _isAllowed()
    {
        return true;
    }

// Easygento Tag NEW_METHOD

}
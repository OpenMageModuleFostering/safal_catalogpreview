<?php
class Safal_Catalogpreview_Model_Adminhtml_System_Config_Source_Alignment
{
    public function toOptionArray()
    {
        return array(
            array('value' => 0, 'label'=>Mage::helper('adminhtml')->__('Left')),
            array('value' => 1, 'label'=>Mage::helper('adminhtml')->__('Center')),
        	array('value' => 2, 'label'=>Mage::helper('adminhtml')->__('Right')),
        );
    }
}

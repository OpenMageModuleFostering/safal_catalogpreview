<?php
class Safal_Catalogpreview_Model_Adminhtml_System_Config_Source_Position
{
    public function toOptionArray()
    {
        return array(
            array('value' => 1, 'label'=>Mage::helper('adminhtml')->__('Top')),
            array('value' => 0, 'label'=>Mage::helper('adminhtml')->__('Bottom')),
        );
    }
}

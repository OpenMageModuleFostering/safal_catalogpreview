<?php
class Safal_Catalogpreview_Model_Adminhtml_System_Config_Source_Imagescope
{
    public function toOptionArray()
    {
    	$attributeInfo = Mage::getResourceModel('eav/entity_attribute_collection')
    	->setFrontendInputTypeFilter('media_image');
    	$attrs = array();
    	foreach($attributeInfo->getData() as $attr){
    		$attrs[] = array('value' => $attr['attribute_code'], 'label'=>$attr['frontend_label']);
    	}
        return $attrs;
    }
}

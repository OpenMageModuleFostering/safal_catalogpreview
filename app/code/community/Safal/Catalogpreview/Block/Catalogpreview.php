<?php
class Safal_Catalogpreview_Block_Catalogpreview extends Mage_Core_Block_Template
{
	public function canShowPreview()
	{
		if($this->getRequest()->getControllerName() == "category" && $this->getRequest()->getModuleName() == "catalog"){
			$currentcategory = Mage::registry('current_category');
			$categories = array_filter(array_unique(explode(",",$this->helper('catalogpreview')->getConfig('catalogpreview/general/selectcategory'))));
			if(count($categories) == 1 && in_array(2,$categories)){
				return true;
			}
			if(count($categories)){
				if(in_array($currentcategory->getId(),$categories)){
					return true;
				}
			}
			else{
				return true;
			}
			if(in_array($currentcategory->getId(),$categories)) return true;
			
			return false;
		}
		else{
			return true;
		}
	}
}
?>
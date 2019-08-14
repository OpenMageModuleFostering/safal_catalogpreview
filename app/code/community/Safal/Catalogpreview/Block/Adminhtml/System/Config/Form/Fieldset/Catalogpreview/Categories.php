<?php
class Safal_Catalogpreview_Block_Adminhtml_System_Config_Form_Fieldset_Catalogpreview_Categories extends Mage_Adminhtml_Block_System_Config_Form_Fieldset{
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
    	$html = "";
    	$javaScript = "
            <script type=\"text/javascript\">
            	var wn = null;
                Event.observe('selectcategoriesbtn', 'click', function(event) {
                	var url = '".$this->getUrl('catalogpreview/adminhtml_catalogpreview/selectcategories',array('category_ids'=>$element->getValue(),"form_key"=>Mage::getSingleton('adminhtml/session')->getFormKey()))."';
		    		wn = new Window('categoryWindow',{className:'magento',draggable:false,title:'Select Categories',minimizable:false,maximizable:false,destroyOnClose:true});
		    		wn.setURL(url);
		    		wn.setSize('500px','450px');
		    		wn.showCenter();
		    		wn.show();
		    		wn.setCloseCallback(function(){
		    			try{
			    			var iframe= $('categoryWindow_content');
							var idoc= iframe.contentDocument || iframe.contentWindow.document;
							var iwin= iframe.contentWindow || iframe.contentDocument.defaultView;
							iwin.Element.extend(idoc); // use the copy of Prototype in the iframe's window
							$('".$element->getId()."').value = idoc.getElementById('product_categories').value;
							return true;
						}
						catch(e){
							alert(e);
							return false;
						}
    				});
		    		Event.stop(event);
                });
            </script>";
    	$html .= '</script>';
		$html .= "<label style='float: left; width: 210px;'>Select category</label><div class='form-list'><button id='selectcategoriesbtn' type='button'><span><span>Select Categories</span></span></button><p class='note' style='float: left; width: 100%; margin-left: 210px;'><span>Select categories to display popup on specific categories.</span></p><div>";
		$html .= "<input type='hidden' name='".$element->getName()."' id='".$element->getId()."' value='".$element->getValue()."'/>";
		$html .= "<style type='text/css'>.dialog {background: none repeat scroll 0 0 #FFFFFF;padding-bottom: 25px;border: 1px solid #555555;position: absolute;z-index: 10000 !important;}.magento_title {font: bold 12px/24px Arial,Helvetica,sans-serif;}.magento_nw {height: 8px;}.magento_n {height: 8px;}.magento_ne {height: 8px;}.table_window{width:100%;}</style>";
		$html .= $javaScript;
		return $html;
    }
}

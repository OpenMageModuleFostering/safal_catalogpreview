<?php
class Safal_Catalogpreview_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function getConfig($path)
	{
		$store = Mage::app()->getStore()->getId();
		if($path){
			return Mage::getStoreConfig($path,$store);
		}
		return Mage::getStoreConfig("catalogpreview/",$store);
	}
	public function isEnable()
	{
		return $this->getConfig("catalogpreview/general/enabled");
	}
	public function getStyle()
	{
		$configs = $this->getConfig("catalogpreview/style");
		$align = "";
		if($configs['titlealign'] == 0)
			$align = "left";
		
		elseif($configs['titlealign'] == 1)
			$align = "center";
		
		else 
			$align = "right";
		
		$css = "div#preview {
		    background-color: ".$configs['backgroundcolor'].";
		    border: ".$configs['borderwidth']."px solid ".$configs['bordercolor'].";
		    color: ".$configs['titlecolor'].";
		    display: none;
		    font-size: ".$configs['titlefontsize']."px;
		    font-weight: ".($configs['titlebold']? "bold" : "normal").";
		    padding: ".$configs['previewpadding']."px;
		    position: absolute;
		    text-align: ".$align.";
		    width: ".$configs['previewwidth']."px;
		    z-index: ".$configs['previewzindex'].";
		}";
		return $css;
	}
	public function getProductRel(Mage_Catalog_Model_Product $_product)
	{
		if(!$_product->getImage()){
			$_product = Mage::getModel('catalog/product')->load($_product->getId());
		}
		if($_product && Mage::helper('catalogpreview')->isEnable()){
			try{
				$configs = $this->getConfig("catalogpreview/style");
				return Mage::helper('catalog/image')->init($_product, $this->getConfig("catalogpreview/general/imagescope"))->resize($configs['previewwidth']);
			}
			catch(Exception $e){
				Mage::log($e->getMessage());
				return;
			}
		}
	}
	public function getConfigJson()
	{
		$configs = $this->getConfig("catalogpreview/style");
		return json_encode(array("show"=>$configs['title'],"position"=>$configs['titleposition']));
	}
}
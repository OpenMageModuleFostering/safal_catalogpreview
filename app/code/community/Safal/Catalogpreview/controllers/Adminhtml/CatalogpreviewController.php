<?php
class Safal_Catalogpreview_Adminhtml_CatalogpreviewController extends Mage_Adminhtml_Controller_Action
{
	public function selectcategoriesAction()
	{
		$this->loadLayout();
		$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
		$this->renderLayout();
	}
	public function categoriesJsonAction()
	{	
		$this->getResponse()->setBody(
				$this->getLayout()->createBlock('catalogpreview/adminhtml_categories')
				->getCategoryChildrenJson($this->getRequest()->getParam('category'))
		);
	}
}
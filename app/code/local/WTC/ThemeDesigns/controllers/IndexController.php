<?php

class WTC_ThemeDesigns_IndexController extends Mage_Adminhtml_Controller_action
{

	
	

	public function indexAction() 
	{
		$dir = $_POST['dir'];
		
		$optionsData  = new WTC_ThemeDesigns_Model_System_Config_Source_Dropdown_Themes;
		$data = $optionsData->toOptionArray($dir);
		$designData = '<option value="">Please Select Option</option>';
		foreach($data as $html)
		{
			
			$designData .= '<option value="'.$html.'">'.$html.'</option>';
		}
		$skinData = '<option value="">Please Select Option</option>';
		$skinhtml = $this->getSkinDirectory($dir);
		foreach($skinhtml as $html)
		{
			$skinData .= '<option value="'.$html.'">'.$html.'</option>';
		}
		$htmlData = array($designData,$skinData);
		echo json_encode($htmlData);
		
	}
	
	public function getSkinDirectory($dir)
	{
		$path = getcwd().'/skin/frontend/'.$dir.'/';
		if($dir)
		{
			$results = scandir($path);
			foreach ($results as $result) 
			{
				if ($result === '.' or $result === '..') continue;

				if (is_dir($path . '/' . $result)) 
				{
					$packages[] = $result;
				}
			}
		}
		return $packages;
	}
}

<?php   
class WTC_ThemeDesigns_Model_System_Config_Source_Dropdown_Layout
{ 
	public function toOptionArray($dir)
    {
		$path = getcwd().'/app/design/frontend/'.$dir.'/';
		$package = Mage::app()->getWebsite()->getConfig('design/package/name');
		$configTemplates = Mage::app()->getWebsite()->getConfig('design/theme/template');
		$configSkin = Mage::app()->getWebsite()->getConfig('design/theme/skin');
		$configLayout = Mage::app()->getWebsite()->getConfig('design/theme/layout');
		$configDefault = Mage::app()->getWebsite()->getConfig('design/theme/default');
		
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
		else if(empty($dir)  && $configLayout)
		{
			$dir['value'] = $configLayout;
			$dir['label'] = $configLayout;
			$packages[] = $dir;
			$path = getcwd().'/app/design/frontend/'.$package;
			$results = scandir($path);
			foreach ($results as $result) 
			{
				if ($result === '.' or $result === '..') continue;

				if (is_dir($path . '/' . $result) && $result != $configDefault) 
				{
					$packages[] = $result;
				}
			}
		
		}
		else
		{
			$dir['value'] = '';
			$dir['label'] = 'Please Select Options';
			$packages[] = $dir;
		}
		return $packages;
    }
		
}

<?php   
class WTC_ThemeDesigns_Model_System_Config_Source_Dropdown_Packages
{  
	public function toOptionArray()
    {
		$path = getcwd().'/app/design/frontend';
		
		$results = scandir($path);

		foreach ($results as $result) 
		{
			if ($result === '.' or $result === '..') continue;

			if (is_dir($path . '/' . $result)) {
				
				$dir['value'] = $result;
				$dir['label'] = $result;
				$dir['selected'] = 'selected';
				$packages[] = $dir;
			}
		}
		return $packages;
    }		
}















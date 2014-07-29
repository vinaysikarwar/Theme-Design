<?php
class WTC_ThemeDesigns_Model_System_Config_Backend_Serialized extends Mage_Core_Model_Config_Data
{
    protected function _afterLoad()
    {
        if (!is_array($this->getValue())) {
            $value = $this->getValue();
            $this->setValue(empty($value) ? false : unserialize($value));
        }
    }
 
    protected function _beforeSave()
    {
		$groups = $_POST['groups'];
		$config = new Mage_Core_Model_Config();
		foreach($groups as $group)
		{
			$packageName = $group['fields']['pn']['value'];
			if($packageName)
			{
				$config ->saveConfig('design/package/name', $packageName, 'default', 0);
			}
			$templates = $group['fields']['templates']['value'];
			if($templates)
			{
				$config ->saveConfig('design/theme/template', $templates, 'default', 0);
			}
			$skin = $group['fields']['skin']['value'];
			if($skin)
			{
				$config ->saveConfig('design/theme/skin', $skin, 'default', 0);
			}
			$layout = $group['fields']['layout']['value'];
			if($layout)
			{
				$config ->saveConfig('design/theme/layout', $layout, 'default', 0);
			}
			$default = $group['fields']['default']['value'];
			if($default)
			{
				$config ->saveConfig('design/theme/default', $default, 'default', 0);
			}
		}
    }
}
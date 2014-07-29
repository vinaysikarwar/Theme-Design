<?php   
class WTC_ThemeDesigns_Block_Adminhtml_System_Config_Form_Field_Options extends Mage_Adminhtml_Block_System_Config_Form_Field
{   /**
     * Generate HTML code for color picker
     *
     * @param Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
		$configValue = Mage::app()->getWebsite()->getConfig('design/package/name');
		
        $url = Mage::getBaseUrl().'themedesign/';
        $html = '<script type="text/javascript">';
		$html .= 'window.onload=function(){ var select = document.getElementById("themedesign_sp_pn") ;';
		$html .= 'var option;';
		$html .= 'for (var i=0; i<select.options.length; i++) {';
		$html .= 'option = select.options[i];';
		$html .= 'if (option.value == "'.$configValue.'") {';
		$html .= 'option.selected = true;';
		$html .= '}';
		$html .= '}';
		$html .= '};';
		$html .= 'function changeOptions(value) ';
		$html .= '{ ';
		$html .= 'new Ajax.Request("'.$url.'" , {';
		$html .= "method: 'post',parameters: { dir: value }, ";
		$html .= 'onSuccess: function(transport) { var response = transport.responseText;';
		$html .= 'if(response) { var template = document.getElementById("themedesign_st_templates") ; ';
		$html .= 'var layout = document.getElementById("themedesign_st_layout") ;';
		$html .= 'var defaulttheme = document.getElementById("themedesign_st_default") ;';
		$html .= 'var skin = document.getElementById("themedesign_st_skin") ;';
		$html .= 'var result = JSON.parse(response);';
		$html .= 'template.innerHTML = result[0];';
		$html .= 'layout.innerHTML = result[0];';
		$html .= 'defaulttheme.innerHTML = result[0];';
		$html .= 'skin.innerHTML = result[1];';
		$html .= '}';
		$html .= 'else { alert ("No record found,please check the code base")';
		$html .= '} } }); }';
		$html .= '</script>';
		
        // Use Varien text element as a basis
        $input = new Varien_Data_Form_Element_Select();
		$array  = new WTC_ThemeDesigns_Model_System_Config_Source_Dropdown_Packages;
		
		$values = $array->toOptionArray($path);
        // Set data from config element on Varien text element
        $input->setForm($element->getForm())
            ->setElement($element)
            ->setValues($values)
			->setonchange('changeOptions(this.value)')
            ->setHtmlId($element->getHtmlId())
            ->setName($element->getName())
            ->addClass('custom_package_option'); // Add some Prototype validation to make sure color code is correct

        // Inject uddated Varien text element HTML in our current HTML
        $html .= $input->getHtml();

        // Inject Procolor JS code to display color picker
        //$html .= $this->_getProcolorJs($element->getHtmlId());

        // Inject Prototype validation
        //$html .= $this->_addHexValidator();

        return $html;
    }
}

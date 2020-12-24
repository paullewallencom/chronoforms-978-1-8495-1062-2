<?php
/**
 * ** Packt Publishing **
 * ChronoForms 3.1 for Joomla! Site Cookbook
 * Chapter 3 'Styling your Form'
 * Code examples
 * 
 * @author: Bob Janes info@greyhead.net
 * @copyright 2010 Bob Janes
 */
?>

<?php
/** 
 * Recipe: Using ChronoForms default style  
 *
 * Example of ChronoForms Form HTML
 * Source : Form Editor | Form Code tab | Form HTML
 */
?>
<div class="form_item">
  <div class="form_element cf_textbox">
    <label class="cf_label" style="width: 150px;">
        Click Me to Edit</label>
    <input class="cf_inputbox" maxlength="150" size="30" 
        title="" id="text_2" name="text_2" type="text" />
  </div>
  <div class="cfclear">&nbsp;</div>
</div>

<?php
/** 
 * Recipe: Switching styles with 'Transform Form' 
 *
 * Example of ChronoForms Form HTML from another theme
 * Source : Form Editor | Form Code tab | Form HTML
 */
?>
<div class="cf_item">
  <h3 class="cf_title" style="width: 150px;">
    Click Me to Edit</h3>
  <div class="cf_fields">
    <input name="text_2" type="text" value="" 
      title="" class="cf_inputtext cf_inputbox" 
      maxlength="150" size="30" id="text_2" />
    <br />
    <label class="cf_botLabel"></label>
  </div>
</div>

<?php
/** 
 * Recipe: Adding your own CSS styling  
 *
 * Sample Form HTML with added CSS style
 * Used in : Form Editor | Form Code tab | Form HTML
 */
?>
<input name="text_2" type="text" value="" 
    title="" class="cf_inputtext cf_inputbox" 
    maxlength="150" size="30" id="text_2" 
    style=""border: 1px solid blue;" />

<?php
/** 
 * Recipe: Adding your own CSS styling  
 *
 * Sample CSS for use with the above HTML
 * Used in : Form Editor | Form Code tab | Form CSS
 */
?>
cf_inputbox { 
  border:order : 1px solid blue; 
} 

<?php
/** 
 * Recipe: Adding your own CSS styling  
 *
 * Example of element code from a ChronoForms theme 
 * Source : components/com_chronocontact/themes/theme_name/elements.php
 */
?>
<!--start_cf_textbox-->
<div class="form_item">
  <div class="form_element cf_textbox">
    <label class="cf_label"{cf_labeloptions}>{cf_labeltext}</label>
    <input class="{cf_class}" maxlength="{cf_maxlength}" size="{cf_size}" title="{cf_title}" id="{cf_id}" name="{cf_name}" type="{cf_type}" />
  {cf_tooltip}
  </div>
  <div class="cfclear">&nbsp;</div>
</div>
<!--end_cf_textbox-->

<?php
/** 
 * Recipe: Adding your own CSS styling | There's more . . . | Browser sniffing
 *
 * Example of Joomla! code to detect the browser type
 * Used in : Form Editor | Form Code tab | Form HTML
 */

if ( !$mainframe->isSite() ) { return; }
jimport('joomlaJoomla!.environment.browser'); 
$browser = JBrowser::getInstance(); 

if ( $browser->getBrowser() == 'msie' ) {
  $css_file = 'url_of_css_file_for_ie_browsers';
} else { 
  $css_file = 'url_of_css_file_for_other_browsers';
}

$doc =& JFactory::getDocument();
$doc->addStyleSheet($css_file);
?>

<?php
/** 
 * Recipe: Adding your own CSS styling | There's more . . . | Conditional CSS
 *
 * Example of PHP code to change styling depending on Form results
 * Used in : Form Editor | Form Code tab | OnSubmit After email
 */

$boy_or_girl =  JRequest::getString('boy_or_girl', 'boy', 'post');

switch ( $boy_or_girl ) {
  case 'boy':
  default:
    $color = '#8888FF';
  break;
  case 'girl':
    $color = '#FF8888';
  break;
}

$style = "
div.boy_or_girl {
  background-color: $color ;
}
";
$doc =& JFactory::getDocument();
$doc->addStyleDeclaration($style); 
?>
<div class='boy_or_girl'> . . . </div>

<?php
/** 
 * Recipe: Adding your own HTML
 *
 * Example of Inputs arranged in a row using a table
 * Used in : Form Editor | Form Code tab | Form HTML
 */
?>
<table>
  <tr> 
    <td>
      <label class="cf_label" style="width:150px;" >
        Date</label>
    </td>
    <td>
      <input class="cf_inputbox" maxlength="4" size="4" 
        title="" id="text_0" name="text_0" type="text" />
    </td>
    <td>
      <input class="cf_inputbox" maxlength="4" size="4" 
        title="" id="text_1" name="text_1" type="text" />
    </td>
    <td>
      <input class="cf_inputbox" maxlength="4" size="4" 
        title="" id="text_2" name="text_2" type="text" />
    </td>
  </tr>
</table> 
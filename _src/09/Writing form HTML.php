<?php
/**
 * ** Packt Publishing **
 * ChronoForms 3.1 for Joomla! Site Cookbook
 * Chapter 9 'Writing form HTML'
 * Code examples
 * 
 * @author: Bob Janes info@greyhead.net
 * @copyright 2010 Bob Janes
 */
?>

<?php
/** 
 * Recipe: Moving an existing form to ChronoForms 
 *
 * Example code from a Google search page
 * Source: Google.com
 */
?>
<form action="/search" name=f onsubmit="google.fade=null">
    <table cellpadding=0 cellspacing=0>
       	<tr valign=top>
            <td width=25%>&nbsp;</td>
            <td align=center nowrap>
                <input type=hidden name=rls value="ig">
                <input name=hl type=hidden value=en>
                <input name=source type=hidden value=hp>
                <input autocomplete="off"  onblur="google&&google.fade&&google.fade()" maxlength=2048 name=q size=55 class=lst title="Google Search" value="">
                <br>
                <input name=btnG type=submit value="Google Search" class=lsb onclick="this.checked=1">
                <input name=btnI type=submit value="I&#39;m Feeling Lucky" class=lsb onclick="this.checked=1">
            </td>
            <td nowrap width=25% align=left id=sbl>
                <font size=-2>&nbsp;&nbsp;
                    <a href="/advanced_search?hl=en">Advanced Search</a>
                    <br>&nbsp;&nbsp;
                    <a href="/language_tools?hl=en">Language Tools</a>
                </font>
            </td>
        </tr>
    </table>
</form>


<?php
/** 
 * Recipes: Moving a form with JavaScript and/or CSS
 * (This snippet includes the changes from both recipes)
 *
 * Form code to create a Google custom search box
 * Used in : Form Editor | Form Code tab | Form HTML
 */

if ( !$mainframe->isSite() ) { return; }
$doc =& JFactory::getDocument();
$doc->addScript('http://www.google.com/jsapi');
$script = "
  google.load('search', '1', {language : 'en'});
  google.setOnLoadCallback(function(){
    var customSearchControl = new 
      google.search.CustomSearchControl( 
      '009999999999999999999:0aaaaaaa010' );
    customSearchControl.setResultSetSize( 
      google.search.Search.FILTERED_CSE_RESULTSET );
    customSearchControl.draw('cse');
  }, true); 
";
$doc->addScriptDeclaration($script);
$doc->addStyleSheet( 'http://www.google.com/cse/style/look/minimalist.css');
?>
<div id="cse" style="width: 100%;">Loading</div>

<?php
/** 
 * Recipes: Moving a form with CSS
 * There's more . . . | Loading browser specific CSS files into the page head
 *
 * PHP code to load CSS files depending on the browser
 * Used in : Form Editor | Form Code tab | Form HTML
 */

if ( !$mainframe->isSite() ) { return; }
jimport('joomlaJoomla!.environment.browser');
$browser = JBrowser::getInstance();

switch ( $browser->getBrowser() ) {
	case 'msie': 
		// Browser is Internet Explorer
		$style = 'shiny.css';
    	break;
  	case 'mozilla': 
		// Browser is FireFox
		$style = 'minimalist.css';
		break;
  	case 'konqueror': 
		// browser is Safari or Chrome
		$style = 'bubblegum.css';
		break;
  	default:
		// browser is something else
		$style = 'default.css';
}
$doc =& JFactory::getDocument();
$doc->addStyleSheet( 'http://www.google.com/cse/style/look/'.$style);
?>

<?php
/** 
 * Recipes: Creating a form with Wufoo 
 *
 * PHP code for the beginning and end of the Form HTML
 * Used in : Form Editor | Form Code tab | OnSubmit Before Email
 */

// Begin : code for the start of the Form HTML
if ( !$mainframe->isSite()) { return; }

// define a url for the 'wufoo' folder
$wufoo_url = JURI::base()
  .'components/com_chronocontact/wufoo/';

// define a path for the 'wufoo' folder
$wufoo_path = JPATH_SITE.DS
  .DS.'components'.DS.'com_chronocontact'.DS.'wufoo'.DS;
$styles = $scripts = array();

// access the JoomlaJoomla! Document object
$doc =& JFactory::getDocument();

// Add the CSS files
$doc->addStyleSheet($wufoo_url.'css/structure.css');
$doc->addStyleSheet($wufoo_url.'css/form.css');

// Uncomment the next line to include a theme
//$doc->addStyleSheet($wufoo_url.'css/theme.css'); 

// Add the JavaScript file
$doc->addScript($wufoo_url.'scripts/wufoo.js');
?>
// End : code for the start of the Form HTML

// . . . main from code goes here

// Begin : code for the end of the Form HTML
</div> <!--container-->
<img id="bottom" src="<?php echo $wufoo_url; ?>images/bottom.png" alt="" />

<a href="http://wufoo.com" title="Designed with Wufoo">
  <img src="http://wufoo.com/images/powerlogo.png" alt="Designed with Wufoo">
</a>
// End : code for the end of the Form HTML

// Hack for the form.css file (around line 584)
form li.focused .instruct, form li:hover .instruct{
  left:50%; /* Prevent scrollbars for IE Instruct fix */
  visibility:visible;
}

// Changes to the wufoo.js file
// about line 10
addEventWu(activeForm, 'submit', disableSubmitButton);

// about ten lines from the end
function addEventWu( obj, type, fn ) {

// Near the beginning
function handleInput() {};
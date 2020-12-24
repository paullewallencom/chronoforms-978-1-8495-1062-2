<?php
/**
 * ** Packt Publishing **
 * ChronoForms 3.1 for Joomla! Site Cookbook
 * Chapter 11 'Using Form Plugins '
 * Code examples
 * 
 * @author: Bob Janes info@greyhead.net
 * @copyright 2010 Bob Janes
 */
?>

<?php
/** 
 * Recipe: Creating multi-lingual forms with the Multi-language plug-in 
 *
 * Example of form code
 * Source : Form Editor | Form Code tab | Form HTML
 */

?>
<div class="form_item">
  	<div class="form_element cf_heading">
    	<h2 class="cf_text">Subscribe to our newsletter</h2>
  	</div>
 	 <div class="cfclear">&nbsp;</div>
</div>

<div class="form_item">
  	<div class="form_element cf_text"><span class="cf_text">Please enter your name and email address in the boxes below.</span> </div>
  	<div class="cfclear">&nbsp;</div>
</div>

<div class="form_item">
  	<div class="form_element cf_textbox">
    	<label class="cf_label" style="width: 150px;">Name</label>
    	<input class="cf_inputbox" maxlength="150" size="30"  title="" id="text_0" name="name" type="text" />
  	</div>
  	<div class="cfclear">&nbsp;</div>
</div>

<div class="form_item">
  	<div class="form_element cf_textbox">
    	<label class="cf_label" style="width: 150px;">Email</label>
    	<input class="cf_inputbox" maxlength="150" size="30" title="" id="text_1" name="email" type="text" />
  	</div>
  	<div class="cfclear">&nbsp;</div>
</div>

<div class="form_item">
  	<div class="form_element cf_button">
   		<input value="Submit" name="button_2" type="submit" />
  	</div>
 	<div class="cfclear">&nbsp;</div>
</div>

<?php
/** 
 * Recipe: Creating multi-lingual forms with the Multi-language plug-in 
 * There's more . . . | Translating more complicated code
 *
 * PHP code to switch between languages
 * Use in : Form Editor | Form Code tab | Form HTML
 */

$lang =& JFactory::getLanguage();
$cf_tag =& $lang->getTag();
switch ( $cf_tag ) {
	case 'en-GB':
	default:
		 // use English
		 break;
	case 'fr-FR':
		// use French
		break;
	case 'pt-BR':
		// use Brazilian Portuguese
		break;
}
?>


<?php
/** 
 * Recipe: Showing and editing saved information with the Profile plug-in 
 *
 * Example HTML for the Profile Plug-in
 * Use in : Form Editor | Form Code tab | Form HTML
 */
?>
<div class="form_item">
    <div class="form_element cf_heading">
    	<h2 class="cf_text">Subscribe to our newsletter</h2>
    </div>
    <div class="cfclear">&nbsp;</div>
</div>
<div class="form_item">
    <div class="form_element cf_textbox">
        <label class="cf_label" style="width: 150px;">Name</label>
        {name} 
    </div>
    <div class="cfclear">&nbsp;</div>
</div>
<div class="form_item">
    <div class="form_element cf_textbox">
        <label class="cf_label" style="width: 150px;">Email</label>
        {email} 
    </div>
    <div class="cfclear">&nbsp;</div>
</div>
<!-- Optional additional lines for the editable version --> 
<!-- insert submit button code here -->
<input type="hidden" name="cf_id" /> 

<?php
/** 
 * Recipe: Registering users with the Joomla! Registration plug-in 
 *
 * Hacked code for the standard Joomla Registration module
 * Use in : components\com_user\views\register\tmpl\default.php
 */

// no direct access
defined('_JEXEC') or die('Restricted access');
$mainframe->redirect( JURI::base().'index.php?option=com_chronocontact&chronoformname=register_1');
?>

<?php
/** 
 * Recipe: Registering users with the Joomla! Registration plug-in 
 * There's more | Creating a 'silent' registration
 *
 * Code snippet to set values for 'name' and 'username'
 * Use in : Joomla! Registration Plugin | Extra Code Before Registration
 */
 
$email = JRequest::getString('email', '', 'post');
JRequest::setVar('name', $email);
JRequest::setVar('username', $email);
?>

<?php
/** 
 * Recipe: Registering users with the Joomla! Registration plug-in 
 * There's more | Creating a 'Name' from other field inputs
 *
 * Code snippet to set values for 'name' and 'username'
 * Use in : Joomla! Registration Plugin | Extra Code Before Registration
 */
 
$first_name = JRequest::getString('first_name', '', 'post');
$last_name = JRequest::getString('last_name', '', 'post');
$name = $first_name.' '.$last_name;
JRequest::setVar('name', $name);
?>

<?php
/** 
 * Recipe: Registering users with the Joomla! Registration plug-in 
 * There's more | Creating a Username from other fields
 *
 * Code snippet to set values for 'name' and 'username'
 * Use in : Joomla! Registration Plugin | Extra Code Before Registration
 */
 
$first_name = JRequest::getCmd('first_name', '', 'post');
$last_name = JRequest::getCmd('last_name', '', 'post');
$username = $last_name.$first_name;
// add a random integer between 100 and 999
$username .= mt_rand(100, 999);
JRequest::setVar('username', $username);
?>

<?php
/** 
 * Recipe: Registering users with the Joomla! Registration plug-in 
 * There's more | Changing User parameters
 *
 * Code snippet to set values for TimeZone & Gender parameters
 * Use in : Joomla! Registration Plugin | Extra Code Before Registration
 */
 
$user =& JFactory::getUser();
$user->setParam('timezone', -10);
$user->save();
?>

<?php
$gender = JRequest::getString('gender', '', 'post');
$user =& JFactory::getUser();
$user->setParam('gender', $gender);
$user->save();
?>

<?php
/** 
 * Recipe: Creating a PayPal purchase form with the ReDirect plug-in
 *
 * Example code for a PayPal 'Buy Now' button
 * Source : PayPal.com
 */
?>

<form name="_xclick" method="post" action="https://www.paypal.com/cgi-bin/webscr" >
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="me@mybusiness.com">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="item_name" value="Teddy Bear">
    <input type="hidden" name="amount" value="12.99">
    <input type="image"  src="http://www.paypal.com/en_US/i/btn/btn_buynow_LG.gif" border="0" name="submit" 
        alt="Make payments with PayPal – it's fast, free and secure!">
</form>

<?php
/** 
 * Recipe: Creating a PayPal purchase form with the ReDirect plug-in
 *
 * PHP code to set the 'amount' to be charged
 * Use in : ReDirect Plugin | Extra Code
 */
 
// set the price & discount rate
$price = 12.99;
$user_discount = 0.20;
// get the User object
$user =& JFactory::getUser();
// Check if this is a logged in user
if ( $user->id ) {
	// if it is then apply the discount
	$price = $price*(1 - $user_discount);
	$price = round($price, 2);
}
// set the price in the 'amount' field
JRequest::setVar('amount', $price);
?>
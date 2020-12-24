<?php
/**
 * ** Packt Publishing **
 * ChronoForms 3.1 for Joomla! Site Cookbook
 * Chapter 10 'Creating common Forms'
 * Code examples
 * 
 * @author: Bob Janes info@greyhead.net
 * @copyright 2010 Bob Janes
 */
?>

<?php
/** 
 * Recipe: Creating a 'Contact Us' form 
 *
 * PHP code to turn off a Dynamic CC in an email
 * Used in : Form Editor | Form Code tab | OnSubmit Before Email
 */

$MyForm =& CFChronoForm::getInstance();
$MyFormEmails =& CFEMails::getInstance($MyForm->formrow->id);
$copy =& JRequest::getBool('check0', false, 'post');
if ( !$copy ) {
  $MyFormEmails->setEmailData(1, 'dcc', '');
}
?>

<?php
/** 
 * Recipe: Creating a 'Contact Us' form 
 * There's more . . . 
 *
 * PHP code to include User info in a form
 * Used in : Form Editor | Form Code tab | Form HTML
 */

if ( !$mainframe->isSite() ) {return; }
// set the id we want
$id = 1;
// build the database query
$db = &JFactory::getDBO();
$query = "
	SELECT *
   		FROM `#__contact_details`
    	WHERE `id` = $id ;
";
$db->setQuery($query);
// load the results for our contact
$contact = $db->loadObject();
?>
<div class="form_item">
	<div class="form_element cf_textbox">
    	<label style="width: 150px;" class="cf_label">Name</label>
    	<?php echo $contact->name; ?>
  	</div>
  	<div class="form_element cf_textbox">
    	<label style="width: 150px;" class="cf_label">Phone</label>
    	<?php echo $contact->telephone; ?>
  	</div>
  	<div class="cfclear">&nbsp;</div>
</div>

<?php
/** 
 * Recipe: Creating a multi-page form 
 * There's more . . . 
 *
 * PHP code to recover saved form data from the User session
 * Used in : Form Editor | Form Code tab | Form HTML
 */

if ( !$mainframe->isSite() ) { return; }
$formname =& JRequest::getString('chronoformname', '', 'post');
$session =& JFactory::getSession();
$posted = $session->get('chrono_formpages_data_'.$formname, array(), md5('chrono'));
?>
<div>You entered <b><?php echo $posted['product']; ?></b></div>

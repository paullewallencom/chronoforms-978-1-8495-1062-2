<?php
/**
 * ** Packt Publishing **
 * ChronoForms 3.1 for Joomla! Site Cookbook
 * Chapter 4 'Saving Form Data in the Database'
 * Code examples
 * 
 * @author: Bob Janes info@greyhead.net
 * @copyright 2010 Bob Janes
 */
?>

<?php
/** 
 * Recipe: Creating a table to save your results and link your form to it 
 *
 * Example of Form HTML with updated 'name' & 'id' attributes
 * Used in : Form Editor | Form Code tab | Form HTML
 */
?>
<input class="cf_inputbox" maxlength="150" size="30" 
  title="" id="name" name="name" type="text" />
<input class="cf_inputbox" maxlength="150" size="30" 
  title="" id="email" name="email" type="text" />

<input value="accounts" title="" class="radio" id="dept0" 
  name="dept" type="radio" />
<input value="technical" title="" class="radio" id="dept1" 
  name="dept" type="radio" />
<input value="sales" title="" class="radio" id="dept2" 
  name="dept" type="radio" />

<input value="Submit" name="submit" type="submit" />


<?php
/** 
 * Recipe: Creating a table to save your results and link your form to it 
 *
 * Example of 'Autogenerated code'
 * Source : Form Editor | Autogenerated code tab | Autogenerated code
 */

// get the settings info for this form
$MyForm =& CFChronoForm::getInstance("newsletter_signup");

// Check the DB Connection is set to 'Yes'
if ( $MyForm->formparams("dbconnection") == "Yes" ){

	// get the User info
	$user = JFactory::getUser();
	JRequest::setVar( "cf_user_id", JRequest::getVar( "cf_user_id", $user->id, "post",     "int", "" ));
	
	// create the random uid string
	$row =& JTable::getInstance("chronoforms_newsletter_signup", "Table");
	srand((double)microtime()*10000);
	$inum	=	"I" . substr(base64_encode(md5(rand())), 0, 16).md5(uniqid(mt_rand(), true));
	JRequest::setVar( "uid", JRequest::getVar( "uid", $inum, "post", "string", "" ));
	
	// get the current date and time
	JRequest::setVar( "recordtime", JRequest::getVar( "recordtime", date("Y-m-d")." - ".date("H:i:s"), "post", "string", "" ));
	
	// get the user's IP address 
	JRequest::setVar( "ipaddress", JRequest::getVar( "ipaddress", $_SERVER["REMOTE_ADDR"], "post", "string", "" ));
	
	JRequest::setVar( "cf_user_id", JRequest::getVar( "cf_user_id", $user->id, "post", "int", "" )); 
	
	//get the information submitted in the form
	$post = JRequest::get( "post" , JREQUEST_ALLOWRAW );
	
	// link the data to the database table
	if (!$row->bind( $post )) {
		JError::raiseWarning(100, $row->getError());
	}
	
	// store the data in the database table
	if (!$row->store()) {
		JError::raiseWarning(100, $row->getError());
	}
	
	// save the results in a temporary object
	$MyForm->tablerow["jos_chronoforms_newsletter_signup"] = $row;
}
?>

<?php
/** 
 * Recipe: Updating and changing DB Connections 
 *
 * Form HTML to input a two letter 'State' code
 * Used in : Form Editor | Form Code tab | Form HTML
 */
?>
<div class="form_item">
	<div class="form_element cf_textbox">
    	<label class="cf_label" style="width: 150px;">State</label>
    	<input class="cf_inputbox" maxlength="2" size="2" title="" id="state" name="state" type="text" />
    </div>
    <div class="cfclear">&nbsp;</div>
</div>
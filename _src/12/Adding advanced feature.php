<?php
/**
 * ** Packt Publishing **
 * ChronoForms 3.1 for Joomla! Site Cookbook
 * Chapter 12 'Adding Advanced Features'
 * Code examples
 * 
 * @author: Bob Janes info@greyhead.net
 * @copyright 2010 Bob Janes
 */
?>

<?php
/** 
 * Recipe: Using PHP to create 'select' dropdowns  
 *
 * PHP code to create a drop-down list of articles
 * Used in : Form Editor | Form Code tab | Form HTML
 */

?>
<div class="form_item">
	<div class="form_element cf_dropdown">
		<label class="cf_label" style="width: 150px;">Articles</label>
		<select class="cf_inputbox validate-selection" id="articles" size="1" name="articles">
			<option value=''>--?--</option>
<?php
if (!$mainframe->isSite() ) {return;}
$db =& JFactory::getDBO();
$query = "
	SELECT `id`, `title`
		FROM `#__content`
		WHERE `sectionid` = 1 AND `state` = 1 ;
";
$db->setQuery($query);
$options = $db->loadAssocList();
foreach ( $options as $o ) {
	echo "<option value='".$o[id]."'>".$o[title]."</option>";
}
?>
		</select>
	</div>
	<div class="cfclear">&nbsp;</div>
</div>

<?php
/** 
 * Recipe: Using PHP to create 'select' dropdowns 
 * There's more . . . | Creating numeric option lists 
 *
 * PHP function to create a drop-down with a numeric range
 * Used in : Form Editor | Form Code tab | Form HTML
 */

if (!$mainframe->isSite() ) {return;}
createRangeSelect('Day', 'day', 0, 31);
createRangeSelect('Month', 'month', 1, 12);
createRangeSelect('Year', 'year', 2000, 2020);
createRangeSelect('Hour', 'hour', 0, 24);
createRangeSelect('Minute', 'minute', 0, 60);
createRangeSelect('Second', 'second', 0, 60);
function createRangeSelect($label, $name, $start, $end) {
?>
<div class="form_item">
	<div class="form_element cf_dropdown">
		<label class="cf_label" style="width: 150px;"><?php echo $label; ?></label>
		<select class="cf_inputbox validate-selection" id="<?php echo $name; ?>" size="1" name="<?php echo $name; ?>">
			<option value=''>--?--</option>
<?php
	foreach ( range($start, $end) as $v ) {
		echo "<option value='$v'>$v</option>";
	}
?>
    	</select>
  	</div>
  	<div class="cfclear">&nbsp;</div>
</div>
<?php
}
?>

<?php
/** 
 * Recipe: Using PHP to create 'select' dropdowns 
 * There's more . . . | Creating a drop-down from an array
 *
 * PHP function to create a drop-down from an array
 * Used in : Form Editor | Form Code tab | Form HTML
 */
 
foreach ( $countries as $k => $v ) {
	echo "<option value='$k'>$v</option>";
}
?>

<?php
/** 
 * Recipe: Using Ajax to look up e-mail addresses 
 *
 * Example of Form HTML and JavaScript 
 * Used in : Form Editor | Form Code tab | Form HTML, Form JavaScript & Extra Code
 */
?>
<!-- Partial Form HTML -->
<div class="form_item">
    <div class="form_element cf_textbox">
        <label class="cf_label" style="width: 150px;">Email</label>
        <input class="cf_inputbox" maxlength="150" size="30" title="" id="email" name="email" type="text" />
    </div>
    <div class="cfclear">&nbsp;</div>
</div>
<!-- end of Form HTML -->

// Code for Form JavScript 
window.addEvent('domready', function() {
	// set the url to send the request to
	var url = 'index.php?option=com_chronocontact&chronoformname=form_name&task=extra&format=raw';
	var email = $('email');
	email.addEvent('blur', function() {
    	// clear any background color from the input
    	email.setStyle('background-color', 'white');
        // check that the email address is valid
        regex = /^([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})$/i;
        var value = email.value.trim();
        if ( value.length > 6 && regex.test(value) ) {
            // if all is well send the JSON request
            var jSonRequest = new Json.Remote(url, {
            	onComplete: function(r) {
                	// check the result and set the background color
                  	if ( r.email_ok ) {
                    	email.setStyle('background-color', 'green');
                  	} else {
                    	email.setStyle('background-color', 'red');
                  	}
                }
            }).send({'email': email.value});
        } else {
          	// if this isn't a valid email set background color red
          	email.setStyle('background-color', 'red');
        }
    });
});
// End of Form JavaScript

<?php
// Code for Extra Code
// clean up the JSON message
$json = stripslashes($_POST['json']);
$json = json_decode($json);
$email = strtolower(trim($json->email));
// check that the email field isn't empty
$response = false;
if ( $email ) {
	// Check the database
	$db =& JFactory::getDBO();
	$query = "
		SELECT COUNT(*)
			FROM `#__users`
			WHERE LOWER(`email`) = ".$db->quote($email).";
	";
	$db->setQuery($query);
	$response = (bool) !$db->loadResult();
}
$response = array('email_ok' => $response );
//send the reply
echo json_encode($response);
// stop the from running
$MyForm->stopRunning = true;
die;
?>

<?php
/** 
 * Recipe: Get information from a DB table to include in your form 
 *
 * Example of Form HTML (all are incomplete HTML)
 * Used in : Form Editor | Form Code tab | Form HTML
 */
?>

<!-- Example for text or hidden input -->
<input type='text' . . . value='<?php echo $cf_data->column_name; ?>' />
<input type='hidden' . . . value='<?php echo $cf_data->column_name; ?>' />

<!-- Example for textarea -->
<textarea . . . ><?php echo $cf_data->column_name; ?></textarea>

<!-- Example for radio buttons -->
<?php
$c1 = $c2 = '';
if ( $cf_data->column_name == 'xxx' ) {
	$c1 = "checked='checked'";
} elseif ( $cf_data->column_name == 'yyy' ) {
	$c2 = "checked='checked'";
}
?>
<input type='radio' value='xxx' . . . <?php echo $c1; ?> />
<input type='radio' value='yyy' . . . <?php echo $c2; ?> />

<!-- Example for checkboxes -->
<?php
// unpack the results into an array
$result_array = explode(',', $cf_data->column_name);
// create an array matching the check-boxes
$checkbox_array = array('1' => 'aaa', . . ., '6' => 'fff');
foreach ( $checkbox_array as $k => $v ) {
	if ( in_array($v, $result_array) {
		$c[$k] = "checked='checked'";
	} else {
		$c[$k] = "";
	}
}
?>
<input type='checkbox' value='aaa' . . . <?php echo $c[1]; ?> />
<input type='checkbox' value='bbb' . . . <?php echo $c[2]; ?> />
. . .
<input type='checkbox' value='fff' . . . <?php echo $c[6]; ?> />

<!-- Example for slect drop-down -->
<?php
foreach ( $countries as $k => $v ) {
    $s = '';
    if ( $country == $k ) {
    	$s = "selected='selected'";
    }
    echo "<option value='$k' $s >$v</option>";
}
?>

<?php
/** 
 * Recipe: Show a form in a light-box 
 *
 * Example of Form HTML
 * Used in : Form Editor | Form Code tab | Form HTML
 */
?>

<!-- Launcher Form HTML for use in a module -->
<!-- Form HTML -->
<?php
JHTML::_('behavior.modal'); 
?>
<a class="modal" href="index.php?option=com_chronocontact&amp;chronoformname=form_name&amp;tmpl=component" rel="{handler: 'iframe', size: {x: 400, y: 200}}" 
>Subscribe to our newsletter</a>
<!-- End of Form HTML -->

<!-- OnSubmit URL -->
http://example.com/index.php?option=com_chronocontact&amp;task=send&amp;chronoformname=form_name&amp;tmpl=component
<!-- End of OnSubmit URL -->

<!-- Main form code -->
<!-- On Submit After code -->
<div style='text-align:center; padding:12px;' >
	<h3>Thanks for subscribing</h3>
</div>
<!-- End of On Submit After code -->

<!-- Form HTML to detect if form is being called modally -->
<?php
if ( !$mainframe->isSite() ) { return; }
$modal = JRequest::getString('tmpl', 'false', 'get');
?>
<input type='hidden' id='modal' name='modal' value='<?php echo $modal; ?>' />
<!-- End of Form HTML to detect if form is being called modally -->

<!-- Form JavaSCript to change the form action -->
window.addEvent('domready', function() {
  var modal = $('modal').value;
  if ( modal == 'component' ) {
    var url = $('ChronoContact_test_form_29');
    var action = url.getProperty('action');
    url.setProperty('action', action+'&amp;tmpl=component');
  }
});
<!-- End of Form JavaSCript to change the form action -->

<?php
/** 
 * Recipe: Tracking site information 
 *
 * Example of Form HTML & OnSubmit code to track user
 * Used in : Form Editor | Form Code tab | Form HTML & On Submit 
 */
?>

<!-- Form HTML to get Article ID -->
<?php
if ( !$mainframe->isSite() ) { return; }
$article_id =& JRequest::getInt('id', '', 'get'); 
?>
<input type='hidden' name='article_id' value='<?php echo $article_id; ?>' /> 
<!-- End of Form HTML to get Article ID -->

<!-- On Submit code to look up Article Title -->
<?php
$article_id = JRequest::getInt('article_id', '', 'post');
if ( $article_id ) {
	$db =& JFactory::getDBO();
	$query = "
		SELECT `title`
			FROM `#__content`
			WHERE `id` = '$article_id';
	";
	$db->setQuery($query);
	$article_title = $db->loadResult();
}
?>
<!-- End of On Submit code to look up Article Title -->

<?php
/** 
 * Recipe: Controlling emails from form inputs 
 *
 * Example of Form HTML & OnSubmit code to control emails
 * Used in : Form Editor | Form Code tab | Form HTML & On Submit 
 */
?>

<!-- Form HTML to show checkboxes -->
<div class="form_item">
    <div class="form_element cf_checkbox">
    	<label class="cf_label" style="width: 150px;">Click Me to Edit</label>
        <div class="float_left">
            <input value="1" title="" class="radio" id="check00" name="check0[]" type="checkbox" />
            <label for="check00" class="check_label" >e-mail 1</label><br />
            <input value="2" title="" class="radio" id="check01" name="check0[]" type="checkbox" />
            <label for="check01" class="check_label" >e-mail 2</label><br />
            <input value="3" title="" class="radio" id="check02" name="check0[]" type="checkbox" />
            <label for="check02" class="check_label" >e-mail 3</label><br />
        </div>
    </div>
    <div class="cfclear">&nbsp;</div>
</div>
<!-- End of Form HTML to show checkboxes -->

<!-- On Submit code to enable emails -->
<?php
$MyFormEmails =& CFEMails::getInstance($MyForm->formrow->id);
$check0 = JRequest::getString('check0', '', 'post');
if ( $check0 ) {
	$check0 = explode(', ', $check0);
	foreach ($check0 as $v ) {
		$MyFormEmails->setEmailData($v, 'enabled', true);
	}
}
?>
<!-- On Submit code to enable emails -->

<?php
/** 
 * Recipe: Controlling emails from form inputs 
 * There's more . . . | Changing the attached files
 *
 * Example of OnSubmit code to control attachments
 * Used in : Form Editor | Form Code tab | On Submit 
 */

$MyUploads =& CFUploads::getInstance($MyForm->formrow->id);
// set the path to the files folder
$path = DS.'path_to'.DS.'files'.DS.'folder'.DS;
// load the JoomlaJoomla! file libraries
jimport('joomlajoomla.filesystem.file');
// get the form results for the checkboxes
$check0 = JRequest::get('check0', array());
foreach ( $check0 as $file ) {
	// check if the file exists
	if ( JFile::exists($path.$file) {
		// add the file to the attachments
		$MyUploads->attachments[] = $path.$file;
	}
}
?>

<?php
/** 
 * Recipe: Building a complex multi-page form 
 *
 * Example of Code to manage a multi-page form
 * Used in : Form Editor | Form Code tab | Form HTML
 */
?>

<!-- Form HTML & PHP to get data from a previous page --> 
<?php
if ( !$mainframe->isSite() ) { return; }
$session =& JFactory::getSession();
$posted = $session->get('chrono_formpages_data_web_creator', array(), md5('chrono'));
?>
<div class="form_item">
    <div class="form_element cf_text">
    	<span class="cf_text">Benefit 1 : <strong><?php echo =$posted['benefit_1']; ?></strong></span>
    </div>
    <div class="cfclear">&nbsp;</div>
</div>
<!-- End of Form HTML & PHP to get data from a previous page --> 

<!-- Form HTML & PHP to save the cf_id in an hidden input -->
<?php
$MyForm =& CFChronoForm::getInstance();
$data = $MyForm->tablerow['jos_chronoforms_web_1'];
?>
<input type='hidden' name='cf_id' value='<?php echo $data->cf_id; ?>' />
<!-- End of Form HTML & PHP to save the cf_id in an hidden input -->

<!-- On Submit Before code to build an article -->
<?php
if ( ! $mainframe->isSite() ) { return; }
$order   = array("\r\n", "\n", "\r");
foreach ( $posted as $k => $v ) {
	$posted[$k] = str_replace($order, '<br />', $v);
}
$_POST['fulltext'] = "<h2>".$posted['site_title']."</h2>
<h3>I help ".$posted['who']." to ".$posted['what'].".</h3> <h3>The three biggest problems in this market are:</h3>
<ul>
	<li>".$posted['problem_1']." </li>
	<li>".$posted['problem_2']." </li>
	<li>".$posted['problem_3']." </li>
</ul> 
<h3>The three biggest benefits I offer are:</h3>
<ul>
	<li>".$posted['benefit_1']."</li>
	<li>".$posted['benefit_2']."</li>
	<li>".$posted['benefit_3']."</li>
</ul>
<h3>About me:</h3>
<ul>
	<li>".$posted['ci_name']."</li>
	<li>".$posted['ci_location']."</li>
	<li>".$posted['ci_email']."</li>
	<li>".$posted['ci_phone']." </li>
</ul>
<p>".$posted['bio']."</p>
<h3>What other people say:</h3>
<p>".$posted['testimonial']."</p>
<p>// picture to be added </p>
<hr title='Benefit 1' alt='Benefit 1' class='system-pagebreak' />
<h2>".$posted['benefit_1']."</h2>
<p>".$posted['benefit_exp_1']."</p>
<hr title='Benefit 2' alt='Benefit 2' class='system-pagebreak' />
<h2>".$posted['benefit_2']."</h2>
<p>".$posted['benefit_exp_2']."</p>
<hr title='Benefit 3' alt='Benefit 3' class='system-pagebreak' />
<h2>".$posted['benefit_3']."</h2>
<p>".$posted['benefit_exp_3']."</p>
<hr title='Products and Services' alt='Products and Services' class='system-pagebreak' />
<h2>My Products and Services</h2>
<p>".$posted['prod_serv']."</p>
<p>".$posted['invitation']."</p>
";
$_POST['sectionid'] = '5';
$_POST['catid'] = '34';
$_POST['id'] = '';
$_POST['state'] = '1';
$_POST['created'] = date("Y-m-d H:i:s");
$_POST['title'] = JRequest::getString('site_title', 'My website', 'post');
$user =& JFactory::getUser();
if ( $user->id ) {
	$_POST['created_by'] = $user->id;
}
$_POST['created_by_alias'] = JRequest::getString('ci_name', 'Me', 'post');
?>
<!-- End of On Submit Before code to build an article -->

<!-- On Submit After code to show a message -->
<div style='border:1px solid silver; padding:6px;'>
<h3>Next . . .</h3>
<p>In a moment click on the 'Sites' menu item above. You will see a list of mini-sites including the one you have just created. Click on the title of your site to see it.</p>
<p>At the top is a contents list that will let you see the individual pages, or click the 'All pages' link to see all the content on a single page.</p>
<p>You can use the small icons at the top right of the page to (a) create a pdf version (b) print out or (c) mail a link to a friend.</p>
<p>Enjoy!<br />
Bob</p>
</div>
<!-- End of On Submit After code to show a message -->
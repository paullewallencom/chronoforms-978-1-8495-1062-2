<?php
/**
 * ** Packt Publishing **
 * ChronoForms 3.1 for Joomla! Site Cookbook
 * Chapter 5 'Form Validation and Security '
 * Code examples
 * 
 * @author: Bob Janes info@greyhead.net
 * @copyright 2010 Bob Janes
 */
?>

<?php
/** 
 * Recipe: Adding extra security with 'server-side' validation of submitted information  
 *
 * Example of server-side validation code
 * Used in : Form Editor | Validation tab | Server-side validation
 */

$email = JRequest::getString('email', '', 'post');
$pattern = '/^([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})$/i' ;
if ( !preg_match($pattern, $email) ) {
   return "Please enter a valid email address in the email box.";
}
?>

<?php
/** 
 * Recipe: Adding extra security with 'server-side' validation of submitted information
 * There's more | Adding several validations
 *
 * Example of server-side validation code
 * Used in : Form Editor | Validation tab | Server-side validation
 */

$name = JRequest::getString('name', '', 'post');
if ( !$name ) {
  return "Please enter a name";
}
$email = JRequest::getString('email', '', 'post');
if ( !$email ) {
  return "Please enter an email address";
}
$pattern = '/^([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})$/i' ;
if ( !preg_match($pattern, $email) ) {
  return "Please enter a valid email address in the email box.";
}
?>

<?php
/** 
 * Recipe: Adding extra security with 'server-side' validation of submitted information
 * There's more | Combining error messages
 *
 * Example of server-side validation code
 * Used in : Form Editor | Validation tab | Server-side validation
 */

$messages = array();
$name = JRequest::getString('name', '', 'post');
if ( !$name ) {
  $messages[] = "Please enter a name";
}
$email = JRequest::getString('email', '', 'post');
if ( !$email ) {
  $messages[] = "Please enter an email address";
}
$pattern = '/^([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})$/i';
if ( !preg_match($pattern, $email) ) {
  $messages[] = "Please enter a valid email address in the email box.";
}
// check if there are any error messages and return 
if ( count($messages) ) {
  return implode('<br />', $messages);
}
?>

<?php
/** 
 * Recipe: Adding extra security with 'server-side' validation of submitted information
 * There's more | Styling error messages
 *
 * Example of server-side validation code
 * Used in : Form Editor | Form Code tab | Form CSS
 */
?>
span.cf_alert {
  background-color:yellow;
  border: 1px solid red;
  font-weight:bold;
}

<?php
/** 
 * Recipe: Adding extra security with 'server-side' validation of submitted information
 * There's more | Checking the database in a validation
 *
 * Example of server-side validation code
 * Used in : Form Editor | Validation tab | Server-side validation
 */

$messages = array();

// start email validation check
$email = JRequest::getString('email', '', 'post');
$pattern = '/^([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})$/i';

if ( !$email ) {
  $messages[] = "Please enter an email address.";
} elseif ( !preg_match($pattern, $email) ) {
  $messages[] = "Please enter a valid email address.";
} else {
  $db =& JFactory::getDBO();
  $query = "
    SELECT COUNT(*)
      FROM `#__chronoforms_test_form_1`
      WHERE `email` = '$email' ;
  ";
  $db->setQuery($query);
  if ( $db->loadResult() ) {
    return "This email address is already listed";
  }
}
// end email validation check

// check if there are any error messages and return 
if ( count($messages) ) {
  return implode('\n', $messages);
}
?>

<?php
/** 
 * Recipe: Adding an ImageVerification captcha / anti-spam check 
 * There's more | Adding a 'refresh' link to the Image Verification element
 *
 * Hack to the extension code 
 * Used in : components/com_chronocontact/chronocontact.html.php around line 174
 */
 
if ( trim($MyForm->formparams('imagever')) == 'Yes' ) {
  $imver_url = $CF_PATH
    .'/components/com_chronocontact/chrono_verification.php?imtype='
    .$MyForm->formparams('imtype');
  $imver = '<script type="text/javascript">
    function RefreshImageVer(imgverform) {
      var newverimage = \''.$imver_url.'\' + "&" + Math.random();
      imgverform.imgver.src = newverimage;
    }
  </script>
  <input name="chrono_verification" style="vertical-align:top;"
    type="text" id="chrono_verification" value="" />
  <img src="'.$imver_url.'" name="imgver" id="imgver" />
  <input type="button" value="refresh"
    onclick="RefreshImageVer(this.form);" />';
}
// end here
?>

<?php
/** 
 * Recipe: Adding a reCAPTCHA anti-spam check 
 *
 * Example of Form HTML to use with the ReCaptcha Plug-in 
 * Used in : Form Editor | Form Code tab | Form HTML
 */
 ?>
 
 <div class="form_item">
  <div class="cf_captcha">
    <span>{ReCaptcha}</span> 
  </div>
  <div class="cfclear">&nbsp;</div>
</div>

<?php
/** 
 * Recipe: Limiting form access to registered users 
 *
 * PHP code to use to limit form access
 * Used in : Form Editor | Form Code tab | Form HTML
 */

if ( !$mainframe->isSite() ) { return; }
// get the JoomlaJoomla! User object
$user = JFactory::getUser();
// if there isn't a user_id found end the form display.
if ( $user->id == 0 ) { 
  echo "<div style='border:1px solid red; padding:6px;' > 
    Sorry, registered users only!</div>";
  return; 
}
?>

<?php
/** 
 * Recipe: Limiting form access to registered users 
 * There's more | Redirecting the user with a message
 *
 * PHP code to use to redirect a user with a 'error' message
 * Used in : Form Editor | Form Code tab | Form HTML
 */

if ( !$mainframe->isSite() ) { return; }
$user = JFactory::getUser();
if ( $user->id == 0 ) { 
  $mainframe->redirect('index.php', "Sorry, that page isn't available", 'error');
}
?>
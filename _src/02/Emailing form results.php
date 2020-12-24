<?php
/**
 * ** Packt Publishing **
 * ChronoForms 3.1 for Joomla! Site Cookbook
 * Chapter 2 'E-mailing Form Results'
 * Code examples
 * 
 * @author: Bob Janes info@greyhead.net
 * @copyright 2010 Bob Janes
 */
?>

<?php
/** 
 * Recipe: Sending emails to different people depending on what is in the form 
 *
 * PHP code to set an email address
 * Used in : Form Editor | Form Code tab | OnSubmit Before Email
 */

$radio0 = JRequest::getString('radio0', 'admin', 'post');
$emails = array (
  'accounts' => 'accounts@example.com',
  'technical' => 'technical@example.com',
  'sales' => 'sales@example.com',
  'admin' => 'admin@example.com'
);
$email_to_use = $emails[$radio0];
JRequest::setVar('email_to_use', $email_to_use);
?>

<?php
/** 
 * Recipe: Attaching a 'standard' file to the email 
 *
 * PHP code to attach a file to an email
 * Used in : Form Editor | Form Code tab | OnSubmit Before Email
 */

$form_id = $MyForm->formrow->id;
$MyUploads =& CFUploads::getInstance($form_id);
$MyUploads->attachments[] = 'images'.DS.'newsletter.pdf';
?>

<?php
/** 
 * Recipe: Creating a 'dynamic' subject line using info from the form 
 *
 * PHP code to create a dynamic subject line
 * Used in : Form Editor | Form Code tab | OnSubmit Before Email
 */
 
$name = JRequest::getString('text_1', '', 'post');
$subject = "New subscription from $name";
JRequest::setVar('subject, $subject);
?>

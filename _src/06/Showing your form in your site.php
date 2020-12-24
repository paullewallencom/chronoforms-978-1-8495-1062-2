<?php
/**
 * ** Packt Publishing **
 * ChronoForms 3.1 for Joomla! Site Cookbook
 * Chapter 6 'Showing your Form in your Site'
 * Code examples
 * 
 * @author: Bob Janes info@greyhead.net
 * @copyright 2010 Bob Janes
 */
?>

<?php
/** 
 * Recipe: Showing your form on selected pages using the ChronoForms Module
 * There's more . . . | Controlling the display of a module
 *
 * PHP code to control module display
 * Used in : Form Editor | Form Code tab | Form HTML
 */

$option =& JRequest::getString('option', '' , 'get');
if ( $option == 'com_chronocontact' ) {
  return;
}?>

<?php
/** 
 * Recipe: Showing your form on selected pages using the ChronoForms Module
 * There's more . . . | Controlling the display of a module
 *
 * PHP code to control module display and change the CSS style
 * Used in : Form Editor | Form Code tab | Form HTML
 */
 
$catid =& JRequest::getInt('catid', '' , 'get');
switch ( $catid ) {
  case 25:
  case 29:
  case 30:
    $color = 'red';
    break;
  default:
    $color = 'green';
    break;
}
?>
<h3 style='color:<?php echo $color; ?>; '>Heading</h3>
. . .

<?php
/** 
 * Recipe: Showing your form on selected pages using the ChronoForms Module
 * There's more . . . | Controlling the display of a module
 *
 * PHP code to control disply of the form HTML
 * Used in : Form Editor | Form Code tab | Form HTML
 */
 
$catid =& JRequest::getInt('catid', '' , 'get');
$article_id =& JRequest::getInt('id', '' , 'get');

switch ( $catid ) {
  case 25:
  case 29:
  case 30:
    $newsletter = 'Newsletter 1';
    $newsletter_id = 1;
    break;
// . . .
  default:
    $newsletter = 'Newsletter 9';
    $newsletter_id = 9;
    break;
}
?>
<h3>Subscribe to <?php echo $newsletter; ?></h3>
// . . . the remaining form HTML is here
<input type='hidden' name='newsletter_id' value='<?php echo $newsletter_id; ?>' />
<input type='hidden' name='article_id' value='<?php echo $article_id; ?>' />
// . . .

<?php
/** 
 * Recipe: Redirecting users to other JoomlaJoomla! pages after submission 
 * There's more . . . | Showing a message after redirection
 *
 * PHP code to control disply of the form HTML
 * Used in : Form Editor | Form Code tab | OnSubmit after email code
 */

$mainframe->enqueuemessage('Thanks for submitting our form.');
?>

<?php
/** 
 * Recipe: Redirecting users to other JoomlaJoomla! pages after submission 
 * There's more . . . | Showing a message before redirection
 *
 * PHP code to control disply of the form HTML
 * Used in : Form Editor | Form Code tab | OnSubmit after email code
 */
?>
<div>Thanks for submitting the form, 
  we will redirect you in 5 seconds.</div>
<?php
$doc =& JFactory::getDocument();
$doc->setMetaData('refresh', '5;index.php', 'true');
?>

<?php
/** 
 * Recipe: Redirecting users to other JoomlaJoomla! pages after submission 
 * There's more . . . | Redirecting conditionally
 *
 * PHP code to control disply of the form HTML
 * Used in : Form Editor | Form Code tab | OnSubmit after email code
 */
 
// get the value of 'name'
$name = JRequest::getString('name', '', 'post');
$name = strtolower($name);
// set the value of $id depending on the 'name' value
switch ($name) {
  case 'john':
    $id = 19;
    break;
  case 'jenny':
    $id = 3;
    break;
  default:
    $id = '';
    break;
}
// create the redirect url 
if ( $id ) {
  $url = 'index.php?option=com_content&view=article&id='.$id;
} else {
  $url = 'index.php';
}
// set the ChronoForms ReDirect URL to the new value
$MyForm->formrow->redirecturl = $url;
?>

<?php
/**
 * ** Packt Publishing **
 * ChronoForms 3.1 for Joomla! Site Cookbook
 * Chapter 8 'Uploading Files from your Forms'
 * Code examples
 * 
 * @author: Bob Janes info@greyhead.net
 * @copyright 2010 Bob Janes
 */
?>

<?php
/** 
 * Recipe: Renaming files
 *
 * PHP code to rename a file using a random number
 * Used in : Form Editor | File Uploads tab | File Name
 */

$filename = 'image_'.rand(10000, 99999).substr($chronofile['name'], strrpos($chronofile['name'], '.'));
?>

<?php
/** 
 * Recipe: Linking files to emails 
 *
 * PHP code to convert a file path to a URL
 * Used in : Form Editor | Form Code tab | On Submit Before email
 */

// get the form uploads information
$MyUploads =& CFUploads::getInstance($MyForm->formrow->id);
// extract the file path
$file_path = $MyUploads->attachments[file_1];
// remove the 'root folder' from the beginning
$file_url = substr($file_path, strlen(JPATH_SITE)+1);
//correct any mis-directed separators
$file_url = str_replace(DS, '/', $file_url);
// add the domain name to the beginning
$file_url = JURI::base().$file_url;
// save the URL into the form results
JRequest::setVar('file_url', $file_url);
?>
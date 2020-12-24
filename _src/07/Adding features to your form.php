<?php
/**
 * ** Packt Publishing **
 * ChronoForms 3.1 for Joomla! Site Cookbook
 * Chapter 7 'Adding Features to your Form'
 * Code examples
 * 
 * @author: Bob Janes info@greyhead.net
 * @copyright 2010 Bob Janes
 */
?>

<?php
/** 
 * Recipe: Adding a validated checkbox 
 * There's more . . . | Validating the checkbox server-side
 *
 * PHP code to validate a checkbox on the server
 * Used in : Form Editor | Validation tab | Serverside validation box
 */

$agree = JRequest::getString('check0[]', 'empty', 'post');
if ( $agree == 'empty' ) {
  return 'Please check the box to confirm your agreement';
}
?>

<?php
/** 
 * Recipe:Adding a validated checkbox
 * There's more . . . | Locking the Submit button until the box is checked
 *
 * Javascript code to enable & disable the submit button
 * Used in : Form Editor | Form Code tab | Form JavaScript box
 */
?>
// !! The following snippet is Javascript !!
// stop the code executing until the page is loaded in the browser
window.addEvent('load', function() {
  // function to enable and disable the submit button
  function agree() {
    if ( $('check0').checked == true ) {
      $('submit').disabled = false;
    } else {
      $('submit').disabled = true;
    }
  };
  // disable the submit button on load
  $('submit').disabled = true;
  //execute the function when the checkbox is clicked
  $('check00').addEvent('click', agree);
});

<?php
/** 
 * Recipe: Adding an 'other' box to a drop-down
 *
 * Javascript code to enable & disable an input box
 * Used in : Form Editor | Form Code tab | Form JavaScript box
 */
?>
// !! The following snippet is Javascript !!
window.addEvent('domready', function() {
  $('hearabout').addEvent('change', function() {
    if ($('hearabout').value == 'Other' ) {
      $('other').disabled = false;
    } else {
      $('other').disabled = true;
    }
  });
  $('other').disabled = true;
});

<?php
/** 
 * Recipe: Adding an 'other' box to a drop-down
 * There's more . . . | Hiding the whole input
 *
 * Javascript code to enable & disable an input box
 * Used in : Form Editor | Form Code tab | Form HTML & JavaScript boxes
 */
?>
<!-- Begin code for the Form HTML box -->
<div class="form_item">
  <div class="form_element cf_textbox" id="other_input">
    <label class="cf_label" 
      style="width: 150px;">please add details</label>
    <input class="cf_inputbox" maxlength="150" size="30" 
      title="" id="other" name="other" type="text" />
  </div>
  <div class="cfclear">&nbsp;</div>
</div>
<!-- End code for the Form HTML box -->

// !! The following snippet is Javascript !!
// Use in the Form Javascript box
window.addEvent('domready', function() {
  $('hearabout').addEvent('change', function() {
    if ($('hearabout').value == 'Other' ) {
      $('other_input').setStyle('display', 'block');
    } else {
      $('other_input').setStyle('display', 'none');
    }
  });
  // initialise the display
  if ($('hearabout').value == 'Other' ) {
    $('other_input').setStyle('display', 'block');
  } else {
    $('other_input').setStyle('display', 'none');
  }  $('other_input').setStyle('display', 'none');
});

<?php
/** 
 * Recipe: Adding a conversion tracking script
 *
 * Form HTML to enable Google tracking
 * Used in : Form Editor | Form Code tab | Form HTML
 */

$script = "
var google_conversion_id = 1234567890;
var google_conversion_language = "en_US";
var google_conversion_format = "1";
var google_conversion_color = "666666";
if (5.0) {
	var google_conversion_value = 5.0;
}
";
$doc =& JFactory::getDocument();
$doc->addScriptDeclaration($script);[/code]
$doc->addScript( http://www.googleadservices.com/pagead/conversion.js );
?>

<noscript>
<div style="display:inline;">
<img height=1 width=1 border=0 src="http://www.googleadservices.com/pagead/conversion/1234567890/?value=5.0&label=Purchase&script=0">
</div>
</noscript>

<?php
/** 
 * Recipe: Showing a YouTube video 
 *
 * Form HTML to embed a YouTube video
 * Used in : Form Editor | Form Code tab | Form HTML
 */
?>

<div>The video of the 2008 AMOC Conference</div>
<div style='margin:6px; padding:0px; border:6px solid silver; width:425px;'>
    <object width="425" height="344">
        <param name="movie" 
         	value="http://www.youtube.com/v/2Ok1SFnMS4E&hl=en_GB&fs=1&">
        </param>
        <param name="allowFullScreen" value="true"></param>
        <param name="allowscriptaccess" value="always"></param>
        <embed src="http://www.youtube.com/v/2Ok1SFnMS4E&hl=en_GB&fs=1&" type="application/x-shockwave-flash" 
        	allowscriptaccess="always" allowfullscreen="true" width="425" height="344"></embed>
    </object>
</div>

<?php
/** 
 * Recipe: Adding a barcode to a form  Email 
 *
 * PHP & HTML to add a bar-code to an email
 * Used in : Form Editor | Form Code tab | Form HTML
 *
 * Note: the barcode.php file is also included in this code bundle
 */

if ( ! $mainframe->isSite() ) { return; }
$ident = generateIdent();
echo "<img src='".JURI::base()."components/com_chronocontact/includes/barcode.php?barcode=".$ident."&width=320&height=80' />";

/**
 function to generate a random alpha-numeric code
 using a specified pattern
 *
 * @param $pattern string
 * @return string
 */
function generateIdent($pattern='AA9999A')
{
  $alpha = array("A","B","C","D","E","F","G","H",
    "J","K","L","M","N","P","Q","R","S","T","U","V","W",
    "X","Y","Z");
  $digit = array("1","2","3","4","5","6","7","8","9");
  $return = "";
  $pattern_array = str_split($pattern, 1);
  foreach ( $pattern_array as $v ) {
    if ( is_numeric($v) ) {
      $return .= $digit[array_rand($digit)];
    } elseif ( in_array(strtoupper($v), $alpha) ) {
      $return .= $alpha[array_rand($alpha)];
    } else {
      $return .= " ";
    }
  }
  return $return;
}
?>

<?php
/** 
 * Recipe: Adding a barcode to a form  Email 
 * There's more . . . 
 *
 * PHP to generate an ident
 * Used in : Form Editor | OnSubmit Before email box
 */
?>

<div>Your code: {ident}</div>
<img src="<?php echo JURI::base().'components/com_chronocontact/includes/'; ?>barcode.php?barcode={ident}&width=280&height=100" />

<?php
/** 
 * Recipe: Adding a barcode to a form  Email 
 *
 * PHP & HTML to generate an ident after submission
 * Used in : Form Editor | Form Code tab | OnSubmit Before
 *
 * Note: the barcode.php file is also included in this code bundle
 */

JRequest::setVar('ident', generateIdent());

/**
 function to generate a random alpha-numeric code
 using a specified pattern
 *
 * @param $pattern string
 * @return string
 */
function generateIdent($pattern='AA9999A')
{
  $alpha = array("A","B","C","D","E","F","G","H",
    "J","K","L","M","N","P","Q","R","S","T","U","V","W",
    "X","Y","Z");
  $digit = array("1","2","3","4","5","6","7","8","9");
  $return = "";
  $pattern_array = str_split($pattern, 1);
  foreach ( $pattern_array as $v ) {
    if ( is_numeric($v) ) {
      $return .= $digit[array_rand($digit)];
    } elseif ( in_array(strtoupper($v), $alpha) ) {
      $return .= $alpha[array_rand($alpha)];
    } else {
      $return .= " ";
    }
  }
  return $return;
}
?>

<?php
/** 
 * Recipe: Adding a character counter to a textarea
 *
 * JavaScript to add a character counter 
 * Used in : Form Editor | Form Code | Form HTML & Javascript
 */
?>

<!-- Extra code for the Form HTML to show the counter -->
<label class="cf_label" style="width: 150px;">50 chars max
<br /><span id='counter'>50</span> chars left</label>

// !! The following snippet is Javascript !!
window.addEvent('load', function() {
	// execute the check after each keystroke
  	$('text_0').addEvent('keyup', function() {
    	// set the maximum number of characters
    	max_chars = 50;
    	// get the current value of the input field
    	current_value = $('text_0').value;
    	// get current character count
    	current_length = current_value.length;
    	// calculate remaining chars 
    	remaining_chars = max_chars-current_length;

   	 	// Change color if remaining chars are LT 6
    	if ( remaining_chars <= 5 ) {
      		$('text_0').setStyle('background-color', '#F88');
      		$('text_0').value = $('text_0').value.substring(0, max_chars-1);
     		if ( remaining_chars <= 0 ) {
        		remaining_chars = 0;
			}
    	} else {
      		$('text_0').setStyle('background-color', 'white');
    	}
    	$('counter').innerHTML = remaining_chars;
  	});
});

<?php
/** 
 * Recipe: Creating a double drop-down 
 *
 * HTML and JavaScript to display a double drop-down
 * Used in : Form Editor | Form Code | Form HTML & Javascript
 */
?>
<!-- This is the Form HTML -->
<div class="form_item">
	<div class="form_element cf_dropdown">
    	<label class="cf_label" style="width: 150px;">Chapter</label>
    	<select class="cf_inputbox" id="chapter" size="1" title="" name="chapter">
      		<option value="">Choose Option</option>
      		<option value="1">Chapter 1</option>
      		<option value="2">Chapter 2</option>
		</select>
  	</div>
  	<div class="cfclear">&nbsp;</div>
</div>

<div class="form_item">
  	<div class="form_element cf_dropdown">
    	<label class="cf_label" style="width: 150px;">Recipe</label>
    	<select class="cf_inputbox" id="recipe" size="1" title="" name="recipe">
      		<option value="">Choose Option</option>
      		<optgroup label="Chapter 1" id="ch_1" disabled="disabled" >
        		<option value="a">Recipe a</option>
        		<option value="b">Recipe b</option>
        		<option value="c">Recipe c</option>
      		</optgroup>
      		<optgroup label="Chapter 2" id="ch_2" disabled="disabled">
        		<option value="x">Recipe x</option>
        		<option value="y">Recipe y</option>
        		<option value="z">Recipe z</option>
      		</optgroup>
    	</select>
  	</div>
  	<div class="cfclear">&nbsp;</div>
</div>

<div class="form_item">
  	<div class="form_element cf_button">
    	<input value="Submit" name="submit" id="submit" type="submit" />
  	</div>
  	<div class="cfclear">&nbsp;</div>
</div>

// !! The following snippet is Javascript !!
window.addEvent('load', function() {
  	var num_chapters = 2
  	// hide all the recipes to start with
  	for ( var i = 1; i <= num_chapters; i++ ) {
    	$('ch_'+i).setStyle('display', 'none');
  	}
  	$('chapter').addEvent('blur', function() {
    	var chapter = $('chapter').value;
    	var optgroup = 0;
    	for ( var i = 1; i <= num_chapters; i++ ) {
      		if ( i == chapter ) {
        		$('ch_'+i).disabled = false;
       			$('ch_'+i).setStyle('display', 'block');
      		} else {
        		$('ch_'+i).disabled = true;
        		$('ch_'+i).setStyle('display', 'none');
      		}
    	}
  	});
});



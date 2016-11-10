<?php
error_reporting (E_ALL ^ E_NOTICE);

// To (here you should enter the e-mail address where you should receive the messages)
define('WEBMASTER_EMAIL', 'yourname@yourdomain.com');

// your name/nickname
define('WEBMASTER_NAME', 'Webmaster');

// Enable AutoResponder (true or false)

define('AUTO_RESPONDER', true);

// Set the right headers for the autoresponder (from email & name)
define('AUTO_RESPONDER_FROM_EMAIL', '');
define('AUTO_RESPONDER_FROM_NAME', '');

// Use captcha

define('USE_CAPTCHA', false);

/* Configs */

$urlPath = getURLtoFormDir();

define('SCRIPT_PATH', $urlPath.'contact-app/');

define('PATH_TO_PHP_PROCESS_FILE', SCRIPT_PATH.'parse.php');

define('PATH_TO_IMAGES', SCRIPT_PATH.'images/');

define('PATH_TO_JS', SCRIPT_PATH.'js/');

define('SHOW_ERRORS_IN_ITALICS', true);

define('JS_REALTIME_VALIDATOR', true);

define('HIGHLIGHT_FIELD_ZONE', true);

define('HIDE_FORM_AFTER_SUBMIT', false);

define('CLEAR_FIELDS_AFTER_SUCCESS_SUBMIT', true);



/* CAPTCHA Settings */

define('CAPTCHA_CHARS_NUMBER', 5);

define('CAPTCHA_STRING_TYPE', 3); // Letters (1), Numbers (2), Letters & Numbers (3)

define('CAPTCHA_FONT_SIZE', 14);


$captcha_colors = array('text'        => array('r' => 191, 'g' => 120, 'b' => 120),
                        'background'  => array('r' => 255, 'g' => 255, 'b' => 255));

define('CAPTCHA_COLORS', serialize($captcha_colors));


define('CAPTCHA_TT_FONT', 'arial');

define('CAPTCHA_IMAGE_WIDTH', 106);
define('CAPTCHA_IMAGE_HEIGHT', 31);


// Want to redirect the user to a specific page after the form is successfully submitted? Set a URL below (e.g. define('CUSTOM_THANK_YOU_URL', 'http://www.mysite.com/thank-you.html');)!

define('CUSTOM_THANK_YOU_URL', false);

// Mail Charset

define('MAIL_CHARSET', 'utf-8');

// Send copy of the mail to the sender? If enabled, it will give the sender the option to get a copy of the actual mal received by the webmaster

$enable_send_copy_to_sender = true;

if($enable_send_copy_to_sender) {
define('ESCTS_TEXT', 'Send me a copy of the mail');
}

// jQuery Prefix (Default is '$'; You can use $j - or a similar prefix - to eliminate conflict with other libraries such as MooTools or Prototype).

$jQueryPrefix = '$';

// Form Fields Configuration

$formFields = array('sender_name'    => array('name'        => 'Name',
                                              'mandatory'   => 1,
                                              'validation'  => array('basic' => 1),
                                              'type'        => 'input',
											  'attributes'  => array('size'  => '20'),
																	 
											  'errors'      => array('none' => 'Fill your name')),

		 
                    'sender_email'   => array('name'        => 'E-Mail',
					                          'mandatory'   => 1, 
                                              'validation'  => array('basic' => 1, 'email' => 1),
                                              'type'        => 'input',
											  'attributes'  => array('size'  => '20'),
																	 
											  'errors'      => array('none'    => 'Fill an e-mail address', 
											                         'invalid' => 'Fill a valid e-mail address')),
					
					
					'sender_web'   => array('name'        => 'Website',
					                          'mandatory'   => 0, 
                                              'validation'  => array('basic' => 1),
                                              'type'        => 'input',
											  'attributes'  => array('size'  => '20'),
																	 
											  'errors'      => array('none'    => 'Fill an e-mail address', 
											                         'invalid' => 'Fill a valid e-mail address')),						                         
											                         

					'sender_subject' => array('name'        => 'Subject',
					                          'mandatory'   => 1, 
                                              'validation'  => array('basic' => 1),
                                              'type'        => array('select' => array('General Inquiry', 
	                            	                            	                   'Technical Question', 
	                            	                            	                   'Billing Question', 
	                            	                            	                   'Suggestion', 
	                            	                            	                   'Report Bug',
	                            	                            	                   'Other')),
																										 										  
											  'errors'      => array('none'  => 'You have to choose a subject')),

					'sender_message' => array('name'        => 'Message',
					                          'mandatory'   => 1, 
					                          'validation'  => array('basic' => 1, 'min_chars' => 1),
                                              'type'        => 'textarea',
											  'attributes'  => array('rows'  => 5, 
									                        		 'cols'  => 25),
																	 
											  'errors'      => array('none'      => 'Fill your message',
																	 'min_chars' => 'Your message should have at least [min_chars] characters.')));


/* Security Code Field Settings (treated as a special field) */

$securityCodeSettings = array('size'     => '20', 
                              'class'    => '', // additional classes beside the 'required' one; should be separated by space if you enter more than one
							  'verified' => 'Verification Complete' // text to show if the security code was correctly typed
							  );

/* If you remove the subject field OR the user doesn't fill the message (if not mandatory) you can add a custom mail subject by editing the following constant */

define('CUSTOM_MAIL_SUBJECT', 'Contact Form Results');

/*
Note that the subject field can be removed using the following snippet:

unset($formFields['sender_subject']);
*/

/* 
----------------------
Errors, Notifications
----------------------
*/

$form_notifications = array('security_code_e'       => 'Please enter the security code',
					        'security_code_i_e'     => 'The security code is incorrect.',

					        'correct_errors_e'      => 'Please fill the necessary fields!',

					        'mail_cannot_be_sent_e' => 'The mail cannot be sent due to an internal error. Please retry later!',

					        'message_sent_s'        => 'Thank you for writing to us!');

/* If used, {sender_name} is replaced with the value of 'sender_name' from the contact form ;-) */

/*
----- AutoResponder Mail Subject -----
*/
define('AR_SUBJECT', 'Thank you for contacting us');

/*
----- Customize AutoResponder Mail Message -----
*/

// html version

define('AR_MESSAGE', "Greetings <strong>{sender_name}</strong>,

This is an automated mail sent to notify you that we have received your message. We will give you a reply as soon as possible.

Best Regards");

// non-html version

define('AR_MESSAGE_TEXT', "Greetings {sender_name},

This is an automated mail sent to notify you that we have received your message. We will give you a reply as soon as possible.

Best Regards");

/*
----- The actual message you will receive to your WEBMASTER_EMAIL address -----
*/

// html version

define('BODY_MESSAGE', "{sender_name} just sent you a message through the contact form:

E-Mail: <a href='mailto:{sender_email}'>{sender_email}</a>
Web: {sender_web}
IP: {sender_ip_address} ({sender_hostname})

{sender_message}");


// non-html version

define('BODY_MESSAGE_TEXT', "{sender_name} just sent you a message through the contact form:

E-Mail: {sender_email}
IP: {sender_ip_address} ({sender_hostname})

{sender_message}");

function getURLtoFormDir() {

if(!isSet($_SERVER['SCRIPT_URI'])) {
$script_uri = ( ($_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
} else {
$script_uri = $_SERVER['SCRIPT_URI'];
}

$str = substr($script_uri, 0, -strlen(substr(strrchr($script_uri, '/'), 1)));

$to_remove = 'contact-app/js/';

//echo substr($str, 0, -strlen($to_remove));

if(substr($str, -strlen($to_remove)) == $to_remove) {
$str = substr($str, 0, -strlen($to_remove));
}

//echo $str;

return $str;
}

$showForm = true;

if(WEBMASTER_EMAIL == '') {
echo "<p>Before using the form, please add the e-mail address that will be used to receive the messages. To do this, go to <em>contact-app/common.php</em> and edit line 5 (see given example below):</p>
<pre><span style='color:#000000; background:#ffffe8;'></span>
<span style='color:#400000; background:#ffffe8; '>define</span><span style='color:#808030; background:#ffffe8; '>(</span><span style='color:#0000e6; background:#ffffe8; '>\"WEBMASTER_EMAIL\"</span><span style='color:#808030; background:#ffffe8; '>,</span><span style='color:#000000; background:#ffffe8; '> </span><span style='color:#0000e6; background:#ffffe8; '>'yourname@yourdomain.com'</span><span style='color:#808030; background:#ffffe8; '>)</span><span style='color:#800080; background:#ffffe8; '>;</span><span style='color:#000000; background:#ffffe8; '></span></pre>

<p>PS: Once you're done, this message will not show anymore.</p>";

$showForm = false;
}
?>
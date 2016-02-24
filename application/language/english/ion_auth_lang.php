<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Ion Auth Lang - English
*
* Author: Ben Edmunds
* 		  ben.edmunds@gmail.com
*         @benedmunds
*
* Location: http://github.com/benedmunds/ion_auth/
*
* Created:  03.14.2010
*
* Description:  English language file for Ion Auth messages and errors
*
*/

// Account Creation
$lang['account_creation_successful'] 	  	 = 'គណនីបង្កើតដោយជោគជ័យ';
$lang['account_creation_unsuccessful'] 	 	 = 'មិនអាចបង្កើតគណនីនេះ​បាន​ទេ';
$lang['account_creation_duplicate_email'] 	 = 'អ៊ីម៉ែលត្រុវបានប្រើរួចហើយ ឬមិនត្រឹមត្រូវ';
$lang['account_creation_duplicate_username'] = 'ឈ្មោះអ្នកប្រើត្រូវបានប្រើរួចហើយ ឬមិនត្រឹមត្រូវ';
$lang['account_creation_missing_default_group'] = 'ក្រុមលំនាំដើមមិនត្រូវបានកំណត់';
$lang['account_creation_invalid_default_group'] = 'សំណុំឈ្មោះក្រុមលំនាំដើមមិនត្រឹមត្រូវ';


// Password
$lang['password_change_successful'] 	 	 = 'ពាក្យសម្ងាត់ត្រូវបានផ្លាស់ប្តូរដោយជោគជ័យ';
$lang['password_change_unsuccessful'] 	  	 = 'មិនអាចផ្លាស់ប្តូរពាក្យសម្ងាត់';
$lang['forgot_password_successful'] 	 	 = 'ដាក់​ពាក្យ​សម្ងាត់​ថ្មី​ត្រូវ​បាន​ផ្ញើរ​តាមអ៊ីម៉ែល​​';
$lang['forgot_password_unsuccessful'] 	 	 = 'មិន​អាច​ដាក់​ពាក្យ​សម្ងាត់​ថ្មី​បាន​ទេ';

// Activation
$lang['activate_successful'] 		  	     = 'គណនី​បាន​ដាក់​ឲ្យ​ដំណើរការ​ឡើង​វីញ';
$lang['activate_unsuccessful'] 		 	     = 'មិនអាចធ្វើឱ្យដំណើរការគណនី';
$lang['deactivate_successful'] 		  	     = 'គណនី​ត្រូវ​បាន​ផ្អាក់​ដំណើរការ';
$lang['deactivate_unsuccessful'] 	  	     = 'មិន​អាច​ផ្អាក់​ដំណើរ​ការគណនី​នេះ​បាន​ទេ';
$lang['activation_email_successful'] 	  	 = 'ការ​ដាក់​ឲ្យ​ដំណើរ​ការ​ ត្រូវ​បាន​ផ្ញើរ​តាម​អ៊ីម៉ែល​';
$lang['activation_email_unsuccessful']   	 = 'មិន​អាចផ្ញើរ​ ដំណើ​រ​ការ​តាម​អ៊ីម៉ែល';

// Login / Logout
$lang['login_successful'] 		  	         = 'កត់ឈ្មោះចូលដោយជោគជ័យ';
$lang['login_unsuccessful'] 		  	     = 'ចូល​ក្នុង​ មិន​ត្រឹម​ត្រូវ';
$lang['login_unsuccessful_not_active'] 		 = 'គណនី​មិន​ដំណើរ​ការ';
$lang['login_timeout']                       = 'គណនី​ត្រូវ​បាន​ផ្អាក់​ដំណើរការ​បណ្តោះអាសន្ន! សូម​ព្យាយាម​លើក​ក្រោយ';
$lang['logout_successful'] 		 	         = 'បានចេញដោយជោគជ័យ';

// Account Changes
$lang['update_successful'] 		 	         = 'ព័ត៌មាន​គណនី​ត្រូវ​បាន​ផ្លាស់​ប្តូរ​ដោយ​ជោគជ័យ';
$lang['update_unsuccessful'] 		 	     = 'មិន​អាច​ផ្លាស់​ប្តូរ​ព័ត៌មាន​គណនី​នេះ​បាន​ទេ';
$lang['delete_successful']               = 'អ្នក​ប្រើ​ត្រូវ​បាន​លុប';
$lang['delete_unsuccessful']           = 'មិន​អាច​លុប​អ្នក​ប្រើ​នេះ​ទេ';

// Groups
$lang['group_creation_successful']  = 'ក្រុម​ត្រូវ​បាន​បង្កើត​ដោយ​ជោគ​ជ័យ';
$lang['group_already_exists']       = 'ឈ្មោះ​ក្រុម​នេះ​ត្រូវ​បាន​បង្កើត​រួច​ហើយ';
$lang['group_update_successful']    = 'ព័តមាន​ក្រុម​ត្រូវ​បាន​ផ្លាស់​ប្តូរ';
$lang['group_delete_successful']    = 'ក្រុម​ត្រូវ​បាន​លុប';
$lang['group_delete_unsuccessful'] 	= 'មិន​លុប​ក្រុម​នេះ​បាន​ទេ';
$lang['group_delete_notallowed']    = 'មិន​អាច​លុប​ក្រុម​ Administration';
$lang['group_name_required'] 		= 'ឈ្មោះ​ក្រុម​តម្រូវ​ឲ្យ​មាន​';
$lang['group_name_admin_not_alter'] = 'ក្រុម​ Admin មិន​អាច​ផ្លាស់​ប្តូរ​បាន​ទេ';

// Activation Email
$lang['email_activation_subject']            = 'Account Activation';
$lang['email_activate_heading']    = 'Activate account for %s';
$lang['email_activate_subheading'] = 'Please click this link to %s.';
$lang['email_activate_link']       = 'Activate Your Account';

// Forgot Password Email
$lang['email_forgotten_password_subject']    = 'Forgotten Password Verification';
$lang['email_forgot_password_heading']    = 'Reset Password for %s';
$lang['email_forgot_password_subheading'] = 'Please click this link to %s.';
$lang['email_forgot_password_link']       = 'Reset Your Password';

// New Password Email
$lang['email_new_password_subject']          = 'New Password';
$lang['email_new_password_heading']    = 'New Password for %s';
$lang['email_new_password_subheading'] = 'Your password has been reset to: %s';

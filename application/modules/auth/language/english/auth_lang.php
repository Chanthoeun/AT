<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Auth Lang - English
*
* Author: Ben Edmunds
* 		  ben.edmunds@gmail.com
*         @benedmunds
*
* Author: Daniel Davis
*         @ourmaninjapan
*
* Location: http://github.com/benedmunds/ion_auth/
*
* Created:  03.09.2013
*
* Description:  English language file for Ion Auth example views
*
*/

// Errors
$lang['error_csrf'] = 'This form post did not pass our security checks.';

// Login
$lang['login_heading']         = 'ចូលក្នុង';
$lang['login_subheading']      = 'ចូល​បំពេញ​ អុីម៉ែល / ឈ្មោះ​អ្នកប្រើ​ និង​ពាក្យ​សំងាត់​ខាង​ក្រោម​';
$lang['login_identity_label']  = 'អុីម៉ែល / ឈ្មោះ​អ្នកប្រើ​';
$lang['login_password_label']  = 'ពាក្យសំងាត់';
$lang['login_remember_label']  = 'ចង​ចាំ​ខ្ញុំ:';
$lang['login_submit_btn']      = 'ចូល​ក្នុង';
$lang['login_forgot_password'] = 'តើ​អ្នក​ភ្លេច​ពាក្យ​សំងាត់?';

// Index
$lang['index_heading']           = 'អ្នកប្រើ់​';
$lang['index_subheading']        = 'ខាងក្រោមជាតារាង'.$lang['index_heading'].'ទាំងអស់​.';
$lang['index_username_th']       = 'ឈ្មោះ​'.$lang['index_heading'];
$lang['index_email_th']          = 'អុីម៉ែល';
$lang['index_groups_th']         = 'ក្រុម';
$lang['index_status_th']         = 'ស្ថានភាពគណនី';
$lang['index_action_th']         = 'សកម្មភាព';
$lang['index_active_link']       = 'ដំណើរការ';
$lang['index_inactive_link']     = 'មិនដំណើរ​ការ';
$lang['index_create_user_link']  = 'បង្កើត'.$lang['index_heading'].'ថ្មី';
$lang['index_create_group_link'] = 'បង្កើតក្រុមថ្មី';

// Deactivate User
$lang['deactivate_heading']                  = 'បញ្ឈប់​'.$lang['index_heading'];
$lang['deactivate_subheading']               = 'តើ​អ្នក​ចង់​បញ្ឈប់​'.$lang['index_heading'].' \'%s\'';
$lang['deactivate_confirm_y_label']          = 'យល់​ព្រម:';
$lang['deactivate_confirm_n_label']          = 'មិនយល់​ព្រម:';
$lang['deactivate_submit_btn']               = lang('btn_submit_label');
$lang['deactivate_validation_confirm_label'] = 'បញ្ចាក់';
$lang['deactivate_validation_user_id_label'] = 'លេខ​សំគាល់​'.$lang['index_heading'];

// Create User
$lang['create_user_heading']                           = $lang['index_create_user_link'];
$lang['create_user_subheading']                        = 'ចូលបំពេញព័ត៌មាន​'.$lang['index_heading'].'ខាងក្រោម';
$lang['create_user_username_label']                    = $lang['index_username_th'].':';
$lang['create_user_email_label']                       = $lang['index_email_th'].':';
$lang['create_user_password_label']                    = $lang['login_password_label'].':';
$lang['create_user_password_confirm_label']            = $lang['deactivate_validation_confirm_label'].$lang['login_password_label'].':';
$lang['create_user_people_group_label']                 = 'ក្រុម:';
$lang['create_user_submit_btn']                        = lang('btn_submit_label');
$lang['create_user_validation_username_label']         = $lang['index_username_th'];
$lang['create_user_validation_email_label']            = $lang['index_email_th'];
$lang['create_user_validation_password_label']         = $lang['login_password_label'];
$lang['create_user_validation_password_confirm_label'] = $lang['deactivate_validation_confirm_label'].$lang['login_password_label'];
$lang['create_user_validation_people_group_label'] = 'ក្រុម';

// Edit User
$lang['edit_user_heading']                           = 'កែប្រែ'.$lang['index_heading'];
$lang['edit_user_subheading']                        = 'ចូលបំពេញព័ត៌មាន​'.$lang['index_heading'].'ខាងក្រោម';
$lang['edit_user_username_label']                    = $lang['create_user_username_label'];
$lang['edit_user_email_label']                       = $lang['create_user_email_label'];
$lang['edit_user_password_label']                    = $lang['create_user_password_label'].' ( ប្រសិនជាផ្លាស់​ប្តូរ )';
$lang['edit_user_password_confirm_label']            = $lang['create_user_password_confirm_label'].' (ប្រសិនជាផ្លាស់​ប្តូរ)';
$lang['edit_user_submit_btn']                        = $lang['create_user_submit_btn'];
$lang['edit_user_validation_username_label']         = $lang['create_user_validation_username_label'];
$lang['edit_user_validation_email_label']            = $lang['create_user_validation_email_label'];
$lang['edit_user_validation_password_label']         = $lang['create_user_validation_password_label'];
$lang['edit_user_validation_password_confirm_label'] = $lang['create_user_validation_password_confirm_label'];

// Change Password
$lang['change_password_heading']                               = 'ផ្លាស់​ប្តូរ'.$lang['login_password_label'];
$lang['change_password_old_password_label']                    = $lang['login_password_label'].'ចាស់:';
$lang['change_password_new_password_label']                    = $lang['login_password_label'].'ថ្មី (យ៉ាងតិច %s តួអក្សរ):';
$lang['change_password_new_password_confirm_label']            = $lang['deactivate_validation_confirm_label'].$lang['login_password_label'].'ថ្មី:';
$lang['change_password_submit_btn']                            = 'ផ្លាស់​ប្តូរ';
$lang['change_password_validation_old_password_label']         = $lang['login_password_label'].'ចាស់';
$lang['change_password_validation_new_password_label']         = $lang['login_password_label'].'ថ្មី';
$lang['change_password_validation_new_password_confirm_label'] = $lang['deactivate_validation_confirm_label'].$lang['login_password_label'].'ថ្មី';

// Forgot Password
$lang['forgot_password_heading']                 = 'ភ្លេចពាក្យ​សំងាត់​';
$lang['forgot_password_subheading']              = 'ចូលបំពេញ %s ដូច្នេះ​យើង​អាច​ផ្ញើរ​អុីម៉ែលទៅអ្នក​ដើម្បីផ្លាស់​ប្តូរពាក្យ​សំងាត់។';
$lang['forgot_password_email_label']             = '%s:';
$lang['forgot_password_submit_btn']              = lang('btn_submit_label');
$lang['forgot_password_validation_email_label']  = 'អុីម៉ែល';
$lang['forgot_password_username_identity_label'] = 'ឈ្មោះ​អ្នកប្រើ​';
$lang['forgot_password_email_identity_label']    = 'អុីម៉ែល';
$lang['forgot_password_email_not_found']         = 'មិន​មានអុីម៉ែល​នេះ​ទេ';

// Reset Password
$lang['reset_password_heading']                               = 'ផ្លាស់​ប្តូរពាក្យសំងាត់';
$lang['reset_password_new_password_label']                    = 'ពាក្យសំងាត់ថ្មី (យ៉ាងតិច %s តួអក្សរ):';
$lang['reset_password_new_password_confirm_label']            = 'បញ្ចាក់​ពាក្យសំងាត់ថ្មី:';
$lang['reset_password_submit_btn']                            = 'ផ្លាស់​ប្តូរ';
$lang['reset_password_validation_new_password_label']         = 'ពាក្យសំងាត់ថ្មី';
$lang['reset_password_validation_new_password_confirm_label'] = 'បញ្ចាក់​ពាក្យសំងាត់ថ្មី';

// Member
$lang['member_label'] = lang('member_label');
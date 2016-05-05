<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


// Index
$lang['index_article_heading']     = lang('article_menu_label');
$lang['index_article_subheading']  = 'ខាងក្រោមនេះជាតារាង'.$lang['index_article_heading'].'ទាំង​អស់';
$lang['index_article_title_th']    = 'ចំណងជើង';
$lang['index_article_keyword_th']   = 'ពាក្យ​គន្លឹះ';
$lang['index_article_publish_th']  = 'កាលបរិច្ឆេទចេញផ្សាយ';
$lang['index_article_type_th']     = 'ប្រភេទ'.$lang['index_article_heading'];
$lang['index_article_category_th'] = 'ក្រុម'.$lang['index_article_heading'];
$lang['index_article_location_th'] = 'ទីតាំងកើតហេតុ';
$lang['index_article_source_th']   = 'ប្រភព';
$lang['index_article_full_th']   = 'អត្ថបទពេញ';
$lang['index_article_action_th']   = 'សកម្មភាព';
$lang['index_article_create_link'] = 'បង្កើត'.$lang['index_article_heading'].'ថ្មី';
$lang['index_article_preview_link'] = 'មើល​'.$lang['index_article_heading'];

// Article Form
$lang['form_article_create_heading']           = 'បង្កើតអត្ថបទ';
$lang['form_article_edit_heading']             = 'កែប្រែអត្ថបទ';
$lang['form_article_subheading']               = 'ចូលបំពេញព័ត៌មាន'.$lang['index_article_heading'].'ខាងក្រោម';
$lang['form_article_title_label']              = $lang['index_article_title_th'].':';
$lang['form_article_keyword_label']           = $lang['index_article_keyword_th'].':';
$lang['form_article_detail_label']             = 'ព័ត៌មានលំអិត:';
$lang['form_article_publish_label']            = $lang['index_article_publish_th'].':';
$lang['form_article_source_label']             = $lang['index_article_source_th'].': (ឈ្មោះ​ប្រភព, url)';
$lang['form_article_type_label']               = $lang['index_article_type_th'].':';
$lang['form_article_category_label']           = $lang['index_article_category_th'].':';
$lang['form_article_pcaption_label']           = 'ចំណងជើងរូបភាព:';
$lang['form_article_picture_label']            = 'រូបភាព:';
$lang['form_article_province_label']                = lang('province_label').':';
$lang['form_article_khan_label']                = lang('khan_label').':';
$lang['form_article_sangkat_label']                = lang('sangkat_label').':';
$lang['form_article_phum_label']                = lang('phum_label').':';
$lang['form_article_fb_label'] = 'សម្រង់សង្ខេប​លើ​ Facebook:';
$lang['form_article_fbp_label'] = 'បញ្ចូល​ទៅ​ Facebook:';
$lang['form_article_full_label'] = $lang['index_article_full_th'];
$lang['form_article_full_article_label'] = 'តើ​នេះ​ជា​អត្ថបទ​ពេញ?';

$lang['form_article_validation_title_label']   = $lang['index_article_title_th'];
$lang['form_article_validation_keyword_label']   = $lang['index_article_keyword_th'];
$lang['form_article_validation_detail_label']  = 'ព័ត៌មានលំអិត';
$lang['form_article_validation_publish_label'] = $lang['index_article_publish_th'];
$lang['form_article_validation_source_label']  = $lang['index_article_source_th'];
$lang['form_article_validation_type_label']    = $lang['index_article_type_th'];
$lang['form_article_validation_category_label']= $lang['index_article_category_th'];
$lang['form_article_validation_pcaption_label']= 'ចំណងជើងរូបភាព';
$lang['form_article_validation_province_label']                = lang('province_label');
$lang['form_article_validation_khan_label']                = lang('khan_label');
$lang['form_article_validation_sangkat_label']                = lang('sangkat_label');
$lang['form_article_validation_phum_label']                = lang('phum_label');
$lang['form_article_validation_fb_label'] = 'សម្រង់សង្ខេប​លើ​ Facebook';
$lang['form_article_validation_fbp_label'] = 'បញ្ចូល​ទៅ​ Facebook';
$lang['form_article_validation_full_label'] = $lang['form_article_full_label'];


$lang['form_article_add_picture_label']= 'បញ្ចូល​រូបភាព';

// Report
$lang['form_article_report_success']          = $lang['index_article_heading'].'រក្សាទុករួចរាល់!';

// Delete Group
$lang['del_article_report_success']           = $lang['index_article_heading'].'លុបរួចរាល់!';
$lang['del_article_report_error']             = $lang['index_article_heading'].'កំពុងលុបមានបញ្ហា!';

// view article
$lang['view_article_keyword_th'] = $lang['index_article_keyword_th'];
$lang['view_article_cateogry_th'] = $lang['index_article_category_th'];
$lang['view_article_type_th']     = $lang['index_article_type_th'];
$lang['view_article_location_label'] = $lang['index_article_location_th'];
$lang['view_article_published_on_th'] = $lang['index_article_publish_th'];
$lang['view_article_source_th']    = $lang['index_article_source_th'];
$lang['view_article_detail_label']    = $lang['form_article_validation_detail_label'];
$lang['view_article_document_label']  = 'ឯកសារ';
$lang['view_article_video_label']     = 'វីដេអូ';
$lang['view_article_audio_label']     = 'សម្លេង';

$lang['view_caption_th'] = $lang['index_article_title_th'];
$lang['view_preview_th'] = $lang['index_article_preview_link'];
$lang['view_play_th'] = 'ស្តាប់';
$lang['view_action_th'] = $lang['index_article_action_th'];
$lang['view_open_th'] = 'បើក';

//sidebar
$lang['document_menu_label']     = 'បង្កើត​'.$lang['view_article_document_label'];
$lang['audio_menu_label']     = 'បង្កើត​'.$lang['view_article_audio_label'];
$lang['video_menu_label']     = '​បង្កើត​'.$lang['view_article_video_label'];
$lang['description_menu_label'] = '​បន្ថែម'.$lang['index_article_heading'];
$lang['article_link_library_menu_label'] = '​ភ្ជាប់​ទៅ​កាន់​'.$lang['view_article_document_label'].'ផ្សេងទៀត';
$lang['article_link_product_menu_label'] = '​ភ្ជាប់​ទៅ​កាន់​សម្ភារៈ និងកសិផល';
$lang['article_link_real_estate_menu_label'] = '​ភ្ជាប់​ទៅ​កាន់​ស្រែ ចំការ កសិដ្ឆាន';
$lang['article_link_job_menu_label'] = '​ភ្ជាប់​ទៅ​កាន់​'.lang('job_menu_label');
$lang['article_link_people_menu_label'] = '​ភ្ជាប់​ទៅ​កាន់​បុគ្គល​សំខាន់​ៗ';
$lang['article_link_agribook_menu_label'] = '​ភ្ជាប់​ទៅ​កាន់​​ក្រុម​ហ៊ុន​ ឫ​ស្ថាប័នផ្សេងៗ';



//search
$lang['search_heading_label'] = 'ស្វែងរក';
$lang['search_caption_label'] = 'ស្វែងរក';
$lang['search_placeholder_label'] = 'ស្វែងរក​អត្ថបទ​តាម​'.$lang['index_article_title_th'];

// Filter by Type
$lang['filter_type_heading_label'] = 'ស្វែងរកតាម​'.$lang['index_article_type_th'];
$lang['filter_type_caption_label'] = 'ជ្រើស​'.$lang['index_article_type_th'];

// Filter by category
$lang['filter_cat_heading_label'] = 'ស្វែងរកតាម​'.$lang['index_article_category_th'];
$lang['filter_cat_caption_label'] = 'ជ្រើស​​'.$lang['index_article_category_th'];

//change category
$lang['change_cat_heading_label'] = lang('article_change_category_menu_label');
$lang['change_cat_caption_label'] = $lang['filter_cat_caption_label'];
$lang['change_cat_change_label'] = 'ប្តូរ​ទៅ';
$lang['change_cat_article_label'] = 'អត្ថបទ​';
$lang['change_cat_btn'] = 'ផ្លាស់​ប្តូរ';
$lang['change_cat_success_label'] = 'អត្ថបទ​ត្រូវ​បាន​ផ្លាស់​ប្តូរ​ក្រុម​រួចរាល់';


// Link to Library
$lang['check_th'] = 'ជ្រើស​រើស';
$lang['link_title_th'] = $lang['index_article_title_th'];
$lang['link_preview_th'] = 'មើល';
$lang['link_btn'] = 'ភ្ជាប់';

// Detail
$lang['index_article_detail_heading']     = $lang['index_article_heading'].'បន្ថែម';
$lang['index_article_detail_subheading']  = 'ខាងក្រោមនេះជាតារាង'.$lang['index_article_detail_heading'] ;
$lang['index_article_detail_title_th']    = $lang['index_article_title_th'];
$lang['index_article_detail_desc_th']     = $lang['form_article_validation_detail_label'];
$lang['index_article_detail_photo_th']    = $lang['form_article_validation_pcaption_label'];
$lang['index_article_detail_action_th']   = $lang['index_article_action_th'];
$lang['index_article_detail_create_link'] = 'បង្កើត'.$lang['index_article_detail_heading'].'ថ្មី';

// Article Form
$lang['form_article_detail_create_heading']           = 'បង្កើត'.$lang['index_article_detail_heading'];
$lang['form_article_detail_edit_heading']             = 'កែប្រែ​'.$lang['index_article_detail_heading'];
$lang['form_article_detail_subheading']               = 'បំពេញ​ព័ត៌មាន​'.$lang['index_article_detail_heading'].'ខាង​ក្រោម';
$lang['form_article_detail_title_label']              = $lang['form_article_title_label'];
$lang['form_article_detail_desc_label']               = $lang['form_article_detail_label'];
$lang['form_article_detail_pcaption_label']           = $lang['form_article_pcaption_label'];
$lang['form_article_detail_picture_label']            = $lang['form_article_picture_label'];
$lang['form_article_detail_validation_title_label']   = $lang['form_article_validation_title_label'];
$lang['form_article_detail_detail_validation_desc_label']  = $lang['form_article_validation_detail_label'];
$lang['form_article_detail_validation_pcaption_label']= $lang['form_article_validation_pcaption_label'];

// Report
$lang['form_article_detail_report_success']          = $lang['index_article_detail_heading'].'រក្សា​ទុករួចរាល់​';

// Delete Group
$lang['del_article_detail_report_success']           = $lang['index_article_detail_heading'].'លុប​រួចរាល់!';
$lang['del_article_detail_report_error']             = $lang['index_article_detail_heading'].'កំពុង​លុប​មាន​បញ្ហា!';
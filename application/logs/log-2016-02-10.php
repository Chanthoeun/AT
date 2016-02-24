<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2016-02-10 09:45:54 --> Severity: Notice --> Undefined variable: rs6 C:\xampp\htdocs\agritoday-new.dev\application\helpers\general_helper.php 739
ERROR - 2016-02-10 09:45:54 --> Severity: Notice --> Undefined variable: rs5 C:\xampp\htdocs\agritoday-new.dev\application\helpers\general_helper.php 739
ERROR - 2016-02-10 09:45:54 --> Severity: Notice --> Undefined variable: rs4 C:\xampp\htdocs\agritoday-new.dev\application\helpers\general_helper.php 739
ERROR - 2016-02-10 09:45:54 --> Severity: Notice --> Undefined variable: rs3 C:\xampp\htdocs\agritoday-new.dev\application\helpers\general_helper.php 739
ERROR - 2016-02-10 09:45:54 --> Severity: Notice --> Undefined variable: rs2 C:\xampp\htdocs\agritoday-new.dev\application\helpers\general_helper.php 739
ERROR - 2016-02-10 09:45:54 --> Severity: Notice --> Undefined variable: rs1 C:\xampp\htdocs\agritoday-new.dev\application\helpers\general_helper.php 739
ERROR - 2016-02-10 09:45:54 --> Severity: Warning --> array_merge(): Argument #1 is not an array C:\xampp\htdocs\agritoday-new.dev\application\helpers\general_helper.php 739
ERROR - 2016-02-10 09:49:00 --> Severity: Notice --> Undefined variable: result C:\xampp\htdocs\agritoday-new.dev\application\helpers\general_helper.php 745
ERROR - 2016-02-10 09:51:06 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\agritoday-new.dev\application\libraries\Template.php 572
ERROR - 2016-02-10 09:53:57 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\agritoday-new.dev\application\libraries\Template.php 572
ERROR - 2016-02-10 09:56:35 --> Severity: Compile Error --> Only variables can be passed by reference C:\xampp\htdocs\agritoday-new.dev\application\modules\locations\controllers\Locations.php 82
ERROR - 2016-02-10 09:56:47 --> Severity: Compile Error --> Only variables can be passed by reference C:\xampp\htdocs\agritoday-new.dev\application\modules\locations\controllers\Locations.php 82
ERROR - 2016-02-10 10:01:39 --> 404 Page Not Found: 
ERROR - 2016-02-10 10:26:51 --> 404 Page Not Found: 
ERROR - 2016-02-10 10:28:02 --> Query error: Table 'agritoday_v2.article_type' doesn't exist - Invalid query: SELECT `article_type`.*, `p`.`caption` as `p_caption`
FROM `article_type`
LEFT JOIN `article_type` as `p` ON `article_type`.`parent_id` = `p`.`id`
WHERE `article_type`.`parent_id` =0
ERROR - 2016-02-10 10:28:12 --> 404 Page Not Found: 
ERROR - 2016-02-10 11:49:01 --> Could not find the language line "index_article_subheading"
ERROR - 2016-02-10 14:08:21 --> Query error: Table 'agritoday_v2.article' doesn't exist - Invalid query: SELECT `article`.*, `article_type`.`caption` as `artcaption`, `category`.`caption` as `catcaption`
FROM `article`
LEFT JOIN `article_type` ON `article`.`article_type_id` = `article_type`.`id`
LEFT JOIN `category` ON `article`.`category_id` = `category`.`id`
ORDER BY `created_at` DESC
 LIMIT 300
ERROR - 2016-02-10 15:05:46 --> Severity: Notice --> Undefined variable: ags C:\xampp\htdocs\agritoday-new.dev\application\modules\agribook_group\views\index.php 30
ERROR - 2016-02-10 15:10:51 --> Query error: Unknown column 'article' in 'field list' - Invalid query: INSERT INTO `agribook_group` (`caption`, `slug`, `parent_id`, `article`, `market`, `real_estate`, `job`, `order`, `status`, `created_at`, `updated_at`) VALUES ('កសិដ្ឋាន', 'កសិដ្ឋាន', '', '', '', '', '', 6, 1, 1455091851, 1455091851)
ERROR - 2016-02-10 16:19:00 --> Severity: Parsing Error --> syntax error, unexpected '​​​​' (T_STRING) C:\xampp\htdocs\agritoday-new.dev\application\modules\agribooks\language\english\agribook_lang.php 27
ERROR - 2016-02-10 16:20:21 --> Severity: Parsing Error --> syntax error, unexpected '​​​​' (T_STRING) C:\xampp\htdocs\agritoday-new.dev\application\modules\agribooks\language\english\agribook_lang.php 45
ERROR - 2016-02-10 16:20:48 --> Severity: Notice --> Undefined index: index_agribook_organization_th C:\xampp\htdocs\agritoday-new.dev\application\modules\agribooks\language\english\agribook_lang.php 64
ERROR - 2016-02-10 16:20:48 --> Severity: Notice --> Undefined index: form_agribook_validation_position_label C:\xampp\htdocs\agritoday-new.dev\application\modules\agribooks\language\english\agribook_lang.php 65
ERROR - 2016-02-10 16:20:48 --> Severity: Notice --> Undefined index: form_agribook_validation_go_label C:\xampp\htdocs\agritoday-new.dev\application\modules\agribooks\language\english\agribook_lang.php 70
ERROR - 2016-02-10 16:21:20 --> Severity: Parsing Error --> syntax error, unexpected '​​​​' (T_STRING) C:\xampp\htdocs\agritoday-new.dev\application\modules\agribooks\language\english\agribook_lang.php 27
ERROR - 2016-02-10 16:55:43 --> Severity: Notice --> Undefined variable: socil C:\xampp\htdocs\agritoday-new.dev\application\modules\agribooks\views\create.php 125

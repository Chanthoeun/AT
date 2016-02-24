<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2016-02-04 11:09:20 --> Query error: Table 'agritoday_v2.video' doesn't exist - Invalid query: SELECT `video`.*, `category`.`caption` as `catcaption`, `l`.`file`, `l`.`picture`
FROM `video`
LEFT JOIN `category` ON `video`.`category_id` = `category`.`id`
LEFT JOIN `video_library` as `vl` ON `video`.`id` = `vl`.`video_id`
LEFT JOIN `library` as `l` ON `vl`.`library_id` = `l`.`id`
ORDER BY `created_at` DESC
 LIMIT 300
ERROR - 2016-02-04 11:11:00 --> Query error: Table 'agritoday_v2.library' doesn't exist - Invalid query: SELECT `library`.*, `g`.`caption` as `group`
FROM `library`
LEFT JOIN `library_group` as `g` ON `library`.`library_group_id` = `g`.`id`
 LIMIT 300
ERROR - 2016-02-04 11:12:32 --> Query error: Table 'agritoday_v2.category' doesn't exist - Invalid query: SELECT `category`.*, `p`.`caption` as `p_caption`
FROM `category`
LEFT JOIN `category` as `p` ON `category`.`parent_id` = `p`.`id`
WHERE `category`.`parent_id` =0
ERROR - 2016-02-04 11:30:30 --> Could not find the language line "form_video_category_label"
ERROR - 2016-02-04 13:49:28 --> Severity: Notice --> Undefined offset: 1 C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\controllers\Admin.php 147
ERROR - 2016-02-04 13:49:30 --> 404 Page Not Found: ../modules/videos/controllers//index
ERROR - 2016-02-04 13:49:39 --> 404 Page Not Found: ../modules/videos/controllers//index
ERROR - 2016-02-04 13:50:25 --> Severity: Notice --> Undefined offset: 1 C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\controllers\Admin.php 147
ERROR - 2016-02-04 13:50:37 --> Severity: Notice --> Undefined offset: 1 C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\controllers\Admin.php 147
ERROR - 2016-02-04 13:56:46 --> Severity: Notice --> Undefined offset: 1 C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\controllers\Admin.php 151
ERROR - 2016-02-04 14:01:41 --> Severity: Error --> Call to undefined function get_video_info() C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\controllers\Admin.php 160
ERROR - 2016-02-04 14:03:16 --> Severity: Error --> Call to undefined function get_video_info() C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\controllers\Admin.php 160
ERROR - 2016-02-04 14:04:07 --> Severity: Error --> Call to undefined function video_info() C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\controllers\Admin.php 160
ERROR - 2016-02-04 14:04:50 --> Severity: Error --> Call to undefined function video_info() C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\controllers\Admin.php 161
ERROR - 2016-02-04 14:05:34 --> Severity: Error --> Call to undefined function get_video_info() C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\controllers\Admin.php 161
ERROR - 2016-02-04 14:08:30 --> Severity: Error --> Call to undefined function get_vedio_info() C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\controllers\Admin.php 161
ERROR - 2016-02-04 14:08:55 --> Severity: Error --> Call to undefined function get_video_info() C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\controllers\Admin.php 161
ERROR - 2016-02-04 14:09:22 --> Severity: Error --> Call to undefined function get_video_info() C:\xampp\htdocs\agritoday-new.dev\application\modules\library\controllers\Library.php 145
ERROR - 2016-02-04 14:34:25 --> Severity: Notice --> Undefined property: stdClass::$published_on C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\views\view.php 27
ERROR - 2016-02-04 14:34:25 --> Could not find the language line "index_job_action_th"
ERROR - 2016-02-04 14:34:25 --> Severity: Notice --> Undefined property: stdClass::$thumbnail C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\views\view.php 46
ERROR - 2016-02-04 14:34:25 --> Severity: Notice --> Undefined property: stdClass::$type C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\views\view.php 73
ERROR - 2016-02-04 14:34:25 --> Severity: Notice --> Undefined property: stdClass::$type C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\views\view.php 81
ERROR - 2016-02-04 14:34:25 --> Severity: Notice --> Undefined property: stdClass::$type C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\views\view.php 85
ERROR - 2016-02-04 15:03:38 --> Severity: Notice --> Undefined property: stdClass::$published_on C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\views\view.php 27
ERROR - 2016-02-04 15:03:38 --> Could not find the language line "index_job_action_th"
ERROR - 2016-02-04 15:03:38 --> Severity: Notice --> Undefined property: stdClass::$thumbnail C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\views\view.php 46
ERROR - 2016-02-04 15:03:38 --> Severity: Notice --> Undefined property: stdClass::$type C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\views\view.php 73
ERROR - 2016-02-04 15:03:38 --> Severity: Notice --> Undefined property: stdClass::$type C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\views\view.php 81
ERROR - 2016-02-04 15:03:38 --> Severity: Notice --> Undefined property: stdClass::$type C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\views\view.php 85
ERROR - 2016-02-04 15:05:38 --> Severity: Notice --> Undefined property: stdClass::$published_on C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\views\view.php 27
ERROR - 2016-02-04 15:05:38 --> Could not find the language line "index_job_action_th"
ERROR - 2016-02-04 15:05:38 --> Severity: Notice --> Undefined property: stdClass::$thumbnail C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\views\view.php 46
ERROR - 2016-02-04 15:05:38 --> Severity: Notice --> Undefined property: stdClass::$type C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\views\view.php 73
ERROR - 2016-02-04 15:05:38 --> Severity: Notice --> Undefined property: stdClass::$type C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\views\view.php 81
ERROR - 2016-02-04 15:05:38 --> Severity: Notice --> Undefined property: stdClass::$type C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\views\view.php 85
ERROR - 2016-02-04 15:16:48 --> Could not find the language line "index_job_action_th"
ERROR - 2016-02-04 15:16:48 --> Severity: Notice --> Undefined property: stdClass::$thumbnail C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\views\view.php 46
ERROR - 2016-02-04 15:16:48 --> Could not find the language line "view_thumbnail_upload_btn"
ERROR - 2016-02-04 15:16:48 --> Severity: Notice --> Undefined property: stdClass::$type C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\views\view.php 73
ERROR - 2016-02-04 15:16:48 --> Severity: Notice --> Undefined property: stdClass::$type C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\views\view.php 81
ERROR - 2016-02-04 15:16:48 --> Severity: Notice --> Undefined property: stdClass::$type C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\views\view.php 85
ERROR - 2016-02-04 15:18:34 --> Could not find the language line "index_job_action_th"
ERROR - 2016-02-04 15:18:34 --> Severity: Notice --> Undefined property: stdClass::$thumbnail C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\views\view.php 46
ERROR - 2016-02-04 15:18:34 --> Could not find the language line "view_thumbnail_upload_btn"
ERROR - 2016-02-04 15:18:34 --> Severity: Notice --> Undefined property: stdClass::$type C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\views\view.php 73
ERROR - 2016-02-04 15:18:34 --> Severity: Notice --> Undefined property: stdClass::$type C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\views\view.php 81
ERROR - 2016-02-04 15:18:34 --> Severity: Notice --> Undefined property: stdClass::$type C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\views\view.php 85
ERROR - 2016-02-04 15:19:18 --> Could not find the language line "index_job_action_th"
ERROR - 2016-02-04 15:19:18 --> Could not find the language line "view_thumbnail_upload_btn"
ERROR - 2016-02-04 15:19:18 --> Severity: Notice --> Undefined property: stdClass::$type C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\views\view.php 73
ERROR - 2016-02-04 15:19:18 --> Severity: Notice --> Undefined property: stdClass::$type C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\views\view.php 81
ERROR - 2016-02-04 15:19:18 --> Severity: Notice --> Undefined property: stdClass::$type C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\views\view.php 85
ERROR - 2016-02-04 15:22:00 --> Could not find the language line "index_job_action_th"
ERROR - 2016-02-04 15:22:00 --> Severity: Notice --> Undefined property: stdClass::$type C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\views\view.php 73
ERROR - 2016-02-04 15:22:00 --> Severity: Notice --> Undefined property: stdClass::$type C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\views\view.php 81
ERROR - 2016-02-04 15:22:00 --> Severity: Notice --> Undefined property: stdClass::$type C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\views\view.php 85
ERROR - 2016-02-04 15:24:32 --> Could not find the language line "index_job_action_th"
ERROR - 2016-02-04 15:26:09 --> Could not find the language line "index_job_action_th"
ERROR - 2016-02-04 15:33:01 --> Could not find the language line "index_job_action_th"
ERROR - 2016-02-04 15:33:11 --> Severity: Notice --> Undefined property: stdClass::$thumbnail C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\controllers\Admin.php 378
ERROR - 2016-02-04 15:33:11 --> Severity: Notice --> Undefined variable: lid C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\controllers\Admin.php 385
ERROR - 2016-02-04 15:33:11 --> Query error: Unknown column 'thumbnail' in 'field list' - Invalid query: UPDATE `library` SET `thumbnail` = 'meq0ijor68jpg.jpg', `updated_at` = 1454574791
WHERE `id` IS NULL
ERROR - 2016-02-04 15:33:33 --> Could not find the language line "index_job_action_th"
ERROR - 2016-02-04 15:33:41 --> Severity: Notice --> Undefined property: stdClass::$thumbnail C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\controllers\Admin.php 378
ERROR - 2016-02-04 15:33:41 --> Severity: Notice --> Undefined variable: lid C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\controllers\Admin.php 385
ERROR - 2016-02-04 15:33:42 --> Could not find the language line "index_job_action_th"
ERROR - 2016-02-04 15:34:17 --> Could not find the language line "index_job_action_th"
ERROR - 2016-02-04 15:34:25 --> Severity: Notice --> Undefined property: stdClass::$thumbnail C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\controllers\Admin.php 378
ERROR - 2016-02-04 15:34:27 --> Could not find the language line "index_job_action_th"
ERROR - 2016-02-04 15:35:13 --> Could not find the language line "index_job_action_th"
ERROR - 2016-02-04 15:35:23 --> Severity: Notice --> Undefined property: stdClass::$pictue C:\xampp\htdocs\agritoday-new.dev\application\modules\videos\controllers\Admin.php 378
ERROR - 2016-02-04 15:35:24 --> Could not find the language line "index_job_action_th"
ERROR - 2016-02-04 15:35:45 --> Could not find the language line "index_job_action_th"
ERROR - 2016-02-04 15:37:50 --> Could not find the language line "index_job_action_th"
ERROR - 2016-02-04 15:38:03 --> Could not find the language line "index_job_action_th"
ERROR - 2016-02-04 15:38:54 --> Could not find the language line "index_job_action_th"
ERROR - 2016-02-04 15:45:41 --> Could not find the language line "index_job_action_th"
ERROR - 2016-02-04 17:23:43 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '`>=`
 LIMIT 1' at line 4 - Invalid query: SELECT `job`.*, `category`.`caption` as `catcaption`
FROM `job`
LEFT JOIN `category` ON `job`.`category_id` = `category`.`id`
ORDER BY `expire_date` `>=`
 LIMIT 1
ERROR - 2016-02-04 17:27:19 --> 404 Page Not Found: ../modules/jobs/controllers//index
ERROR - 2016-02-04 17:27:28 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '`>=`
 LIMIT 1' at line 4 - Invalid query: SELECT `job`.*, `category`.`caption` as `catcaption`
FROM `job`
LEFT JOIN `category` ON `job`.`category_id` = `category`.`id`
ORDER BY `expire_date` `>=`
 LIMIT 1

<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2016-01-21 10:14:03 --> 404 Page Not Found: /index
ERROR - 2016-01-21 10:30:23 --> Severity: Error --> Call to undefined method Articles::get_with() C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\controllers\Articles.php 321
ERROR - 2016-01-21 10:30:36 --> Query error: Table 'agritoday_v2.article_media' doesn't exist - Invalid query: SELECT `article_media`.*, `media`.`caption`, `media`.`file`, `media`.`type`
FROM `article_media`
LEFT JOIN `media` ON `article_media`.`media_id` = `media`.`id`
WHERE `article_id` = '1'
ERROR - 2016-01-21 10:30:51 --> Query error: Table 'agritoday_v2.article_detail' doesn't exist - Invalid query: SELECT *
FROM `article_detail`
WHERE `article_id` = '1'
ERROR - 2016-01-21 10:30:59 --> Severity: Notice --> Undefined variable: details C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 60
ERROR - 2016-01-21 10:30:59 --> Severity: Notice --> Undefined variable: article_medias C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-21 10:30:59 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-21 11:04:27 --> Severity: Parsing Error --> syntax error, unexpected 'form_article_title_label' (T_STRING) C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\language\english\article_lang.php 21
ERROR - 2016-01-21 12:14:21 --> Could not find the language line "product_menu_label"
ERROR - 2016-01-21 12:14:21 --> Could not find the language line "real_estate_menu_label"
ERROR - 2016-01-21 22:41:41 --> Could not find the language line "product_menu_label"
ERROR - 2016-01-21 22:41:41 --> Could not find the language line "real_estate_menu_label"

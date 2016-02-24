<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2016-01-30 09:12:25 --> Severity: Notice --> Undefined variable: article_medias C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-30 09:12:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-30 09:15:32 --> Severity: Notice --> Undefined variable: article_medias C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-30 09:15:32 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-30 22:29:59 --> Severity: Notice --> Undefined variable: library C:\xampp\htdocs\agritoday-new.dev\application\modules\library\controllers\Library.php 290
ERROR - 2016-01-30 22:29:59 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\agritoday-new.dev\application\modules\library\controllers\Library.php 290
ERROR - 2016-01-30 22:33:29 --> Severity: Notice --> Undefined index: document C:\xampp\htdocs\agritoday-new.dev\application\helpers\upload_helper.php 18
ERROR - 2016-01-30 22:33:29 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\agritoday-new.dev\application\helpers\general_helper.php 430
ERROR - 2016-01-30 22:33:29 --> Severity: Notice --> Undefined index: document C:\xampp\htdocs\agritoday-new.dev\application\helpers\upload_helper.php 39
ERROR - 2016-01-30 22:33:51 --> Severity: Notice --> Undefined variable: library C:\xampp\htdocs\agritoday-new.dev\application\modules\library\controllers\Library.php 290
ERROR - 2016-01-30 22:33:52 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\agritoday-new.dev\application\modules\library\controllers\Library.php 290
ERROR - 2016-01-30 22:34:06 --> Severity: Notice --> Undefined index: document C:\xampp\htdocs\agritoday-new.dev\application\helpers\upload_helper.php 18
ERROR - 2016-01-30 22:34:06 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\agritoday-new.dev\application\helpers\general_helper.php 430
ERROR - 2016-01-30 22:34:06 --> Severity: Notice --> Undefined index: document C:\xampp\htdocs\agritoday-new.dev\application\helpers\upload_helper.php 39
ERROR - 2016-01-30 22:34:19 --> Severity: Notice --> Undefined index: document C:\xampp\htdocs\agritoday-new.dev\application\helpers\upload_helper.php 18
ERROR - 2016-01-30 22:34:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\agritoday-new.dev\application\helpers\general_helper.php 430
ERROR - 2016-01-30 22:34:19 --> Severity: Notice --> Undefined index: document C:\xampp\htdocs\agritoday-new.dev\application\helpers\upload_helper.php 39
ERROR - 2016-01-30 22:35:21 --> Severity: Notice --> Undefined variable: library C:\xampp\htdocs\agritoday-new.dev\application\modules\library\controllers\Library.php 317
ERROR - 2016-01-30 22:35:21 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\agritoday-new.dev\application\modules\library\controllers\Library.php 317
ERROR - 2016-01-30 22:38:02 --> Severity: Notice --> Undefined variable: library C:\xampp\htdocs\agritoday-new.dev\application\modules\library\controllers\Library.php 319
ERROR - 2016-01-30 22:38:02 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\agritoday-new.dev\application\modules\library\controllers\Library.php 319
ERROR - 2016-01-30 22:44:01 --> Severity: Notice --> Undefined variable: libray C:\xampp\htdocs\agritoday-new.dev\application\modules\library\controllers\Library.php 351
ERROR - 2016-01-30 22:44:01 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\agritoday-new.dev\application\modules\library\controllers\Library.php 351
ERROR - 2016-01-30 22:44:01 --> Severity: Notice --> Undefined variable: libray C:\xampp\htdocs\agritoday-new.dev\application\modules\library\controllers\Library.php 354
ERROR - 2016-01-30 22:44:01 --> Severity: Notice --> Trying to get property of non-object C:\xampp\htdocs\agritoday-new.dev\application\modules\library\controllers\Library.php 354
ERROR - 2016-01-30 22:54:27 --> Query error: Table 'agritoday_v2.article_media' doesn't exist - Invalid query: SELECT `article_media`.*, `media`.`caption`, `media`.`file`, `media`.`type`
FROM `article_media`
LEFT JOIN `media` ON `article_media`.`media_id` = `media`.`id`
WHERE `article_id` = '1'

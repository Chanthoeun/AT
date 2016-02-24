<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2016-01-19 23:12:26 --> Query error: Unknown column 'type' in 'where clause' - Invalid query: SELECT `category`.`id`, `category`.`caption`, `category`.`parent_id`
FROM `category`
WHERE `type` = 1
ERROR - 2016-01-19 23:37:01 --> Severity: Notice --> Undefined variable: category C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\create.php 49
ERROR - 2016-01-19 23:58:54 --> Severity: Error --> Call to undefined method Articles::get_with() C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\controllers\Articles.php 322
ERROR - 2016-01-19 23:59:02 --> Query error: Unknown column 'type' in 'where clause' - Invalid query: SELECT `category`.`id`, `category`.`caption`, `category`.`parent_id`
FROM `category`
WHERE `type` =0

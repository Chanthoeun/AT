<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2016-01-28 10:35:36 --> Severity: Notice --> Undefined variable: details C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 60
ERROR - 2016-01-28 10:35:36 --> Severity: Notice --> Undefined variable: article_medias C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 10:35:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 10:35:36 --> 404 Page Not Found: /index
ERROR - 2016-01-28 10:36:32 --> Severity: Notice --> Undefined variable: details C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 60
ERROR - 2016-01-28 10:36:32 --> Severity: Notice --> Undefined variable: article_medias C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 10:36:32 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 10:36:33 --> 404 Page Not Found: /index
ERROR - 2016-01-28 10:42:08 --> Severity: Notice --> Undefined variable: details C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 60
ERROR - 2016-01-28 10:42:08 --> Severity: Notice --> Undefined variable: article_medias C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 10:42:09 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 10:42:09 --> 404 Page Not Found: /index
ERROR - 2016-01-28 10:42:40 --> Severity: Notice --> Undefined variable: details C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 60
ERROR - 2016-01-28 10:42:40 --> Severity: Notice --> Undefined variable: article_medias C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 10:42:40 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 10:49:50 --> Query error: Unknown column '%E1%9E%A2%E1%9E%B6%E1%9E%98%E1%9F%81%E1%9E%9A%E1%9E%B7%E1%9E%80%E2%80%8B%E1%9E%94%E1%9F%92%E1%9E%8F%E1%9F%81%E1%9E%87%E1%9F%92%E1%9E%89%E1%9E%B6%E2%80%8B%E1%9E%96%E1%9E%84%E1%9F%92%E1%9E%9A%E1' in 'where clause' - Invalid query: SELECT `article`.*, `article_type`.`caption` as `artcaption`, `category`.`caption` as `catcaption`
FROM `article`
LEFT JOIN `article_type` ON `article`.`article_type_id` = `article_type`.`id`
LEFT JOIN `category` ON `article`.`category_id` = `category`.`id`
WHERE `%E1%9E%A2%E1%9E%B6%E1%9E%98%E1%9F%81%E1%9E%9A%E1%9E%B7%E1%9E%80%E2%80%8B%E1%9E%94%E1%9F%92%E1%9E%8F%E1%9F%81%E1%9E%87%E1%9F%92%E1%9E%89%E1%9E%B6%E2%80%8B%E1%9E%96%E1%9E%84%E1%9F%92%E1%9E%9A%E1%9E%B9%E1%9E%84%E2%80%8B%E1%9E%91%E1%9F%86%E1%9E%93%E1%9E%B6%E1%9E%80%E1%9F%8B%E2%80%8B%E1%9E%91%E1%9F%86%E1%9E%93%E1%9E%84%E2%80%8B%E1%9E%96%E1%9E%B6%E1%9E%8E%E1%9E%B7%E1%9E%87%E1%9F%92%E1%9E%87%E1%9E%80%E1%9E%98%E1%9F%92%E1%9E%98_%E1%9E%9C%E1%9E%B7%E1%9E%93%E1%9E%B7%E1%9E%99%E1%9F%84%E1%9E%82%E2%80%8B%E1%9E%87%E1%9E%B6%E1%9E%98%E1%9E%BD%E1%9E%99%E2%80%8B%E1%9E%80%E1%9E%98%E1%9F%92%E1%9E%96%E1%9E%BB%E1%9E%87%E1%9E%B6_1` IS NULL
ERROR - 2016-01-28 10:50:37 --> Query error: Unknown column '%E1%9E%A2%E1%9E%B6%E1%9E%98%E1%9F%81%E1%9E%9A%E1%9E%B7%E1%9E%80%E2%80%8B%E1%9E%94%E1%9F%92%E1%9E%8F%E1%9F%81%E1%9E%87%E1%9F%92%E1%9E%89%E1%9E%B6%E2%80%8B%E1%9E%96%E1%9E%84%E1%9F%92%E1%9E%9A%E1' in 'where clause' - Invalid query: SELECT `article`.*, `article_type`.`caption` as `artcaption`, `category`.`caption` as `catcaption`
FROM `article`
LEFT JOIN `article_type` ON `article`.`article_type_id` = `article_type`.`id`
LEFT JOIN `category` ON `article`.`category_id` = `category`.`id`
WHERE `%E1%9E%A2%E1%9E%B6%E1%9E%98%E1%9F%81%E1%9E%9A%E1%9E%B7%E1%9E%80%E2%80%8B%E1%9E%94%E1%9F%92%E1%9E%8F%E1%9F%81%E1%9E%87%E1%9F%92%E1%9E%89%E1%9E%B6%E2%80%8B%E1%9E%96%E1%9E%84%E1%9F%92%E1%9E%9A%E1%9E%B9%E1%9E%84%E2%80%8B%E1%9E%91%E1%9F%86%E1%9E%93%E1%9E%B6%E1%9E%80%E1%9F%8B%E2%80%8B%E1%9E%91%E1%9F%86%E1%9E%93%E1%9E%84%E2%80%8B%E1%9E%96%E1%9E%B6%E1%9E%8E%E1%9E%B7%E1%9E%87%E1%9F%92%E1%9E%87%E1%9E%80%E1%9E%98%E1%9F%92%E1%9E%98_%E1%9E%9C%E1%9E%B7%E1%9E%93%E1%9E%B7%E1%9E%99%E1%9F%84%E1%9E%82%E2%80%8B%E1%9E%87%E1%9E%B6%E1%9E%98%E1%9E%BD%E1%9E%99%E2%80%8B%E1%9E%80%E1%9E%98%E1%9F%92%E1%9E%96%E1%9E%BB%E1%9E%87%E1%9E%B6_1` IS NULL
ERROR - 2016-01-28 10:51:10 --> Query error: Unknown column '%E1%9E%A2%E1%9E%B6%E1%9E%98%E1%9F%81%E1%9E%9A%E1%9E%B7%E1%9E%80%E2%80%8B%E1%9E%94%E1%9F%92%E1%9E%8F%E1%9F%81%E1%9E%87%E1%9F%92%E1%9E%89%E1%9E%B6%E2%80%8B%E1%9E%96%E1%9E%84%E1%9F%92%E1%9E%9A%E1' in 'where clause' - Invalid query: SELECT `article`.*, `article_type`.`caption` as `artcaption`, `category`.`caption` as `catcaption`
FROM `article`
LEFT JOIN `article_type` ON `article`.`article_type_id` = `article_type`.`id`
LEFT JOIN `category` ON `article`.`category_id` = `category`.`id`
WHERE `%E1%9E%A2%E1%9E%B6%E1%9E%98%E1%9F%81%E1%9E%9A%E1%9E%B7%E1%9E%80%E2%80%8B%E1%9E%94%E1%9F%92%E1%9E%8F%E1%9F%81%E1%9E%87%E1%9F%92%E1%9E%89%E1%9E%B6%E2%80%8B%E1%9E%96%E1%9E%84%E1%9F%92%E1%9E%9A%E1%9E%B9%E1%9E%84%E2%80%8B%E1%9E%91%E1%9F%86%E1%9E%93%E1%9E%B6%E1%9E%80%E1%9F%8B%E2%80%8B%E1%9E%91%E1%9F%86%E1%9E%93%E1%9E%84%E2%80%8B%E1%9E%96%E1%9E%B6%E1%9E%8E%E1%9E%B7%E1%9E%87%E1%9F%92%E1%9E%87%E1%9E%80%E1%9E%98%E1%9F%92%E1%9E%98_%E1%9E%9C%E1%9E%B7%E1%9E%93%E1%9E%B7%E1%9E%99%E1%9F%84%E1%9E%82%E2%80%8B%E1%9E%87%E1%9E%B6%E1%9E%98%E1%9E%BD%E1%9E%99%E2%80%8B%E1%9E%80%E1%9E%98%E1%9F%92%E1%9E%96%E1%9E%BB%E1%9E%87%E1%9E%B6_1` IS NULL
ERROR - 2016-01-28 10:51:23 --> Severity: Warning --> Missing argument 1 for Articles::view() C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\controllers\Articles.php 311
ERROR - 2016-01-28 10:51:23 --> Severity: Notice --> Undefined variable: slug C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\controllers\Articles.php 314
ERROR - 2016-01-28 10:51:23 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'IS NULL' at line 5 - Invalid query: SELECT `article`.*, `article_type`.`caption` as `artcaption`, `category`.`caption` as `catcaption`
FROM `article`
LEFT JOIN `article_type` ON `article`.`article_type_id` = `article_type`.`id`
LEFT JOIN `category` ON `article`.`category_id` = `category`.`id`
WHERE  IS NULL
ERROR - 2016-01-28 10:54:12 --> Query error: Unknown column '%E1%9E%A2%E1%9E%B6%E1%9E%98%E1%9F%81%E1%9E%9A%E1%9E%B7%E1%9E%80%E2%80%8B%E1%9E%94%E1%9F%92%E1%9E%8F%E1%9F%81%E1%9E%87%E1%9F%92%E1%9E%89%E1%9E%B6%E2%80%8B%E1%9E%96%E1%9E%84%E1%9F%92%E1%9E%9A%E1' in 'where clause' - Invalid query: SELECT `article`.*, `article_type`.`caption` as `artcaption`, `category`.`caption` as `catcaption`
FROM `article`
LEFT JOIN `article_type` ON `article`.`article_type_id` = `article_type`.`id`
LEFT JOIN `category` ON `article`.`category_id` = `category`.`id`
WHERE `%E1%9E%A2%E1%9E%B6%E1%9E%98%E1%9F%81%E1%9E%9A%E1%9E%B7%E1%9E%80%E2%80%8B%E1%9E%94%E1%9F%92%E1%9E%8F%E1%9F%81%E1%9E%87%E1%9F%92%E1%9E%89%E1%9E%B6%E2%80%8B%E1%9E%96%E1%9E%84%E1%9F%92%E1%9E%9A%E1%9E%B9%E1%9E%84%E2%80%8B%E1%9E%91%E1%9F%86%E1%9E%93%E1%9E%B6%E1%9E%80%E1%9F%8B%E2%80%8B%E1%9E%91%E1%9F%86%E1%9E%93%E1%9E%84%E2%80%8B%E1%9E%96%E1%9E%B6%E1%9E%8E%E1%9E%B7%E1%9E%87%E1%9F%92%E1%9E%87%E1%9E%80%E1%9E%98%E1%9F%92%E1%9E%98_%E1%9E%9C%E1%9E%B7%E1%9E%93%E1%9E%B7%E1%9E%99%E1%9F%84%E1%9E%82%E2%80%8B%E1%9E%87%E1%9E%B6%E1%9E%98%E1%9E%BD%E1%9E%99%E2%80%8B%E1%9E%80%E1%9E%98%E1%9F%92%E1%9E%96%E1%9E%BB%E1%9E%87%E1%9E%B6_1` IS NULL
ERROR - 2016-01-28 10:55:05 --> Query error: Unknown column '%E1%9E%A2%E1%9E%B6%E1%9E%98%E1%9F%81%E1%9E%9A%E1%9E%B7%E1%9E%80%E2%80%8B%E1%9E%94%E1%9F%92%E1%9E%8F%E1%9F%81%E1%9E%87%E1%9F%92%E1%9E%89%E1%9E%B6%E2%80%8B%E1%9E%96%E1%9E%84%E1%9F%92%E1%9E%9A%E1' in 'where clause' - Invalid query: SELECT `article`.*, `article_type`.`caption` as `artcaption`, `category`.`caption` as `catcaption`
FROM `article`
LEFT JOIN `article_type` ON `article`.`article_type_id` = `article_type`.`id`
LEFT JOIN `category` ON `article`.`category_id` = `category`.`id`
WHERE `%E1%9E%A2%E1%9E%B6%E1%9E%98%E1%9F%81%E1%9E%9A%E1%9E%B7%E1%9E%80%E2%80%8B%E1%9E%94%E1%9F%92%E1%9E%8F%E1%9F%81%E1%9E%87%E1%9F%92%E1%9E%89%E1%9E%B6%E2%80%8B%E1%9E%96%E1%9E%84%E1%9F%92%E1%9E%9A%E1%9E%B9%E1%9E%84%E2%80%8B%E1%9E%91%E1%9F%86%E1%9E%93%E1%9E%B6%E1%9E%80%E1%9F%8B%E2%80%8B%E1%9E%91%E1%9F%86%E1%9E%93%E1%9E%84%E2%80%8B%E1%9E%96%E1%9E%B6%E1%9E%8E%E1%9E%B7%E1%9E%87%E1%9F%92%E1%9E%87%E1%9E%80%E1%9E%98%E1%9F%92%E1%9E%98_%E1%9E%9C%E1%9E%B7%E1%9E%93%E1%9E%B7%E1%9E%99%E1%9F%84%E1%9E%82%E2%80%8B%E1%9E%87%E1%9E%B6%E1%9E%98%E1%9E%BD%E1%9E%99%E2%80%8B%E1%9E%80%E1%9E%98%E1%9F%92%E1%9E%96%E1%9E%BB%E1%9E%87%E1%9E%B6_1` IS NULL
ERROR - 2016-01-28 10:55:47 --> Query error: Unknown column '%E1%9E%A2%E1%9E%B6%E1%9E%98%E1%9F%81%E1%9E%9A%E1%9E%B7%E1%9E%80%E2%80%8B%E1%9E%94%E1%9F%92%E1%9E%8F%E1%9F%81%E1%9E%87%E1%9F%92%E1%9E%89%E1%9E%B6%E2%80%8B%E1%9E%96%E1%9E%84%E1%9F%92%E1%9E%9A%E1' in 'where clause' - Invalid query: SELECT `article`.*, `article_type`.`caption` as `artcaption`, `category`.`caption` as `catcaption`
FROM `article`
LEFT JOIN `article_type` ON `article`.`article_type_id` = `article_type`.`id`
LEFT JOIN `category` ON `article`.`category_id` = `category`.`id`
WHERE `%E1%9E%A2%E1%9E%B6%E1%9E%98%E1%9F%81%E1%9E%9A%E1%9E%B7%E1%9E%80%E2%80%8B%E1%9E%94%E1%9F%92%E1%9E%8F%E1%9F%81%E1%9E%87%E1%9F%92%E1%9E%89%E1%9E%B6%E2%80%8B%E1%9E%96%E1%9E%84%E1%9F%92%E1%9E%9A%E1%9E%B9%E1%9E%84%E2%80%8B%E1%9E%91%E1%9F%86%E1%9E%93%E1%9E%B6%E1%9E%80%E1%9F%8B%E2%80%8B%E1%9E%91%E1%9F%86%E1%9E%93%E1%9E%84%E2%80%8B%E1%9E%96%E1%9E%B6%E1%9E%8E%E1%9E%B7%E1%9E%87%E1%9F%92%E1%9E%87%E1%9E%80%E1%9E%98%E1%9F%92%E1%9E%98_%E1%9E%9C%E1%9E%B7%E1%9E%93%E1%9E%B7%E1%9E%99%E1%9F%84%E1%9E%82%E2%80%8B%E1%9E%87%E1%9E%B6%E1%9E%98%E1%9E%BD%E1%9E%99%E2%80%8B%E1%9E%80%E1%9E%98%E1%9F%92%E1%9E%96%E1%9E%BB%E1%9E%87%E1%9E%B6_2586` IS NULL
ERROR - 2016-01-28 10:56:43 --> Severity: Notice --> Undefined variable: details C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 60
ERROR - 2016-01-28 10:56:43 --> Severity: Notice --> Undefined variable: article_medias C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 10:56:43 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 10:58:03 --> Severity: Notice --> Undefined variable: details C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 60
ERROR - 2016-01-28 10:58:03 --> Severity: Notice --> Undefined variable: article_medias C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 10:58:03 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 10:58:28 --> Severity: Notice --> Undefined variable: details C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 60
ERROR - 2016-01-28 10:58:28 --> Severity: Notice --> Undefined variable: article_medias C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 10:58:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 11:00:40 --> Severity: Notice --> Undefined variable: details C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 60
ERROR - 2016-01-28 11:00:40 --> Severity: Notice --> Undefined variable: article_medias C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 11:00:40 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 11:01:19 --> Severity: Warning --> Missing argument 1 for Articles::view() C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\controllers\Articles.php 313
ERROR - 2016-01-28 11:01:19 --> Severity: Notice --> Undefined variable: slug C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\controllers\Articles.php 316
ERROR - 2016-01-28 11:01:19 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'IS NULL' at line 5 - Invalid query: SELECT `article`.*, `article_type`.`caption` as `artcaption`, `category`.`caption` as `catcaption`
FROM `article`
LEFT JOIN `article_type` ON `article`.`article_type_id` = `article_type`.`id`
LEFT JOIN `category` ON `article`.`category_id` = `category`.`id`
WHERE  IS NULL
ERROR - 2016-01-28 11:05:36 --> Severity: Notice --> Undefined variable: details C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 60
ERROR - 2016-01-28 11:05:36 --> Severity: Notice --> Undefined variable: article_medias C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 11:05:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 11:14:22 --> Severity: Notice --> Undefined variable: details C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 60
ERROR - 2016-01-28 11:14:22 --> Severity: Notice --> Undefined variable: article_medias C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 11:14:22 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 11:18:40 --> Severity: Notice --> Undefined variable: details C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 60
ERROR - 2016-01-28 11:18:40 --> Severity: Notice --> Undefined variable: article_medias C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 11:18:40 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 11:21:22 --> Severity: Notice --> Undefined variable: details C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 60
ERROR - 2016-01-28 11:21:22 --> Severity: Notice --> Undefined variable: article_medias C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 11:21:22 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 11:22:05 --> Severity: Notice --> Undefined variable: details C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 60
ERROR - 2016-01-28 11:22:05 --> Severity: Notice --> Undefined variable: article_medias C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 11:22:05 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 13:55:16 --> Severity: Notice --> Undefined variable: details C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 60
ERROR - 2016-01-28 13:55:16 --> Severity: Notice --> Undefined variable: article_medias C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 13:55:16 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 13:55:47 --> Severity: Notice --> Undefined variable: details C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 60
ERROR - 2016-01-28 13:55:47 --> Severity: Notice --> Undefined variable: article_medias C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 13:55:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 13:57:06 --> Query error: Table 'agritoday_v2.article_detail' doesn't exist - Invalid query: SELECT *
FROM `article_detail`
WHERE `article_id` = '1'
ERROR - 2016-01-28 14:06:48 --> Severity: Notice --> Undefined variable: details C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 60
ERROR - 2016-01-28 14:06:48 --> Severity: Notice --> Undefined variable: article_medias C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 14:06:48 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 14:27:45 --> Could not find the language line "index_article_detail_id_th"
ERROR - 2016-01-28 14:32:25 --> Severity: Parsing Error --> syntax error, unexpected 'text' (T_STRING) C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\details.php 49
ERROR - 2016-01-28 14:33:50 --> Severity: Notice --> Undefined variable: details C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 60
ERROR - 2016-01-28 14:33:50 --> Severity: Notice --> Undefined variable: article_medias C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 14:33:50 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 14:34:15 --> Severity: Notice --> Undefined variable: article_medias C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 14:34:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 14:38:41 --> Severity: Notice --> Undefined variable: article_medias C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 14:38:41 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 14:39:14 --> Severity: Notice --> Undefined variable: article_medias C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 14:39:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\agritoday-new.dev\application\modules\articles\views\view.php 91
ERROR - 2016-01-28 15:29:44 --> Severity: Parsing Error --> syntax error, unexpected ''' (T_CONSTANT_ENCAPSED_STRING), expecting ')' C:\xampp\htdocs\agritoday-new.dev\application\modules\categories\models\Category_model.php 32
ERROR - 2016-01-28 15:57:27 --> 404 Page Not Found: /index
ERROR - 2016-01-28 15:57:47 --> 404 Page Not Found: ../modules/library_groups/controllers/Library_groups/index
ERROR - 2016-01-28 22:26:48 --> Severity: Parsing Error --> syntax error, unexpected ';' C:\xampp\htdocs\agritoday-new.dev\application\modules\auth\controllers\Auth.php 106

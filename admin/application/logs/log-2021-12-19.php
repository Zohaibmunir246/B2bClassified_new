<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-12-19 14:20:14 --> Query error: MySQL server has gone away - Invalid query: SELECT SUM(`amount`) AS `amount`
FROM `orders`
WHERE `status` = 'paid'
AND `currency_unit` = 'usd'

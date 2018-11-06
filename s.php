<?php
require_once '/sys/init.php';
require '/Admin/Controller/BaseController.class.php';
require '/Admin/Controller/licainearController.class.php';

$n = new licainearController();
$n->foreach_pay();
?>
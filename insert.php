<?php
header("Content-type:text/html;charset=utf-8");
require('Controller/insertUserController.php');


if(!empty($_POST['insertName'])){
    $insert = new insertUserController();
    $result = $insert->insert($_POST['insertName']);
}
require('View/insertUserView.php');

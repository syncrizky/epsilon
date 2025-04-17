<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

isset($_SESSION) or session_start();
require_once '../app/init.php';


$app = new App;

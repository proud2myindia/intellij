<?php
/**
 * Created by PhpStorm.
 * User: Anandam
 * Date: 4/22/2017
 * Time: 2:53 AM
 */

include ('../config/connect.php');
include ('../classes/subcatagory.php');
$qty = $_GET['qty'];
$price = $_GET['price'];
$tax = $_GET['tax'];

$con = new connect_pdo();
$dbh = $con->getDb();

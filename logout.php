<?php
/**
 * Created by PhpStorm.
 * User: Anandam
 * Date: 4/13/2017
 * Time: 8:02 PM
 */

session_start();
session_destroy();
header('location: index');
<?php

/**
 * Created by PhpStorm.
 * User: Anandam
 * Date: 4/19/2017
 * Time: 1:36 AM
 */
class Configglobal
{
    public $crntdate;
    public $crntdatetime;


    public function __construct()
    {
       $this->crntdate = date('Y-m-d');
       //echo $this->crntdate;
        $this->crntdatetime = date('Y-m-d H:i:s');
    }

}
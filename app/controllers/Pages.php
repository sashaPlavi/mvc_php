<?php

class Pages
{
    public function __construct()
    {
    }
    public function index()
    {
        echo 'default index';
    }

    public function about($param)
    {
        echo $param;
    }
}

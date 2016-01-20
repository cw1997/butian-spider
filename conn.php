<?php
    date_default_timezone_set("Asia/Shanghai");
    // error_reporting(0);
    $link = mysql_connect('127.0.0.1','root','root');
    mysql_query("SET NAMES 'utf8'");
    mysql_select_db('butian-spider', $link);
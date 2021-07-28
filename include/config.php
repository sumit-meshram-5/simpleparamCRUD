<?php

$host='localhost';
$user_name='root';
$db_password='root';
$db_name='simpleparamcrud';

$conn= mysqli_connect($host,$user_name,$db_password,$db_name) or 
                    die('unable to connect<br>'.mysqli_connect_error());


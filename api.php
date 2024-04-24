<?php

session_start();




$info=(object)[];


require_once ("classes/initialisation.php");

$DB = new Database();
$DATA_RAW=file_get_contents("php://input");
$DATA_OBJ = json_decode($DATA_RAW);
$ERROR= "";

if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type =="signup" )
{
    include("includes/signup.php");

} else if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type =="login" )
{
    include("includes/login.php");
}
 else if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type =="logout" )
{
    include("includes/logout.php");
}
 else if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type =="user_info" )
{
   include("includes/user_info.php");
}

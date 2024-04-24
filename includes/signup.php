<?php

$info=(object)[];

$data=false;
$data['userid'] =$DB->generate_id(10);
$data['date'] = date("Y-m-d H:i:s");

// Validation de l'username
$data['username'] =$DATA_OBJ->username;
if (empty($DATA_OBJ->username))
{
    $ERROR .= "* Entrez un username<br>";
} else {
    if (strlen($DATA_OBJ->username) < 3)
    {
        $ERROR .= "* Entrez un username d'au moins 3 caractères<br>";
    }
    if (!preg_match("/^[a-zA-Z0-9_-]+$/", $DATA_OBJ->username))
    {
        $ERROR .= " * Entrez un username valide (lettres, chiffres, tirets et underscores uniquement)<br>";
    }
}

// Validation de l'email
$data['email'] =$DATA_OBJ->email;
if (empty($DATA_OBJ->email))
{
    $ERROR .= "* Entrez un email<br>";
} else {
    if (!filter_var($DATA_OBJ->email, FILTER_VALIDATE_EMAIL))
    {
        $ERROR .= "* Entrez un email valide<br>";
    }
}

// Validation du mot de passe
$data['password'] = password_hash($DATA_OBJ->password, PASSWORD_DEFAULT);
$password = $DATA_OBJ->password2;
if (empty($DATA_OBJ->password))
{
    $ERROR .= "* Entrez un mot de passe<br>";
} else {
    if (strlen($DATA_OBJ->password) < 8)
    {
        $ERROR .= "* Entrez un mot de passe d'au moins 8 caractères<br>";
    }
    if ($DATA_OBJ->password !== $password)
    {
        $ERROR .= "* Les mots de passe ne correspondent pas<br>";
    }
}

if($ERROR == "")
{
    $query = "insert into users (userid,username,email,password,date) values (:userid,:username,:email,:password,:date)";
    $result=$DB->write($query, $data);

    if ($result)
    {
       
       $info->message = 'User created';
       $info->data_type = 'erreur';
       echo json_encode($info);

    } else {
      
       $info->message = 'nopee not created';
       $info->data_type = 'info';
       echo json_encode($info);
    }
} else {
    
    $info->message = $ERROR;
    $info->data_type = 'erreuuur';
    echo json_encode($info);
}
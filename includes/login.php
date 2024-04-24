<?php

$info = (object)[];

if ($DATA_OBJ == null || !isset($DATA_OBJ->email) || !isset($DATA_OBJ->password)) {
    $info->message = 'Invalid request';
    $info->data_type = 'error';
    echo json_encode($info);
    die;
}

$data = false;

$data['email'] = $DATA_OBJ->email;

if (empty($DATA_OBJ->email)) {
    $ERROR = "Entrez un email valide ";
}

if (empty($DATA_OBJ->password)) {
    $ERROR = "Entrez un mot de passe valide ";
}

if ($ERROR == "") {
    $query = "select * from users where email = :email limit 1";
    $result = $DB->read($query, $data);

    if (is_array($result)) {
        $result = $result[0];
        if (password_verify($DATA_OBJ->password, $result->password)) {
            $_SESSION['userid'] = $result->userid;
            $info->message = 'Connectééé';
            $info->data_type = 'info';
            echo json_encode($info);
        } else {
            $info->message = 'Mot de passe incorrect';
            $info->data_type = 'erreur';
            echo json_encode($info);
        }
    } else {
        $info->message = 'Email incorrect';
        $info->data_type = 'erreur';
        echo json_encode($info);
    }
} else {
    $info->message = $ERROR;
    $info->data_type = 'erreur';
    echo json_encode($info);
}

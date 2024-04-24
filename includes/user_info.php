<?php

$info = (object)[];

if (!isset($_SESSION['userid'])) {
    $info->message = 'Vous n\'êtes pas connecté';
    $info->data_type = 'error';
    echo json_encode($info);
    die;
}

$data = array(); // Initialiser $data comme un tableau vide

$data['userid'] = $_SESSION['userid'];

$query = "SELECT * FROM users WHERE userid = :userid LIMIT 1";

$result = $DB->read($query, $data);

if ($result === false) {
    // La requête a échoué
    $last_error = error_get_last();
    $info->message = 'Échec de la requête SQL: ' . $last_error['message'];
    $info->data_type = 'error';
    echo json_encode($info);
    die; // Ajouter cette ligne pour arrêter l'exécution du script en cas d'erreur
} else {
    if ($result !== null && is_array($result) && count($result) > 0 && $result[0] !== null) { // Vérifier si $result[0] n'est pas null
        $user_data = $result[0];
        $user_data->data_type = "user_info";
        echo json_encode($user_data);
    } else {
        $info->message = 'Aucune ligne retournée';
        $info->data_type = 'error';
        echo json_encode($info);
    }
}
?>

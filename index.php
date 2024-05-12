<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: X-Requested-With');
header('Content-Type: application/json');

// Controllers
require_once("controller/GeneralController.php");
require_once('model/GeneralModel.php');
// Instances
$model = new GeneralModel();
$controller = new GeneralController($model);
// Needed vars
$method = $_SERVER["REQUEST_METHOD"];
$table =null;
if ( isset( $_GET['table'] ) ){
    $table = $_GET['table'];
} else {
    header('Location: view/login.php');
}


if ($method == "GET" && !empty($table)) {
    $id = $_GET['id'];
    if ($table == "register" && isset($_GET['action'])) {
        $action = $_GET['action'];

        $sql = "select * from $table";

        return $controller->$method($sql);
    } else if ($table == "account" && isset($_GET['action'])) {
        $action = $_GET['action'];

        $sql = "select * from $table";

        return $controller->$method($sql);
    }
    if ($table == 'account') {
        $sql = "select * from $table where username = '$id'";
    } else if ($table == "register") {
        $sql = "select * from $table where idregister = $id";
    }

    return $controller->$method($sql);


}
if ($method == "DELETE") {
    $id = $_GET['id'];

    if ($table == 'account') {
        $sql = "delete from $table where username = '$id'";
    } else if ($table == "register") {
        $sql = "delete from $table where idregister = '$id'";
    }

    $controller->$method($sql);
} else if ($method == "POST") {
    $rawJson = file_get_contents('php://input');
    $array = json_decode($rawJson, true);

    // Verificar si la contraseña está presente en el JSON
    if (isset($array['password_2'])) {
        // Encriptar la contraseña
        $contrasenia_encriptada = password_hash($array['password_2'], PASSWORD_DEFAULT);

        // Reemplazar la contraseña en el array con la contraseña encriptada
        $array['password_2'] = $contrasenia_encriptada;
    }

    //  header('Content-type: application/json;charset=utf-8');
    //    echo json_encode( $array);

    $controller->$method($table, $array);
} else if ($method == "PUT") {
    $id = $_GET['id'];
    $rawJson = file_get_contents('php://input');
    $array = json_decode($rawJson, true);

    // Verificar si la contraseña está presente en el JSON
    if (isset($array['password_2'])) {
        // Encriptar la contraseña
        $contrasenia_encriptada = password_hash($array['password_2'], PASSWORD_DEFAULT);

        // Reemplazar la contraseña en el array con la contraseña encriptada
        $array['password_2'] = $contrasenia_encriptada;
    }
    // header('Content-type: application/json;charset=utf-8');
    //     echo json_encode($array);

    $controller->$method($table, $id, $array);
}





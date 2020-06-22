<?php

/**
 * @author Luis Felipe luisflp.garcia@gmail.com>
 */

require_once "../inc/config.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    header("Content-Type: application/json");
    $array_devolver=[];
    $email = strtolower($_POST['email']);

    // comprobar si el user existe 
    $buscar_user = $con->prepare("SELECT * FROM usuarios WHERE email = '$email' LIMIT 1");
    $buscar_user->bindParam(':email', $email, PDO::PARAM_STR);
    $buscar_user->execute();

    if($buscar_user->rowCount() == 1){
        // Existe
        $array_devolver['error'] = "Este mail ya existe";
        $array_devolver['is_login']= false;
    }else{
        $user = ($_POST['user']);

        $password = ($_POST['password']);
        
        $nuevo_user = $con->prepare("INSERT INTO usuarios (user, email, pass) VALUES(:user, :email, :password)");
        $nuevo_user->bindParam(':user', $user, PDO::PARAM_STR);
        $nuevo_user->bindParam(':email', $email, PDO::PARAM_STR);
        $nuevo_user->bindParam(':password', $password, PDO::PARAM_STR);
        $nuevo_user->execute();

        $user_id = $con->lastInsertId();
        $_SESSION['user_id']= (int) $user_id;
        $array_devolver['redirect']= 'http://localhost/programacion-iv/index.php'; 
        $array_devolver['is_login']= true;
    }

    echo json_encode($array_devolver);

}else{
    exit("Fuera de aquí");
}


?>
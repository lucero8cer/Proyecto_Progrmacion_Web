<?php

include_once 'Includes/User.php';
include_once 'Includes/UserSession.php';

$userSesion = new UserSession();
$user = new User();

if(isset($_SESSION['user'])){
    //Hay sesion
    $user->setUser($userSesion->getCurrentUser());
    if($user->getRol() == "Estudiante"){
        include_once 'Interfaces/ResidenciasAlumno.php';
    }else if($user->getRol() == "Profesor"){
        include_once 'Interfaces/ApartadoProfesor.php';
    }    
}else if(isset($_POST['usuario']) && isset($_POST['password'])){
    //validacion de login

    $userForm = $_POST['usuario'];
    $passForm = $_POST['password'];

    if($user->userExist($userForm, $passForm)){
        #usuario validado
        $userSesion->setCurrentUser($userForm);
        $user->setUser($userForm);
        if($user->getRol() == "Estudiante"){
            include_once 'Interfaces/ResidenciasAlumno.php';
        }else if($user->getRol() == "Profesor"){
            include_once 'Interfaces/ApartadoProfesor.php';
        }
    }else{
        echo "nombre de usuario y/o password incorrecto";
    }
}else{
    //login
    include_once 'Interfaces/Login.php';
}

?>
<?php

include_once 'app/models/user.model.php';
include_once 'app/controllers/auth.controller.php';

class UserController {
    private $authController;
    private $menuController;
    private $userModel;

    function __construct(){
        $this->authController = new AuthController();
        $this->menuController = new MenuController();
        $this->userModel  = new UserModel();
    }
    function userExistsByEmail($email){
        // Obtengo el usuario
        $user = $this->userModel->getByEmail($email);
        
        // Si el usuario no existe devuelvo false
        if(!$user){
            return false;
        }

        return true; //Si existe devuelvo true
    }

    function validateAddUserForm($email, $password, $passwordRepeat, $name, $surname){
        //Valido los datos
        if (empty($email) || empty($password) 
         || empty($name)  || empty($surname) || empty($passwordRepeat)) {
            $this->menuController->showSignup('Debe completar todos los campos.');
            die();
        }

        if($password != $passwordRepeat){
            $this->menuController->showSignup('Las contraseñas deben ser iguales');
            die();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {//Valido el mail
            $this->menuController->showSignup('Email incorrecto');
            die();
        }

        if($this->userExistsByEmail($email)){
            $this->menuController->showSignup('Ya hay un usuario registrado con ese Email.');
            die();
        }  
    }
    function AddUser(){
        if($this->authController->isAuth()){
            $this->authController->redirectHome();
            die();
        }

        // Seteo datos
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordRepeat = $_POST['passwordrepeat'];
        
        // Si hay algun error, hace un die
        $this->validateAddUserForm($email, $password, $passwordRepeat, $name, $surname);
         
        $hashedPassword = password_hash($password , PASSWORD_DEFAULT);

        if($this->userModel->add($email, $hashedPassword, $name, $surname)){
            $this->authController->loginUserByEmail($email);
        }
        else{
            $this->menuController->showSignup('Ocurrió un error en el servidor, intente nuevamente más tarde');
        }
    }

}

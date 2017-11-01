<?php

class UserController extends Controller
{
    /**
     * Profile form view
     * @Secured
     */
    function profileAction(){
        $this->view("user/profile");
    }

    /**
     * Login form view
     */
    function loginAction($_error = ""){
        $error1 = array("name" => "InvalidIdentifiers","message" => "Le nom d'utilisateur et/ou le mot de passe sont invalides.");
        $error2 = array("name" => "MissingIdentifiers","message" => "Vous devez inscrire un nom d'utilisateur et un mot de passe pour vous connecter.");

        $loginError = isset($$_error) ? $$_error : array();
        $this->view("user/login",$loginError);
    }

    /**
     * Validate login information before connection
     */
    function validateLogin(){
        $userRepository = $this->repository("User");
        $username = XPost("username");
        $password = XPost("password");
        if($username && $password) {
            $user = $userRepository->findOneBy(array("username" => $username, "password" => $password));
            if(!empty($user)){
                $_SESSION["user"] = $user;
                header("location:/public");
            }
            else{
                header("location:/public/user/login/error1");
            }
        }
        else{
            header("location:/public/user/login/error2");
        }
    }

    /**
     * @Secured
     */
    function logoutAction(){
        removeXSession("user");
        header("location:/public");
    }

    /**
     * Cart page view
     * @Secured
     */
    function cartAction(){
        $this->view("user/cart");
    }

    /**
     * Adds product to cart
     * (Ajax?)
     * @Secured
     */
    function addToCart(){

    }

    /**
     * Removes product from cart
     * (Ajax?)
     * @Secured
     */
    function removeFromCart(){

    }
}
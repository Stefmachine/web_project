<?php

class UserController extends Controller
{
    /**
     * Profile form view
     * @Secured
     */
    function profileAction(){
        $userId = GlobalHelper::XSession("user");
        if($userId) {
            $rep = new UserRepository();
            $user = $rep->find($userId);
            if($user){
                $this->view("user/profile",array("user" => $user));
            }
            else{
                throw new Exception("Tried accessing page when user is undefined.");
            }
        }
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
        $username = GlobalHelper::XPost("username");
        $password = GlobalHelper::XPost("password");
        if($username && $password) {
            /**
             * @type User $user
             */
            $user = $userRepository->findOneBy(array("username" => $username, "password" => $password));
            if(!empty($user)){
                GlobalHelper::setXSession("user",$user->getId());
                GlobalHelper::redirect();
            }
            else{
                GlobalHelper::redirect("user/login/error1");
            }
        }
        else{
            GlobalHelper::redirect("user/login/error2");
        }
    }

    /**
     * @Secured
     */
    function logoutAction(){
        GlobalHelper::removeXSession("user");
        GlobalHelper::redirect();
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
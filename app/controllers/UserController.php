<?php

class UserController extends Controller
{
    /**
     * Profile form view
     * @Secured
     * @Page(title="Profile d'utilisateur")
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
     * Password recovery page
     *
     * @Page(title="Récupération de mot de passe")
     */
    function passwordRecoveryAction(){
        $this->view("user/passwordRecovery");
    }

    function sendPassword(){
        //todo: Send mail for password recovery
        GlobalHelper::redirect("user/login/mailSent");
    }

    /**
     * Login form view
     *
     * @Page(title="Connexion")
     */
    function loginAction($_error = ""){
        $error1 = array("type" => "error","message" => "Le nom d'utilisateur et/ou le mot de passe sont invalides.");
        $error2 = array("tpe" => "error","message" => "Vous devez inscrire un nom d'utilisateur et un mot de passe pour vous connecter.");
        $mailSent = array("type" => "success","message" => "Un lien pour récupérer votre mot de passe vous parviendra sous peu à l'adresse indiqué.");

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
     * Logout the user
     *
     * @Secured
     * @Page(title="Déconnexion")
     */
    function logoutAction(){
        GlobalHelper::removeXSession("user");
        GlobalHelper::redirect();
    }

    /**
     * Cart page view
     * @Secured
     * @Page(title="Votre panier")
     */
    function cartAction(){
		
		$lib = new ProductRepository();		
		$product = $lib->find(1);
		
		$variable = array(new Order());
		$variable[0]->setId(1);
		$variable[0]->setStatus("Canceled");
		
		$op = new OrderProduct();
		$op->setOrderId($variable[0]->getId());
		$op->setProductId($product);
		$op->setQuantity(1);
		$op->setSize('JUMBO');
		
		$variable[0]->addOrderProduct($op);
		
        $this->view("user/cart", array("order" => $variable, "product" => $product));
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
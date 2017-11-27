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
        $userRep = $this->repository("User");
        $username = GlobalHelper::XPost("username");
        $password = GlobalHelper::XPost("password");
        if($username && $password) {
            /**
             * @type User $user
             */
            $user = $userRep->findOneBy(array("username" => $username, "password" => $password));
            if($user){
                GlobalHelper::setXSession("user",$user->getId());
                $this->manageUserOrders();
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
		$orderRep = new OrderRepository();
		$orderProductRep = new OrderProductRepository();
		$productRep = new ProductRepository();

        /**
         * @type Order[] $orders
         */
		$orders = $orderRep->findBy(array("userId" => GlobalHelper::XSession("user")));

		foreach ($orders as $key => $order){
            /**
             * @type OrderProduct[] $orderLines
             */
            $orderLines = $orderProductRep->findBy(array("orderId" => $order->getId()));
            foreach ($orderLines as $opKey => $line){
                /**
                 * @type Product $product
                 */
                $product = $productRep->find($line->getProductId());
                $orderLines[$opKey]->product = $product;
            }
            $orders[$key]->lines = $orderLines;
        }

        $this->view("user/cart", array("orders" => $orders));
    }

    private function manageUserOrders(){
        $orderRep = new OrderRepository();
        $order = $orderRep->findOneBy(array(
            "userId" => GlobalHelper::XSession("user"),
            "state" => "pending"
        ));

        if(!$order && GlobalHelper::XSession("user")){
            $order = new Order();
            $order->setUserId(GlobalHelper::XSession("user"))
                ->setState("pending");

            $orderRep->persist($order);
        }
    }

    /**
     * Adds product to cart
     * @Secured
     */
    function addToCart(){
        $productId = GlobalHelper::XPost("productId");
        $size = (!empty(GlobalHelper::XPost("size")) ? GlobalHelper::XPost("size") : "regular" );
        $quantity = (!empty(GlobalHelper::XPost("quantity")) ? GlobalHelper::XPost("quantity") : 1 );

        $productRep = new ProductRepository();
        $product = $productRep->find($productId);

        if ($product) {
            $orderRep = new OrderRepository();
            $order = $orderRep->findOneBy(array(
                "userId" => GlobalHelper::XSession("user"),
                "state" => "pending"
            ));
            if ($order) {
                $orderProductRep = new OrderProductRepository();
                $orderLine = new OrderProduct();
                $orderLine->setOrderId($order->getId())
                    ->setProductId($product->getId())
                    ->setQuantity($quantity)
                    ->setSize($size);

                $orderProductRep->persist($orderLine);

                return true;
            }
        }
        return false;
    }

    /**
     * Removes product from cart
     * @Secured
     */
    function removeFromCart(){

    }
}
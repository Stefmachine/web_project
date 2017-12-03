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
        $error2 = array("type" => "error","message" => "Vous devez inscrire un nom d'utilisateur et un mot de passe pour vous connecter.");
        $mailSent = array("type" => "success","message" => "Un lien pour récupérer votre mot de passe vous parviendra sous peu à l'adresse indiqué.");

        $loginError = isset($$_error) ? $$_error : array();
        $this->view("user/login", $loginError);
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
                if(GlobalHelper::XPost("save-session")){
                    GlobalHelper::setXCookie("connected",$user->getId(),array());
                }
                $this->manageUserOrders();
                $redirect = GlobalHelper::XSession("loginRedirect");
                GlobalHelper::removeXSession("loginRedirect");
                GlobalHelper::redirect($redirect);
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
        GlobalHelper::removeXCookie("connected");
        GlobalHelper::redirect();
    }

    /**
     * Cart page view
     * @Secured
     * @Page(title="Votre panier")
     */
    function cartAction($_completed = false){
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

        switch ($_completed){
            case "success":
                $message = "L'opération s'est complété avec succès.";
                break;
            case "warning":
                $message = "Impossible de compléter la commande.";
                break;
            default:
                $message = "Une erreur s'est produite.";
                $_completed = (!empty($_completed) ? "danger" : "");
                break;
        }

        $this->view("user/cart", array("orders" => $orders, "completed" => $_completed, "message"=>$message));
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

        if(!in_array($size,array("regular", "small","kid"))){
            return false;
        }

        if( $quantity < 1 || $quantity > 20){
            return false;
        }

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
                    ->setSize($size)
                    ->setCost($this->calculateCost($product->getCost(),$size,$quantity));

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
        $productId = GlobalHelper::XPost("productId");

        $orderRep = new OrderRepository();
        $order = $orderRep->findOneBy(array(
            "userId" => GlobalHelper::XSession("user"),
            "state" => "pending"
        ));
        if ($order) {
            $orderProductRep = new OrderProductRepository();
            $orderLine = $orderProductRep->findOneBy(array(
                "orderId" => $order->getId(),
                "productId" => $productId
            ));
            $orderProductRep->remove($orderLine);

            return true;
        }

        return false;
    }

    /**
     * @return float
     * @throws Exception
     */
    public function calculateCost($_baseCost = null, $_size = null, $_quantity = null){
        $kid = 0.75;
        $small = 1;
        $regular = 1.5;

        if(empty($_baseCost) && empty($_size) && empty($_quantity)) {
            $productId = GlobalHelper::XPost("productId");
            $_size = (!empty(GlobalHelper::XPost("size")) ? GlobalHelper::XPost("size") : "regular");
            $_quantity = (!empty(GlobalHelper::XPost("quantity")) ? GlobalHelper::XPost("quantity") : 1);

            $productRep = new ProductRepository();
            $product = $productRep->find($productId);

            $_baseCost = $product->getCost();
        }

        if(!isset($$_size)){
            throw new Exception("Size type '$_size' does not exist.");
        }

        return $_baseCost * $$_size * $_quantity;
    }

    /**
     * @param string $_username
     * @return bool
     */
    public function checkUserName(){
        $_username = GlobalHelper::XPost("username");

        $userRep = new UserRepository();
        $user = $userRep->findOneBy(array("username" => $_username));

        return boolval($user);
    }

    public function completeOrder(){
        $status = "warning";
        $orderRep = new OrderRepository();
        /**
         * @type Order $order
         */
        $order = $orderRep->findOneBy(array(
            "userId" => GlobalHelper::XSession("user"),
            "state" => "pending"
        ));

        if($order){
            $orderProductRep = new OrderProductRepository();
            $orderLines = $orderProductRep->findBy(array(
                "orderId" => $order->getId()
            ));
            if(count($orderLines) > 0) {
                $order->setCompletedTime(time());
                $order->setState("completed");
                $orderRep->persist($order);
                $status = "success";
            }
        }

        $this->manageUserOrders();

        GlobalHelper::redirect("user/cart/$status");
    }
}
<?php

class ShopController extends Controller
{
    /**
     * Product list view
     *
     * @Page(title="Catalogue")
     *
     * @param int $_page
     * @param string $_tag
     */
    function indexAction($_page = 1,$_tag = ""){
        $rep = new ProductRepository();
		
        $limit = 9;
        $offset = ($_page - 1) * $limit;
        $productCount = $rep->countAllByTag($_tag);
        $pageCount = (int)ceil($productCount/$limit);

        $products = $rep->findAllByTag($limit,$offset,$_tag);

        $onOrder = array();
        if(GlobalHelper::XSession("user")){
            $orderRep = new OrderRepository();
            $orderProductRep = new OrderProductRepository();
            /**
             * @type Order[] $orders
             */
            $orders = $orderRep->executeStoreProc("findCurrentOrder",array("userId" => GlobalHelper::XSession("user")));

            foreach ($orders as $key => $order){
                /**
                 * @type OrderProduct[] $orderLines
                 */
                $orderLines = $orderProductRep->findBy(array("orderId" => $order->getId()));
                foreach ($orderLines as $opKey => $line){
                    $onOrder[] = $line->getProductId();
                }
            }
        }

        $this->view('shop/index',array("products" => $products,"pagesCount" => $pageCount,"tag" => $_tag, "index" => $_page, "onOrder" => $onOrder));
    }

    /**
     * Single product view
     *
     * @Page(title="Produit")
     *
     * @param int $_id
     */
    function productAction($_id){
        if(empty($_id)){
            GlobalHelper::redirect("shop/index");
        }

        $hasProduct = false;
        if(GlobalHelper::XSession("user")){
            $orderRep = new OrderRepository();
            $orderProductRep = new OrderProductRepository();
            /**
             * @type Order[] $orders
             */
            $orders = $orderRep->executeStoreProc("findCurrentOrder",array("userId" => GlobalHelper::XSession("user")));

            foreach ($orders as $key => $order){
                $hasProduct = boolval($orderProductRep->findBy(array("orderId" => $order->getId(),"productId" => $_id)));
            }
        }

        $rep = new ProductRepository();
        $product = $rep->find($_id);

        if(!$product){
            throw new Exception("Le produit recherché n'existe pas");
        }

        $this->view("shop/product",array("product"=>$product,"inOrder" => $hasProduct));
    }
}
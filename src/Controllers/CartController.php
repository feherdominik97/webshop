<?php
namespace App\Controllers;

use App\Controller;
use App\Helpers\Json;
use App\Models\Cart;
use App\Helpers\Constants;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
*
*/
class CartController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $_SESSION[Constants::$CART_KEY] = $_SESSION[Constants::$CART_KEY] ?? (Json::get(Constants::$CART_KEY)[0] ?? new Cart([]));
        $discounts = Json::get(Constants::$DISCOUNT_KEY) ?? [];

        foreach ($_SESSION[Constants::$CART_KEY]->getProducts() as $product) {
            $product->calculateNewPrice($discounts);
        }
    }

    public function getCart() {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($_SESSION[Constants::$CART_KEY]);
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function index()
    {
        $this->render('cart', ['cart' => $_SESSION[Constants::$CART_KEY]]);
    }

    public function store()
    {
        $products = Json::get(Constants::$PRODUCT_KEY);
        $discounts = Json::get(Constants::$DISCOUNT_KEY);

        foreach ($products as $product) {
            if($product->getId() == $_POST['id']) {
                $product->calculateNewPrice($discounts);
                $_SESSION[Constants::$CART_KEY]->addProduct($product);
            }
        }


        Json::put(Constants::$CART_KEY, $_SESSION[Constants::$CART_KEY]);
    }

    public function destroy()
    {
        $_SESSION[Constants::$CART_KEY]->removeProduct($_POST['key']);

        Json::put(Constants::$CART_KEY, $_SESSION[Constants::$CART_KEY]);
    }
}
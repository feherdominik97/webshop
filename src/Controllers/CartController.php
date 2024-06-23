<?php
namespace App\Controllers;

use App\Controller;
use App\Helpers\Json;
use App\Models\Cart;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
*
*/
class CartController extends Controller
{
    public $cart;
    public function __construct()
    {
        parent::__construct();
        $this->cart = Json::get('Cart')[0] ?? new Cart([]);
        $discounts = Json::get('Discount') ?? [];

        foreach ($this->cart->getProducts() as $product) {
            foreach ($discounts as $discount) {
                $product->calculateNewPrice($discount);
            }
        }
    }

    public function getCart() {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($this->cart);
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function index()
    {
        echo $this->render('cart', ['cart' => $this->cart]);
    }

    public function store()
    {
        $products = Json::get('Product');
        foreach ($products as $product) {
            if($product->getId() == $_POST['id']) {
                $this->cart[] = $product;
            }
        }

        Json::put('Cart', $this->cart);
    }

    public function destroy()
    {
        $products = Json::get('Product');
        foreach ($products as $product) {
            if($product->getId() === $_POST['id']) {
                $this->cart[] = $product;
            }
        }

        Json::put('Cart', $this->cart);
    }
}
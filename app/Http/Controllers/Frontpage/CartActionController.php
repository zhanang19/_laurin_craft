<?php

namespace App\Http\Controllers\Frontpage;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartActionController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->ajax()) {
            if ($request->method() === 'POST') {
                $this->processCart($request->post('action'), $request->post('items'));
            }

            return response()->json($this->fetchCartProduct());
        }

        return view('front.cart');
    }

    /**
     * @param string $action
     * @param array $items
     */
    private function processCart($action, $items)
    {
        $action = mb_strtolower($action);
        if ($action === 'add') {
            // $items only contain 1 item
            if (isset($items['id'], $items['qty'])) {
                $carts = $this->getCartSession()->push([
                    'id' => $items['id'],
                    'qty' => $items['qty'],
                ]);
            }
        } elseif ($action === 'update') {
            $carts = collect();
            foreach ($items as $item) {
                if (isset($item['id'], $item['qty'])) {
                    $carts->push($item);
                }
            }
        }
        Session::put('carts', $carts);

        $this->adjustCartProduct();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function fetchCartProduct()
    {
        $this->adjustCartProduct();

        return $this->getCartSession()
            ->transform(function ($item) {
                if (!is_null($product = Product::find($item['id']))) {
                    // Unset item, then append product detail
                    $qty = $item['qty'];
                    unset($item);
                    $item = [];
                    $item['id'] = $product->id;
                    $item['slug'] = $product->slug;
                    $item['name'] = $product->name;
                    $item['link'] = route('frontpage.product.detail', $product);
                    $item['price'] = $product->general_price;
                    $item['qty'] = (int)$qty;
                    $item['image_link'] = $product->image_link;
                }

                return $item;
            })
            ->values();
    }

    private function adjustCartProduct()
    {
        // Reject unidentified product
        $carts = $this->getCartSession()->reject(function ($item) {
            return is_null(Product::find($item['id']));
        });

        // Update cart only to identified product
        Session::put('carts', $carts->values());
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function getCartSession()
    {
        return Session::get('carts', collect());
    }
}

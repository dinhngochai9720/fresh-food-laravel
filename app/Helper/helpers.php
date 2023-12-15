<?php

use Illuminate\Support\Facades\Session;

// set sidebar item active
function setActive(array $routes)
{
    if (is_array($routes)) {
        foreach ($routes as $key => $route) {
            if (request()->routeIs($route)) {
                return 'active';
            }
        }
    }
}

// check if product have discount
function checkDiscountProduct($product)
{
    $current_date = date('Y-m-d');

    if ($product->offer_price > 0 && $current_date >= $product->offer_start_date  && $current_date <= $product->offer_end_date) {
        return true;
    } else {
        return false;
    }
}


// calculate percent discount of product
function calculatePercentDiscountProduct($price, $offer_price)
{
    $amount_discount = $price - $offer_price;
    $percent_discount = ($amount_discount / $price) * 100;
    $percent_round_discount = round($percent_discount, 0);
    return $percent_round_discount;
}


// check date sale
function checkDateSale($flash_sale)
{
    $current_date = date('Y-m-d');

    if ($flash_sale->end_date > $current_date) {
        return true;
    } else {
        return false;
    }
}

// get total cart price
function getTotalCartPrice()
{
    $total_cart_price = 0;

    foreach (Cart::content() as $key => $product) {
        $total_cart_price += ($product->price + $product->options->variant_total_price) * $product->qty;
    }

    return $total_cart_price;
}

// get cart discount
function getCartDiscount()
{
    if (Session::has('voucher')) {
        $voucher = Session::get('voucher');
        $total_cart_price = getTotalCartPrice();

        // discount is amount
        if ($voucher['voucher_type'] == 'amount') {
            return  $voucher['voucher_discount'];
        }
        // discount is percent
        elseif ($voucher['voucher_type'] == 'percent') {
            $discount = $voucher['voucher_discount'] / 100 * $total_cart_price;
            return $discount;
        }
    } else {
        return 0;
    }
}

// get final total cart price
function getFinalTotalCartPrice()
{
    if (Session::has('voucher')) {
        $voucher = Session::get('voucher');
        $total_cart_price = getTotalCartPrice();

        // discount is amount
        if ($voucher['voucher_type'] == 'amount') {
            $final_total_cart_price = $total_cart_price - $voucher['voucher_discount'];
            return  $final_total_cart_price;
        }
        // discount is percent
        elseif ($voucher['voucher_type'] == 'percent') {
            $discount = $voucher['voucher_discount'] / 100 * $total_cart_price;
            $final_total_cart_price = $total_cart_price - $discount;
            return  $final_total_cart_price;
        }
    } else {
        return  getTotalCartPrice();
    }
}

// get shipping fee from Session
function getShippingFee()
{
    if (Session::has('shipping')) {
        return Session::get('shipping')['cost'];
    } else {
        return 0;
    }
}

// get net final total cart price
function getNetFinalToTalCartPrice()
{
    // net_final_to_tal_cart_price = total_cart_price - discount + shipping_fee
    return getFinalTotalCartPrice() + getShippingFee();
}


// limit text
function limitText($text, $limit)
{
    return \Str::limit($text, $limit);
}

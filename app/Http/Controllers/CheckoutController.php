<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function success(Request $request)
    {
        $downloads = session('downloads', []);

        return view('shop.checkout', [
            'downloads' => $downloads,
        ]);
    }
}

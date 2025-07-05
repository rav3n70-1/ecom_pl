<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // <-- Import the Product model

/**
 * HomeController
 *
 * This controller is responsible for handling the main pages of the website,
 * such as the homepage.
 */
class HomeController extends Controller
{
    /**
     * Display the homepage and a list of products.
     *
     * This method fetches all products from the database and passes them
     * to the 'home' view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all products from the database
        $products = Product::all();

        // Pass the products to the view
        // The 'home' view corresponds to the 'home.blade.php' file
        return view('home', ['products' => $products]);
    }
}

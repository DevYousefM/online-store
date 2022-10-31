<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StripePaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
// Admin Routes
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', "check"])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.home');
    })->name('dashboard');
    // Making All Notification As Read
    Route::get('/read/{type}', function ($type) {
        DB::table("notifications")->where('type', $type)
            ->orWhere('type', 'like', '%' . $type . '%')->delete();
        return back();
    })->name('read');

    // Catagories Routes
    Route::get("/catagory", [AdminController::class, "catagory"]);
    Route::post("/add_catagory", [AdminController::class, "add_catagory"]);
    Route::get("/delete_catagory/{id}", [AdminController::class, "delete_catagory"])->name("delete_catagory");

    // Products Routes
    Route::get("/product", [AdminController::class, "getCatagories"]);
    Route::get("/storeProduct", [AdminController::class, "storeProduct"])->name("storeProduct");
    Route::get("/products", [AdminController::class, "all_products"])->name("all_products");
    Route::get("/product_page/{id}", [AdminController::class, "product_page"])->name("product_page");
    Route::get("/update_product/{id}", [AdminController::class, "update_product"])->name("update_product");
    Route::get("/del_product/{id}", [AdminController::class, "del_product"])->name("del_product");

    // Orders Routes
    Route::get("/orders/{type}", [AdminController::class, "orders"])->name("orders");
    Route::get("/update_order", [AdminController::class, "update_order"])->name("update_order");

    Route::post("/search_admin", [AdminController::class, "search_admin"])->name("search_admin");
});
// User Routes
Route::get("/redirect", [HomeController::class, "redirect"]);
Route::get("/", [HomeController::class, "index"])->name("homepage");
Route::get("/products_page", [HomeController::class, "products_page"])->name("products_page");
Route::get("/_catagory/{catagory_name}", [HomeController::class, "custom_catagory"])->name("_catagory");
Route::get("/single_product/{id}", [HomeController::class, "single_product"])->name("single_product");

Route::post("/search", [HomeController::class, "search"])->name("search");

// User Orders
Route::get("/us_orders", [HomeController::class, "us_orders"])->name("home.orders");

// Cart Routes
Route::get("/cart", [HomeController::class, "cart"])->middleware("auth")->name("cart");
Route::get("/add_to_cart", [HomeController::class, "add_to_cart"])->name("add_to_cart");
Route::get("/update_qtn", [HomeController::class, "update_qtn"])->name("update_qtn");
Route::get("/del_from_cart/{id}", [HomeController::class, "del_from_cart"])->name("del_from_cart");
Route::get("/checkout_delivery", [HomeController::class, "checkout_delivery"])->middleware("auth")->name("checkout_delivery");
Route::get("/checkout_card/{total}", [HomeController::class, "checkout_card"])->middleware("auth")->name("checkout_card");
Route::get("/create_order", [HomeController::class, "create_order"])->name("create_order");
Route::controller(StripePaymentController::class)->group(function () {
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});

// Contact
Route::get("/contact", [HomeController::class, "contact"])->name("contact");
Route::get("/send_mail", [HomeController::class, "send_mail"])->name("send_mail");

// Route::get("/session", function () {
//     // $value = session()->get("cart");
//     session()->put("newcart", []);
//     $value = session()->all();
//     return $value;
// });

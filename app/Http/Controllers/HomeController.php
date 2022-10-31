<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use App\Models\Cart;
use App\Models\Catagory;
use App\Models\Message;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Notifications\Message as NotificationsMessage;
use App\Notifications\Order as NotificationsOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class HomeController extends Controller
{
    public function index()
    {

        $cams =  Product::all()->where("catagory", "Camera")->take(3);
        $laptops =  Product::all()->where("catagory", "Laptop")->take(3);
        $phones =  Product::all()->where("catagory", "Phones")->take(3);
        return view(
            "home.userpage",
            [
                "phones" => $phones,
                "cams" => $cams,
                "laptops" => $laptops
            ]
        );
    }
    public function custom_catagory($catagory_name)
    {
        if ($catagory_name == "all") {
            $products = Product::paginate(9);
        } else {
            $products = Product::where("catagory", $catagory_name)->paginate(9);
        }
        $catas =  Catagory::all();
        return view(
            "home.products_page",
            [
                "products" => $products,
                "catas" => $catas
            ]
        );
    }
    public function products_page()
    {
        $products = Product::paginate(9);
        $catas =  Catagory::all();
        return view(
            "home.products_page",
            [
                "products" => $products,
                "catas" => $catas
            ]

        );
    }
    public function search(Request $request)
    {
        $result = Product::where('title', $request->search)
            ->orWhere('title', 'like', '%' . $request->search . '%')->get();
        return view("home.search", ["products" => $result]);
    }
    public function single_product($id)
    {
        $product = Product::all()->where("id", $id);
        return view("home.single_product", ["product" => $product]);
    }
    public function redirect()
    {
        $user_type = Auth::user()->user_type;
        if ($user_type == '1') {
            return redirect()->route("dashboard");
        } else {
            return redirect()->route("homepage");
        }
    }
    // Cart Functions
    public function cart()
    {
        $in_cart = Cart::all()->where("user_id", Auth::user()->id);
        return view("home.cart", ["in_cart" => $in_cart]);
    }

    public function add_to_cart(Request $request)
    {
        if (Auth::user()) {
            $cart = Cart::all()->where("user_id", Auth::user()->id);
            $user_cart = $cart->where("product_id", $request->product_id);
            if (count($user_cart) > 0) {
                return redirect()->back()->with("message", "Product already exist to cart");
            } else {
                $user = User::findOrFail(Auth::user()->id);
                $product = Product::findOrFail($request->product_id);
                Cart::create([
                    "name" => $user->name,
                    "email" => $user->email,
                    "phone"  => $user->phone,
                    "address" => $user->address,
                    "product_title" => $product->title,
                    "price" => $product->discount,
                    "quantity" => 1,
                    "image" => $product->image,
                    "product_id" => $product->id,
                    "user_id" => $user->id,
                ]);
                return redirect()->back()->with("message", "Product Added To Cart");
            }
        } else {
            return redirect()->route("login");
        }
    }

    public function update_qtn(Request $request)
    {
        $cart =  Cart::all()->where("user_id", Auth::user()->id);
        $product =  $cart->where("id", $request->cart_id)->first();
        $product->update([
            "quantity" => $request->quantity
        ]);
        return redirect()->back()->with("message", "Quantity updated");
    }
    public function del_from_cart($cart_id)
    {
        $cart =  Cart::all()->where("user_id", Auth::user()->id);
        $product =  $cart->where("id", $cart_id)->first();
        $product->delete();
        return redirect()->back()->with("message", "Product Deleted");
    }
    public function checkout_delivery()
    {
        return view("home.checkout_delivery");
    }
    public function checkout_card($total)
    {
        return view("home.checkout_card", ["total" => $total]);
    }
    public function create_order(Request $request)
    {
        if ($request->payment_method == "On Delivery") {
            $cart_data =  Cart::where("user_id", Auth::user()->id)->get();
            foreach ($cart_data as $item) {
                if (
                    $order =  Order::create([
                        "user_name" => $request->user_name,
                        "email" => $request->email,
                        "phone" => $request->phone,
                        "address" => $request->address,
                        "user_id" => Auth::user()->id,
                        "product_title" => $item->product_title,
                        "quantity" => $item->quantity,
                        "price" => $item->price,
                        "image" => $item->image,
                        "product_id" => $item->product_id,
                        "payment_status" => "cash on delivery",
                        "delivery_status" => "Pending",
                    ])
                ) {
                    $item->delete();
                };
            }
            Mail::to("elcaptain.yousef.official@gmail.com")->send(new OrderShipped("User Name"));

            $admins = User::all()->where("user_type", 1);
            Notification::send($admins, new NotificationsOrder($order->id, $order->created_at, $order->user_name));

            return redirect()->route("cart")->with("message", "We have received your request and will contact you as soon as possible");
        }
    }
    public function us_orders()
    {
        $orders = DB::table("orders")->where("user_id", Auth::user()->id)->orderBy("delivery_status", "desc")->get();
        return view("home.orders", ["orders" => $orders]);
    }
    public function contact()
    {
        return view("home.contact");
    }
    public function send_mail(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);
        $message = Message::create($request->all());

        $admins = User::all()->where("user_type", 1);
        Notification::send($admins, new NotificationsMessage($message->id, $message->name, $message->subject));

        return redirect()->back()
            ->with(['success' => 'Thank you for contact us. we will contact you shortly.']);
    }
}

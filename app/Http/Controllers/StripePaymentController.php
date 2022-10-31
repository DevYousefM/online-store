<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Order as NotificationsOrder;
use App\Mail\OrderShipped;
use Stripe;

class StripePaymentController extends Controller
{

    public function stripe()
    {
        return view('stripe');
    }

    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        if (
            Stripe\Charge::create([
                "amount" => $request->total_price * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment"
            ])
        ) {
            $cart_data =  Cart::where("user_id", Auth::user()->id)->get();
            foreach ($cart_data as $item) {
                if (
                    $order = Order::create([
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
                        "payment_status" => "Paid",
                        "delivery_status" => "Pending",
                    ])
                ) {
                    Mail::to("elcaptain.yousef.official@gmail.com")->send(new OrderShipped($order->user_name));

                    $admins = User::all()->where("user_type", 1);
                    Notification::send($admins, new NotificationsOrder($order->id, $order->created_at, $order->user_name));


                    $item->delete();
                };
            }
            return redirect()->route("cart")->with("message", "We have received your request and will contact you as soon as possible");
        } else {
            return back();
        }
    }
}

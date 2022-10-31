<?php

namespace App\Http\Controllers;

use App\Models\Catagory;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // Catagories Functions
    public function catagory()
    {
        $catagories  = Catagory::all();
        return view("admin.catagory", ["catagories" => $catagories]);
    }
    public function add_catagory(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        Catagory::create([
            "catagory_name" => $request->name
        ]);
        return redirect()->back()->with('message', 'Catagory Added Successfully');
    }
    public function delete_catagory($id)
    {
        Catagory::where("id", $id)->delete();
        return redirect()->back()->with('message', 'Catagory Deleted Successfully');
    }
    // Products Functions
    public function getCatagories()
    {
        return view("admin.product", ["catagories" => Catagory::all()]);
    }
    public function storeProduct(Request $request)
    {

        $request->validate([
            'product_title' => 'required|string',
            'product_desc' => 'required|string',
            'product_qtn' => 'required|integer',
            'product_price' => 'required|integer',
            'product_discount' => 'required|integer',
            'product_catagory' => 'required',
            'product_image' => 'required',
        ]);
        $path = $request->file('product_image')->store('products_imgs', "public");
        Product::create([
            "title" => $request->product_title,
            "description" => $request->product_desc,
            "image" => $path,
            "catagory" => $request->product_catagory,
            "quantity" => $request->product_qtn,
            "price" => $request->product_price,
            "discount" => $request->product_discount,
        ]);
        return redirect()->back()->with('message', 'Product Added Successfully');
    }
    public function all_products()
    {
        return view("admin.all_products", ["catagories" => Catagory::all(), "products" => Product::all()]);
    }
    public function search_admin(Request $request)
    {
        $result = Product::where('title', $request->search)
            ->orWhere('title', 'like', '%' . $request->search . '%')->get();

        return view("admin.search", ["catagories" => Catagory::all(), "products" => $result]);
    }
    public function product_page($id)
    {
        $product  = Product::findOrFail($id);
        $catagories =  Catagory::all();
        return view("admin.product_page", ["catagories" => $catagories, "product" => $product]);
    }
    public function update_product(Request $request, $id)
    {

        $request->validate([
            'product_title' => 'required|string',
            'product_desc' => 'required|string',
            'product_qtn' => 'required|integer',
            'product_price' => 'required|integer',
            'product_discount' => 'required|integer',
        ]);
        Product::where("id", $id)->update([
            "title" => $request->product_title,
            "description" => $request->product_desc,
            "quantity" => $request->product_qtn,
            "price" => $request->product_price,
            "discount" => $request->product_discount,
        ]);
        return redirect()->back()->with('message', 'Product Added Successfully');
    }
    public function del_product($id)
    {
        Product::where("id", $id)->delete();
        return redirect()->route("all_products")->with('message', 'Product Deleted Successfully');
    }
    // Orders
    public function orders($type)
    {
        if ($type == "new") {
            return view("admin.orders", ["orders" => Order::all()->where("delivery_status", "Pending")]);
        } else if ($type == "review") {
            return view("admin.orders", ["orders" => Order::all()->where("delivery_status", "Proccess")]);
        } else if ($type == "complete") {
            return view("admin.orders", ["orders" => Order::all()->where("delivery_status", "Completed")]);
        } else {
            abort(404);
        }
    }
    public function update_order(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->update([
            "delivery_status" => $request->order_status,
        ]);
        return back();
    }
};

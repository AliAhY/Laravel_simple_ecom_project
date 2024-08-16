<?php

namespace App\Http\Controllers;

use App\Models\OrderNotification;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function addProduct(string $id)
    {

        $user = Auth::user();
        $product = Products::findOrFail($id);

        Orders::create([
            'user_id' => $user->id,
            'product_id' => $id,
            'status' => 'Waiting'
        ]);

        // تسجيل الرسالة في قاعدة البيانات  
        OrderNotification::create([
            'user_id' => Auth::user()->id,
            'message' => "{$user->name} قام بطلب المنتج {$product->title}"
        ]);

        return back()->with('success', 'The product has been successfully ordered.');
    }


    public function allorders()
    {


        $orders = Orders::with('user', 'product')->get();
        $notifications = OrderNotification::all(); // أو يمكنك استخدام أي شروط حسب الحاجة  
        // return view('admin.dashboard', compact('notifications'));
        return view('admin.orders.index', compact('orders', 'notifications'));
    }


    public function DeleteOrder(string $id)
    {
        $order = Orders::findOrFail($id);
        $order->delete();
        return back()->with('danger', 'The Order has deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Order;
use App\OrderProduct;
use App\Partner;
use App\Vendor;
use Illuminate\Http\Request;
use MailSender;
use Redirect;

class OrderController extends Controller
{
    public function index()
    {
        $overdueList = OrderProduct::overdueList()->paginate(50);
        $nowList = OrderProduct::nowList()->get();
        $newList = OrderProduct::newList()->paginate(50);
        $completeList = OrderProduct::completeList()->paginate(50);
        return view('order.index', [
            'overdueList' => $overdueList,
            'nowList' => $nowList,
            'newList' => $newList,
            'completeList' => $completeList,
        ]);
    }

    public function edit($id)
    {
        $model = OrderProduct::where(['id' => $id])->first();
        if (empty($model)) throw new CustomException('Заказ не найден.', 404);
        $selectPartner = Partner::all();
        return view('order.edit', [
            'model' => $model,
            'selectPartner' => $selectPartner,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'partner_id' => 'required|integer',
            'status' => 'required|integer',
        ]);
        $update = ['status' => $request->status, 'partner_id' => $request->partner_id];
        $model = OrderProduct::where(['id' => $id])->first();
        if (empty($model)) throw new CustomException('Заказ не найден.', 404);
        $oldStatus = $model->order->status;
        Vendor::where('id', $model->product->vendor->id)->update(['email' => $request->email]);
        Order::where('id', $model->order->id)->update($update);
        if ($request->status == Order::STATUS_COMPLETE && $oldStatus != Order::STATUS_COMPLETE) {
            MailSender::add($model->order->partner->email, $model->id);
            MailSender::add($model->order->client_email, $model->id);
        }
        return Redirect::to('order')->with('success','Заказ успешно обновлен.');
    }
}

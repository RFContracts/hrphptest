<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderProduct;
use App\Partner;
use App\Vendor;
use Illuminate\Http\Request;
use Mail;
use Redirect;

class OrderController extends Controller
{
    public function index()
    {
        $overdues = OrderProduct::overdueList()->paginate(50);
        $nows = OrderProduct::nowList()->get();
        $news = OrderProduct::newList()->paginate(50);
        $completes = OrderProduct::completeList()->paginate(50);
        return view('order.index', [
            'overdues' => $overdues,
            'nows' => $nows,
            'news' => $news,
            'completes' => $completes,
        ]);
    }

    public function edit($id)
    {
        $model = OrderProduct::where(['id' => $id])->first();
        $select_partner = Partner::all();
        return view('order.edit', [
            'model' => $model,
            'select_partner' => $select_partner,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required',
            'partner_id' => 'required',
            'status' => 'required',
        ]);
        $update = ['status' => $request->status, 'partner_id' => $request->partner_id];
        $model = OrderProduct::where(['id' => $id])->first();
        Vendor::where('id', $model->product->vendor->id)->update(['email' => $request->email]);
        Order::where('id', $model->order->id)->update($update);
        if ($request->status == Order::STATUS_COMPLETE) {
            $this->sendEmail($model);
        }
        return Redirect::to('order')->with('success','Заказ успешно обновлен.');
    }

    public function sendEmail($model)
    {
        try {
            Mail::send(['text' => 'mail'], [
                'id' => $model->order->id,
                'product' => $model->product,
            ], function ($message) use ($model) {
                $message->from(env('MAIL_USERNAME'), 'Отправка письма');
                $message->to($model->order->partner->email, 'Заказ завершен')->subject('Заказ завершен');
            });
        } catch (\Exception $e) {
            return Redirect::to('order')->with('error','Письма не отправлены: ' . $e->getMessage());
        }
    }
}

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center">Изменить заказ</h2>
        <form action="/order/{{$model->id}}" method="POST" name="edit_order">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Email клиента</strong>
                        <input type="text" name="email" class="form-control" placeholder="Введите Email" value="{{ $model->product->vendor->email }}">
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Партнер</strong>
                        <select class="form-control" name="partner_id">
                            @foreach($select_partner as $partner)
                                <option value="{{ $partner->id }}" {{ $model->order->partner->id == $partner->id ? 'selected="selected"' : '' }}>{{ $partner->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('partner_id') }}</span>
                    </div>
                </div>
                <div class="col-md-12">
                    <strong>Продукты</strong>
                    <p>{{$model->product->name}} - {{$model->quantity}} шт.</p>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Статус заказа</strong>
                        <select class="form-control" name="status">
                            @foreach(\App\Order::$statusList as $key => $status)
                                <option value="{{$key}}" {{ $model->order->status == $key ? 'selected="selected"' : '' }}>{{$status}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('status') }}</span>
                    </div>
                </div>
                <div class="col-md-12">
                    <strong>Стоимость заказа</strong>
                    <p>{{$model->price}} ₽</p>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success">Сохранить</button>
                </div>
            </div>
        </form>
    </div>
@endsection
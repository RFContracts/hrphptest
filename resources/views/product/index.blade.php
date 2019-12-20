<?php
/** @var \App\Product[] $model * */
?>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Заказы
            </div>
            <div class="panel-body">
                @if (count($model) > 0)
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Наименование продукта</th>
                                <th scope="col">Наименование поставщика</th>
                                <th scope="col">Цена</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $item)
                                <tr>
                                    <th scope="row">{{$item->id}}</th>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->vendor->name}}</td>
                                    <td class="ajax-price">
                                        <input type="hidden" name="price" class="form-control" placeholder="Введите стоимость" value="{{$item->price}}" disabled>
                                        <span class="price-value price-{{$item->id}}">{{$item->price}} ₽</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                <div align="center">
                    {{$model->links()}}
                </div>
                @else
                    <tr>
                        <td colspan="4">Продуктов не найдено.</td>
                    </tr>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
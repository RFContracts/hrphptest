@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Заказы
                </div>
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#overdue">Просроченные</a></li>
                        <li><a data-toggle="tab" href="#now">Текущие</a></li>
                        <li><a data-toggle="tab" href="#new">Новые</a></li>
                        <li><a data-toggle="tab" href="#approve">Выполненные</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="overdue" class="tab-pane fade in active">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">ID Заказа</th>
                                    <th scope="col">Партнер</th>
                                    <th scope="col">Стоимость заказа</th>
                                    <th scope="col">Состав заказа</th>
                                    <th scope="col">Статус заказа</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($overdues) > 0)
                                    @foreach ($overdues as $overdue)
                                        <tr>
                                            <th scope="row"><a href="order/{{$overdue->id}}/edit">{{$overdue->id}}</a>
                                            </th>
                                            <td>{{$overdue->order->partner->name}}</td>
                                            <td>{{$overdue->price}} ₽</td>
                                            <td>{{$overdue->product->name}}</td>
                                            <td>{{$overdue->order->getStatusName()}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">Заказов не найдено.</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div id="now" class="tab-pane fade">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">ID Заказа</th>
                                    <th scope="col">Партнер</th>
                                    <th scope="col">Стоимость заказа</th>
                                    <th scope="col">Состав заказа</th>
                                    <th scope="col">Статус заказа</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($nows) > 0)
                                    @foreach ($nows as $now)
                                        <tr>
                                            <th scope="row"><a href="order/{{$now->id}}/edit">{{$now->id}}</a>
                                            </th>
                                            <td>{{$now->order->partner->name}}</td>
                                            <td>{{$now->price}} ₽</td>
                                            <td>{{$now->product->name}}</td>
                                            <td>{{$now->order->getStatusName()}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">Заказов не найдено.</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div id="new" class="tab-pane fade">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">ID Заказа</th>
                                    <th scope="col">Партнер</th>
                                    <th scope="col">Стоимость заказа</th>
                                    <th scope="col">Состав заказа</th>
                                    <th scope="col">Статус заказа</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($news) > 0)
                                    @foreach ($news as $new)
                                        <tr>
                                            <th scope="row"><a href="order/{{$new->id}}/edit">{{$new->id}}</a>
                                            </th>
                                            <td>{{$new->order->partner->name}}</td>
                                            <td>{{$new->price}} ₽</td>
                                            <td>{{$new->product->name}}</td>
                                            <td>{{$new->order->getStatusName()}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">Заказов не найдено.</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div id="approve" class="tab-pane fade">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">ID Заказа</th>
                                    <th scope="col">Партнер</th>
                                    <th scope="col">Стоимость заказа</th>
                                    <th scope="col">Состав заказа</th>
                                    <th scope="col">Статус заказа</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($completes) > 0)
                                    @foreach ($completes as $complete)
                                        <tr>
                                            <th scope="row"><a href="order/{{$complete->id}}/edit">{{$complete->id}}</a>
                                            </th>
                                            <td>{{$complete->order->partner->name}}</td>
                                            <td>{{$complete->price}} ₽</td>
                                            <td>{{$complete->product->name}}</td>
                                            <td>{{$complete->order->getStatusName()}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">Заказов не найдено.</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
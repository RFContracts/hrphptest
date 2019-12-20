<?php
/** @var \App\OrderProduct[] $list * */
?>
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
    @if (count($list) > 0)
        @foreach ($list as $item)
            <tr>
                <th scope="row"><a href="/order/{{$item->id}}/edit">{{$item->id}}</a></th>
                <td>{{$item->order->partner->name}}</td>
                <td>{{$item->price}} ₽</td>
                <td>{{$item->product->name}}</td>
                <td>{{$item->order->getStatusName()}}</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="5">Заказов не найдено.</td>
        </tr>
    @endif
    </tbody>
</table>
Заказ №{{$id}} завершен.
Состав заказа:
@foreach($product as $item)
    {{$item['name']}}, {{$item['price']}}₽.
@endforeach
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
                            {!! view('order.table', ['list' => $overdueList]); !!}
                        </div>
                        <div id="now" class="tab-pane fade">
                            {!! view('order.table', ['list' => $nowList]); !!}
                        </div>
                        <div id="new" class="tab-pane fade">
                            {!! view('order.table', ['list' => $newList]); !!}
                        </div>
                        <div id="approve" class="tab-pane fade">
                            {!! view('order.table', ['list' => $completeList]); !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
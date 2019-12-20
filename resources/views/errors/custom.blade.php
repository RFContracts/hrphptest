@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <h1>
                {{ $exception->getMessage() ? $exception->getMessage() : 'Что-то пошло не так.' }}
            </h1>
        </div>
    </div>
@endsection
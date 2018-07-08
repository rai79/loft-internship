@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="mb-2">Заявки:</div>
        <table class="table table-bordered">
            <tr>
                <td>NN</td>
                <td>Тема запроса</td>
                <td>Текст запроса</td>
                <td>Имя клиента</td>
                <td>Почта клиента</td>
                <td>Дата и время запроса</td>
                <td>Отметить обработанные заявки</td>
            </tr>
            @if (isset($requests_processing))
                @foreach ($requests_processing as $request)
                    <tr>
                        <td>{{$request->id}}</td>
                        <td>{{$request->theme}}</td>
                        <td>{{$request->massage}}</td>
                        <td>{{$request->user->name}}</td>
                        <td>{{$request->user->email}}</td>
                        <td>{{$request->created_at}}</td>
                        <td>
                            <a href="{{route('manager.update', ['request_id' => $request->id])}}" class="btn btn-primary">Запрос обработан</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7" class="text-center">Нет заявок на обработку</td>
                </tr>
            @endif
        </table>
    </div>
    <div class="row justify-content-center">
        <div class="mb-2">Обработанные заявки:</div>
        <table class="table table-bordered">
            <tr>
                <td>NN</td>
                <td>Тема запроса</td>
                <td>Текст запроса</td>
                <td>Имя клиента</td>
                <td>Почта клиента</td>
                <td>Дата и время запроса</td>
            </tr>
            @if (isset($requests_processed))
                @foreach ($requests_processed as $request)
                    <tr>
                        <td>{{$request->id}}</td>
                        <td>{{$request->theme}}</td>
                        <td>{{$request->massage}}</td>
                        <td>{{$request->user->name}}</td>
                        <td>{{$request->user->email}}</td>
                        <td>{{$request->created_at}}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" class="text-center">Нет обработанных заявок</td>
                </tr>
            @endif
        </table>
    </div>
</div>
@endsection

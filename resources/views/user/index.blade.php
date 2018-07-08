@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Создайте свою заявку в службу поддержки</div>
                <div class="card-body">

                    <div class="form-group text-center">
                        <p class="mb-0">Пользователь может создать только одну заявку в сутки!</p>
                        @if(isset($time_left))
                            <p class="mb-0">Осталось {{intdiv($time_left,60)}}ч. {{$time_left%60}}мин. до следующей заявки.</p>
                            <p class="mb-0">Обновите страницу и попробуйте позже.</p>
                        @endif
                    </div>

                    <form method="POST" action="{{ route('user.add') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="theme" class="col-sm-4 col-form-label text-md-right">Тема сообщения:</label>

                            <div class="col-md-6">
                                <input id="theme" type="theme" class="form-control{{ $errors->has('theme') ? ' is-invalid' : '' }}" name="theme" value="{{ old('theme') }}" required autofocus>

                                @if ($errors->has('theme'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('theme') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="massage" class="col-md-4 col-form-label text-md-right">Сообщение заявки:</label>

                            <div class="col-md-6">
                                <input id="massage" type="massage" class="form-control{{ $errors->has('massage') ? ' is-invalid' : '' }}" name="massage" required>

                                @if ($errors->has('massage'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('massage') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                @if(isset($time_left))
                                    <button type="submit" class="btn btn-primary" disabled>
                                        Отправить заявку
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-primary">
                                        Отправить заявку
                                    </button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

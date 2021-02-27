@extends('layouts.app')

@section('title', 'Edit Knowledge')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    @isset($knowledge)
        <form action="{{route("knowledge.update")}}" method="post">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <input type="hidden" name="id" value="{{$knowledge->id}}">
            <div class="mb-3">
                <label for="text-keyword" class="form-label">Ключевое слово</label>
                <input type="text" name="keyword" value="{{$knowledge->keyword}}" class="form-control" id="text-keyword"
                       aria-describedby="text-keyword-description">
                <div id="text-keyword-description" class="form-text">Введите ключевое слово</div>
            </div>
            <div class="mb-3">
                <label for="text-answer" class="form-label">Ответ на ключевое слово</label>
                <input type="text" name="answer" value="{{$knowledge->answer}}" class="form-control" id="text-answer"
                       aria-describedby="text-answer-description">
                <div id="text-answer-description" class="form-text">Введите ответ на ключевое слово</div>
            </div>
            <button type="submit" class="btn btn-primary">Обновить</button>
        </form>
    @else
        <p>Данные не найдены!</p>
    @endisset
@endsection

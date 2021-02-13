@extends('layouts.app')

@section('title', 'Create Knowledge')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <form action="{{route("knowledge.create")}}" method="post">
        {{csrf_field()}}
        <div class="mb-3">
            <label for="text-keyword" class="form-label">Ключевое слово</label>
            <input type="text" name="keyword" class="form-control" id="text-keyword" aria-describedby="text-keyword-description">
            <div id="text-keyword-description" class="form-text">Введите ключевое слово</div>
        </div>
        <div class="mb-3">
            <label for="text-answer" class="form-label">Ответ на ключевое слово</label>
            <input type="text" name="answer" class="form-control" id="text-answer" aria-describedby="text-answer-description">
            <div id="text-answer-description" class="form-text">Введите ответ на ключевое слово</div>
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
@endsection

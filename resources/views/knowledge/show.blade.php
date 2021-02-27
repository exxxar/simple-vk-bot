@extends('layouts.app')

@section('title', 'Show Knowledge')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    @isset($knowledge)
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered">
                <thead>
                <th>
                    Ключ
                </th>
                <th>
                    Значение
                </th>
                </thead>
                <tbody>
                <tr>
                    <td>Клечевое слово</td>
                    <td>{{$knowledge->keyword}}</td>
                </tr>
                <tr>
                    <td>Ответ пользователю</td>
                    <td>{{$knowledge->answer}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    @else
        <p>Данные не найдены!</p>
    @endisset

@endsection

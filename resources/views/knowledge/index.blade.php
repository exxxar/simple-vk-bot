@extends('layouts.app')

@section('title', 'Index Knowledge')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">keyword</th>
                    <th scope="col">answer</th>
                    <th scope="col">action</th>
                </tr>

                </thead>
                <tbody>

                @foreach($knowledges as $kn)
                    <tr scope="row">
                        <td>{{$kn->id}}</td>
                        <td>{{$kn->keyword}}</td>
                        <td>{{$kn->answer}}</td>
                        <td>
                            <button class="btn btn-info">Редактировать</button>
                            <button class="btn btn-success">Посмотреть</button>
                            <button class="btn btn-danger">Удалить</button>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection

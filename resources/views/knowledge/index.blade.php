@extends('layouts.app')

@section('title', 'Index Knowledge')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @if(\Session::has('message'))
                <p>{{ \Session::get('message')}}</p>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="{{route("knowledge.create.page")}}"
               target="_blank"
               class="btn btn-outline-success">Добавить новое выражение</a>
        </div>
    </div>
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
                            <a href="{{route("knowledge.edit", $kn->id)}}" target="_blank" class="btn btn-info">Редактировать</a>
                            <a href="{{route("knowledge.show", $kn->id)}}" target="_blank" class="btn btn-success">Посмотреть</a>
                            <form action="{{route("knowledge.delete",$kn->id)}}" method="POST">
                                {{method_field('DELETE')}}
                                {{csrf_field()}}
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </form>

                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection

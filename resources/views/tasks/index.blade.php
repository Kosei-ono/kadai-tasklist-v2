@extends('layouts.app')

@section('content')

<h1>タスク一覧</h1>

 @if (count($tasks) > 0)
        <table class="table table-striped">
            <head>
                <tr>
                    <th>id</th>
                    <th>ステータス</th>
                    <th>タスク</th>
                    <th>user_id</th>
                </tr>
            </head>
            <body>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{!! link_to_route('tasks.show', $task->id, ['id' => $task->id]) !!}</td>
                        <td>{{ $task->status }}</td>
                        <td>{{ $task->content }}</td>
                        <td>{{ $task->user_id }}</td>
                    </tr>
                @endforeach
            </body>
        </table>
    @endif
    {!! link_to_route('tasks.create', '新規タスクの投稿', null, ['class' => 'btn btn-primary']) !!}
    
@endsection
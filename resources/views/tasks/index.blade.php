@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->
 @if (count($tasks) > 0)
        <ul>
 @foreach ($tasks as $task)
                <li>{!! link_to_route('tasks.show', $task->id, ['id' => $task->id]) !!} : {{ $task->content }}</li>
            {!! link_to_route('tasks.create', '新規タスクの投稿') !!}
@endforeach
        </ul>
    @endif


@endsection
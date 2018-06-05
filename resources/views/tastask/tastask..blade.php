<ul class="media-list">
@foreach ($tastasks as $tastask)
    <?php $user = $tastask->user; ?>
    <li class="media">
        <div class="media-left">
            <img class="media-object img-rounded" src="{{ Gravatar::src($user->email, 50) }}" alt="">
        </div>
        <div class="media-body">
            <div>
                {!! link_to_route('users.show', $user->name, ['id' => $user->id]) !!} <span class="text-muted">posted at {{ $tastask->created_at }}</span>
            </div>
            <div>
                <p>{!! nl2br(e($tastask->content)) !!}</p>
            </div>
            <div>
                @if (Auth::user()->id == $tastask->user_id)
                    {!! Form::open(['route' => ['tastasks.destroy', $tastask->id], 'method' => 'delete']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                    {!! Form::close() !!}
                @endif
            </div>
        </div>
    </li>
@endforeach
</ul>
{!! $tastasks->render() !!}
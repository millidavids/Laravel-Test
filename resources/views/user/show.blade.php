@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$user->name}}</div>

                    <div class="panel-body">
                        <dl>
                            <dt>ID</dt>
                            <dd>{{$user->id}}</dd>
                            <dt>Head</dt>
                            <dd>
                                @if ($user->head)
                                    {{ Form::open(array('route' => array('user.head.destroy', $user->id, $user->head->id), 'method' => 'delete')) }}
                                        <button type="submit" >Decapitate</button>
                                    {{ Form::close() }}
                                @else
                                    <a href={{'/user/'.$user->id.'/head/create'}}>
                                        You don't have a head. Create one?
                                    </a>
                                @endif
                            </dd>
                            <dt>Images</dt>
                            <dd>
                                <div class="h4">Create An Image</div>
                                {{ Form::open(array('url' => 'user/'.$user->id.'/image', 'method' => 'POST', 'files' => true)) }}
                                    <div class="control-group">
                                        <div class="controls">
                                            {{ Form::file('image') }}
                                        </div>
                                    </div>
                                    {{ Form::submit('Submit', array('class'=>'send-btn')) }}
                                {{ Form::close() }}
                            </dd>
                            <dt><a href={{ '/user/'.$user->id.'/email' }}>Send Test Email</a></dt>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
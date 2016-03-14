@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create A Head</div>
                    <div class="panel-body">
                        {{ Form::open(array('url' => url('/user/'.$user->id.'/head'), 'method' => 'POST')) }}
                            {{ Form::submit('Submit', array('class'=>'send-btn')) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

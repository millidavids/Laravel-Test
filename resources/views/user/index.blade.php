@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Users</div>

                    <div class="panel-body">
                        @foreach($users as $user)
                            <a href="{{ "/user/".$user->id }}">{{ $user->name }}</a>
                        @endforeach

                        {!! $users->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
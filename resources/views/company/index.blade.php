@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Companies</div>

                    <div class="panel-body">
                        @foreach($companies as $company)
                            <a href="{{ "/company/".$company->id }}">{{ $company->name }}</a>
                        @endforeach
                    </div>

                    <a href="/company/create">Create a new company.</a>
                </div>
            </div>
        </div>
    </div>
@endsection
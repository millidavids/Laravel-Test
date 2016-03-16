@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$company->name}}</div>

                    <div class="panel-body">
                        <h3>{{ $company->url }}</h3>
                        <a href="{{ '/company/'.$company->id.'/edit' }}">Edit</a>
                        {{ Form::open(array('route' => array('company.destroy', $company->id), 'method' => 'delete')) }}
                            <button type="submit" >Delete Company</button>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
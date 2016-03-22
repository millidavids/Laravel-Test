@extends('SimpleGui::layouts.package')

@section('content')
    {!! millidavids\SimpleGui\ViewRenderer::table([[1,2,3],[4,5,6],[7,8,9]], ['color' => 'red']) !!}
    <hr>
    <br>
    {!! millidavids\SimpleGui\ViewRenderer::dropdown([], []) !!}
    <hr>
    <br>
    {{--{!! millidavids\SimpleGui\ViewRenderer::link() !!}--}}
    {{--<hr>--}}
    {{--<br>--}}
    {{--{!! millidavids\SimpleGui\ViewRenderer::textfield() !!}--}}
    {{--<hr>--}}
    {{--<br>--}}
    {{--{!! millidavids\SimpleGui\ViewRenderer::label() !!}--}}
@endsection
@extends('layouts.master')

@section('title', 'Page Title')

@section('sidebar')
    @parent
    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <p>This is my body content.</p>
    <p>hello , {{ PHP_VERSION }}</p>
    <h1>Laravel</h1>
	Hello, @{{ name }}.
	@if (isset($name))
	name is set
	@else
	name not exist
	@endif

	@foreach($name as $k=> $v)
		{{$k}}----{{$v}}
	@endforeach

@endsection






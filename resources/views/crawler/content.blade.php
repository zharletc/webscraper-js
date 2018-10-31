@extends('layout.master')

@section('title','Web Crawler 1.0')

@section('content')
	@foreach ($Contents as $Content)
		<li><a href="/content/{{ $Content->ID }}">{{ $Content->TITLE}}</a></li>
	@endforeach
	<br><br>
	<a href="/content/history/trash/">Show History Delete</a>
@stop
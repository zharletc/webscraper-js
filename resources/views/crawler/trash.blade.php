@extends('layout.master')

@section('title','Web Crawler 1.0')

@section('content')
	@foreach ($Trash as $result)
		<li><a href="#">{{ $result->TITLE }}</a></li>
	@endforeach
@stop
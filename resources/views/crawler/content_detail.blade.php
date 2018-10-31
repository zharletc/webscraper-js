@extends('layout.master')

@section('title','Web Crawler 1.0')

@section('content')
	<h3>Title : {{ $Contents->TITLE }}</h3>
	<h3>Content : {{ $Contents->CONTENT }}</h3>
	<h3>Link : <a href="{{ $Contents->LINK }}">{{ $Contents->LINK }}</a></h3>
@stop
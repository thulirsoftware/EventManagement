@extends('layouts.admin')

@section('content')



@if(Auth::user()->job_title=='Admin')
@endif
@endsection
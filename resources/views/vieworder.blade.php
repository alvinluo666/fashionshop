@extends('layouts.master')

@section('content')
    <ViewOrder json_orders="{{json_encode($orders)}}"></ViewOrder>
@endsection
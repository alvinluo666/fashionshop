@extends('layouts.master')

@section('content')
    <SearchResult products="{{json_encode($products)}}"></SearchResult>
    {{$products->appends($_GET)->links("pagination::bootstrap-4")}}
    <div style="height:40px"></div>
    <Foot></Foot>
    <CopyRight></CopyRight>
@endsection
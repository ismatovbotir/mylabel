@extends('layouts.app')
@section('sider')
@endsection
@section('contentHeader')
@endsection
             
@section('content')
    <table class="table">
        <thead class="thead-light">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Date</th>
            <th scope="col">Company</th>
            <th>Bill</th>
            <th scope="col">qty</th>
          </tr>
        </thead>
        <tbody>
          @foreach($report as $idx=>$row)
            <tr>
            <th scope="row">{{$idx+1}}</th>
            <td>{{$row->created_at}}</td>
            <td>{{$row->order->company->name}}</td>
            <td>{{$row->order->bill}}</td>
            <td>{{$row->qty}}</td>
          </tr>
          @endforeach
          
        </tbody>
      </table>
      @endsection

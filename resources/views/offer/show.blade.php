@extends('layouts.app')



@section('content')


<div class="container-fluid">
    <div class="nk-content-inner">
        <livewire:offer.create :id="$id" />
    </div>
</div>


@endsection
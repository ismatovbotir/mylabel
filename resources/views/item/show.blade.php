@extends('layouts.app')

@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="components-preview ">
                        
                                <div class="nk-block-head nk-block-head-lg text-right pb-3">
                                    <a href="{{route('admin.item.index')}}" class="btn btn-danger btn-lg"><span class="ni ni-home "></span></a>
                                </div><!-- .nk-block-head -->
                          
                        <livewire:item.show :id="$id" />


                    </div><!-- .components-preview -->
                </div>
            </div>
        </div>
    </div>
@endsection

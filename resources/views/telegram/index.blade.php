@extends('layouts.app')


@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-block-head nk-block-head-sm z-10">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">

                        </div><!-- .nk-block-head-content -->
                       
                    </div><!-- .nk-block-between -->
                    
                </div><!-- .nk-block-head -->

                <livewire:telegram.index />
            </div>
        </div>
    </div>
@endsection

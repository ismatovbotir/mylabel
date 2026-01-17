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
                    {{--<div class="nk-block-between col-md-12 bg-success">
                        <div id="accordion" class="accordion col-md-12 m-0">
                            <div class="accordion-item ">
                                <a href="#" class="accordion-head collapsed" data-toggle="collapse"
                                    data-target="#accordion-item-1">
                                    <h6 class="title">New Order:</h6>
                                    <span class="accordion-icon"></span>
                                </a>
                                <div class="accordion-body collapse" id="accordion-item-1" data-parent="#accordion">
                                    <livewire:order.create />
                                </div>
                            </div>

                        </div>
                    </div>--}}
                </div><!-- .nk-block-head -->

                <livewire:order.index />
            </div>
        </div>
    </div>
@endsection

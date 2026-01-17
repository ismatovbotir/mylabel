@extends('layouts.app')

@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="components-preview ">
                        <div class="nk-block-head nk-block-head-lg text-right pb-3">
                            <a href="{{ route('admin.order.index') }}" class="btn btn-danger btn-lg"><span
                                    class="ni ni-home "></span></a>
                        </div><!-- .nk-block-head -->
                        <div class="nk-block nk-block-lg pt-3">

                            <div class="card card-preview">
                                <div class="card-inner">
                                    <div class="preview-block">

                                        <div id="accordion" class="accordion">
                                            <div class="accordion-item">
                                                <a href="#" class="accordion-head collapsed" data-toggle="collapse"
                                                    data-target="#accordion-item-1" aria-expanded="false">
                                                    <h6 class="title">Order Header</h6>
                                                    <span class="accordion-icon"></span>
                                                </a>
                                                <div class="accordion-body collapse " id="accordion-item-1"
                                                    data-parent="#accordion" style="">
                                                    <div class="accordion-inner">
                                                        <livewire:order.head :id="$id" />
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div><!-- .card-preview -->

                        </div><!-- .nk-block -->

                        <div class="nk-block nk-block-lg pt-3">

                            <div class="card card-preview">
                                <div class="card-inner">
                                    <div class="preview-block">

                                        <div id="accordion" class="accordion">
                                            <div class="accordion-item">
                                                <a href="#" class="accordion-head collapsed" data-toggle="collapse"
                                                    data-target="#accordion-item-2" aria-expanded="false">
                                                    <h6 class="title">Comment</h6>
                                                    <span class="accordion-icon"></span>
                                                </a>
                                                <div class="accordion-body collapse " id="accordion-item-2"
                                                    data-parent="#accordion" style="">
                                                    <div class="accordion-inner">
                                                       <livewire:order.comment :id="$id" />
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div><!-- .card-preview -->

                        </div><!-- .nk-block -->

                        <div class="nk-block nk-block-lg pt-3">

                            <div class="card card-preview">
                                <div class="card-inner">
                                    <div class="preview-block">

                                        <livewire:order.items :id="$id" />

                                    </div>
                                </div>
                            </div><!-- .card-preview -->

                        </div><!-- .nk-block -->



                    </div><!-- .components-preview -->
                </div>
            </div>
        </div>
    </div>
@endsection

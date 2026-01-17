@extends('layouts.app')
@section('title', 'Company')
@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="components-preview ">
                        <div class="nk-block-head nk-block-head-lg text-right pb-3">
                            @if($company->stir)
                            <a href="{{route('admin.report.company',['stir'=>$company->stir])}}" class="btn btn-info btn-lg" target="_blank">
                                <span class="ni ni-reports"></span>
                            </a>
                            @endif
                            <a href="{{ route('admin.company.index') }}" class="btn btn-danger btn-lg">
                                <span class="ni ni-home "></span>
                            </a>
                        </div><!-- .nk-block-head -->
                        <div class="nk-block nk-block-lg">
                            <div class="card card-preview">
                                <div class="card-inner">
                                    <div class="preview-block">
                                        <div id="accordion" class="accordion">
                                            <div class="accordion-item">
                                                <a href="#" class="accordion-head justify-around collapsed"
                                                    data-toggle="collapse" data-target="#accordion-item-1"
                                                    aria-expanded="false">
                                                    <h6 class="title">{{ $company->name }} : </h6>
                                                    @if($company->stir)
                                                        <livewire:company.balance stir="{{ $company->stir }}" />
                                                    @endif
                                                    <span class="accordion-icon"></span>
                                                </a>
                                                <div class="accordion-body collapse" id="accordion-item-1"
                                                    data-parent="#accordion" style="">
                                                    <livewire:company.show :company="$company" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .card-preview -->
                        </div><!-- .nk-block -->
                        <livewire:company.docs :id="$company->id" />
                    </div><!-- .components-preview -->
                </div>
            </div>
        </div>
    </div>
@endsection

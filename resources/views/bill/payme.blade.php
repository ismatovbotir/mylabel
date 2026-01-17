@extends('layouts.app')

@section('sider')
@endsection
@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content col-md-12 pl-0">
                                <div class="nk-block nk-block-lg">
                
                                    <div class="card card-preview">
                                        <div class="card-inner">
                                            
                                             <livewire:bill.payme :id="$bill->id" />  
                
                                           
                
                                        </div>
                                    </div><!-- .card-preview -->
                
                                </div><!-- .nk-block -->
                            </div><!-- .nk-block-head-content -->
                
                        </div><!-- .nk-block-between -->
                
                    </div><!-- .nk-block-head -->
                
                
                
                
                </div>
                
               
            </div>
        </div>
    </div>
@endsection
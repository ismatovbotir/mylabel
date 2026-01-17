@extends('layouts.app')

@section('content')
    <div class="nk-content-body">
        <div class="components-preview wide-md mx-auto">
            <div class="nk-block-head nk-block-head-lg wide-sm">
                <div class="nk-block-head-content">
                    <h2 class="nk-block-title fw-normal">Item Card</h2>
                    <div class="nk-block-des">
                        <p class="lead"></p>
                    </div>
                </div>
            </div><!-- .nk-block-head -->
            <div class="nk-block nk-block-lg">

                <div class="card card-preview">
                    <div class="card-inner">
                        <div class="preview-block">
                            <span class="preview-title-lg overline-title">{{ $item->name }}</span>
                            <div class="row gy-4">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Short name</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" id="default-01"
                                                placeholder="Input placeholder" value="{{ $item->shortName }}"
                                                name="shortname">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-05">Acc Name</label>
                                        <div class="form-control-wrap">

                                            <input type="text" class="form-control" id="default-05"
                                                placeholder="Input placeholder" value="{{ $item->acc_name }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="form-group col-sm-6">

                                            <label class="form-label" for="default-03">Code</label>
                                            <div class="form-control-wrap">

                                                <input type="text" class="form-control" id="default-03"
                                                    placeholder="Input placeholder" value="{{ $item->code }}" disabled>
                                            </div>

                                        </div>
                                        <div class="form-group  col-sm-6">

                                            <label class="form-label" for="default-03">Acc Code</label>
                                            <div class="form-control-wrap">

                                                <input type="text" class="form-control" id="default-03"
                                                    placeholder="Input placeholder" value="{{ $item->acc_code }}" disabled>
                                            </div>

                                        </div>
                                    </div>


                                </div>

                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="form-group col-sm-8">

                                            <label class="form-label" for="default-03">MXIK</label>
                                            <div class="form-control-wrap">

                                                <input type="text" class="form-control" id="default-03"
                                                    placeholder="Input placeholder" value="{{ $item->mxik}}" disabled>
                                            </div>

                                        </div>
                                        <div class="form-group  col-sm-4">

                                            <label class="form-label" for="default-03">P.code</label>
                                            <div class="form-control-wrap">

                                                <input type="text" class="form-control" id="default-03"
                                                    placeholder="Input placeholder" value="{{ $item->package_code }}" disabled>
                                            </div>

                                        </div>
                                    </div>


                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-textarea">Description</label>
                                        <div class="form-control-wrap">
                                            <textarea class="form-control no-resize" id="default-textarea">Large text area content</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-06">Photo</label>
                                        <div class="form-control-wrap">
                                            <div class="custom-file">
                                                <input type="file" multiple="" class="custom-file-input"
                                                    id="customFile" disabled>
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="default-06">Gategory</label>
                                        <div class="form-control-wrap ">
                                            <div class="form-control-select">
                                                <select class="form-control" id="default-06">
                                                    @foreach ($categories as $category)
                                                    <option value="{{$category->id}}" {{$category->id==$item->category_id?"selected":""}}>{{$category->name}}</option>
                                                    
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            
                            <hr class="preview-hr">
                            <span class="preview-title-lg overline-title">prices </span>
                            <div class="row gy-4 align-center">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        
                                         
                                        <label class="form-label" for="default-05">Sell</label>
                                        <div class="form-control-wrap">
                                            <div class="form-text-hint">
                                                <span class="overline-title">Usd</span>
                                            </div>
                                            <input type="text" class="form-control" id="default-05" placeholder="Input placeholder" disabled>
                                        </div>
                                    
                                        
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        
                                         
                                        <label class="form-label" for="default-05">Wholesale</label>
                                        <div class="form-control-wrap">
                                            <div class="form-text-hint">
                                                <span class="overline-title">Usd</span>
                                            </div>
                                            <input type="text" class="form-control" id="default-05" placeholder="Input placeholder" disabled>
                                        </div>
                                    
                                        
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                        
                                         
                                            <label class="form-label" for="default-05">Partner</label>
                                            <div class="form-control-wrap">
                                                <div class="form-text-hint">
                                                    <span class="overline-title">Usd</span>
                                                </div>
                                                <input type="text" class="form-control" id="default-05" placeholder="Input placeholder" disabled>
                                            </div>
                                        
                                            
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div><!-- .card-preview -->

            </div><!-- .nk-block -->
           
           
        </div><!-- .components-preview -->
    </div>
@endsection

@extends('layouts.app')


@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-block-head nk-block-head-sm z-10">
                    

                </div><!-- .nk-block-head -->

                <div class="nk-block z-5">
                    <div class="card card-bordered card-stretch">
                        <div class="card-inner-group">
                            <div class="card-inner ">
                              <form action="{{route('admin.task.store')}}" method="POST">
                                @csrf
                               <div class="preview-block">
                                    <span class="preview-title-lg overline-title">New Task</span>
                                    <div class="row gy-4">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Title</label>
                                                <div class="form-control-wrap">
                                                    <input name="title" type="text" class="form-control" id="default-01" placeholder="Title">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Expires At</label>
                                                <div class="form-control-wrap">
                                                    <input name="expires" type="date" class="form-control" id="default-01" placeholder="Title" value={{now()}} min={{now()}}>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                
                                                <label class="form-label" for="default-06">For:</label>
                                                <div class="form-control-wrap ">
                                                    <div class="form-control-select">
                                                        <select class="form-control" id="default-06" name="user">
                                                            <option >select User</option>
                                                            @foreach($data as $user)
                                                               
                                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                                               
                                                            @endforeach
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                            
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                
                                                <label class="form-label" for="default-06">Type</label>
                                                <div class="form-control-wrap ">
                                                    <div class="form-control-select">
                                                        <select class="form-control" id="default-06" name="type">
                                                            <option value="task">Task</option>
                                                            <option value="order">Order</option>
                                                            <option value="order">Offer</option>
                                                            <option value="bill">Bill</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label" for="default-textarea">Textarea</label>
                                                <div class="form-control-wrap">
                                                    <textarea name="task" class="form-control no-resize" id="default-textarea"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                   
                                </div>  
                                <button class="btn btn-info" type="submit">save Task</button>
                            </form>
                               
                            
                            </div><!-- .card-inner -->
                           
                        </div><!-- .card-inner-group -->
                    </div><!-- .card -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
@endsection

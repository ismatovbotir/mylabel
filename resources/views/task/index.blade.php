@extends('layouts.app')


@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-block-head nk-block-head-sm z-10">
                    <div class="nk-block-between">


                        <div class="nk-block-head-content col-md-6 pl-0">
                            <input class="form-control " type="text"  autofocus>
                        </div><!-- .nk-block-head-content -->
            
                        <div class="nk-block-head-content">
                            <a class="btn btn-success" href="{{ route('admin.task.create') }}">New Task</a>
                            </button>
                        </div><!-- .nk-block-head-content -->
            
                    </div><!-- .nk-block-between -->
            

                </div><!-- .nk-block-head -->

                <div class="nk-block z-5">
                    <div class="card card-bordered card-stretch">
                        <div class="card-inner-group">
                            <div class="card-inner p-0">
                                <table class="nk-tb-list nk-tb-ulist">
                                    <thead>
                                        <tr class="nk-tb-item nk-tb-head">

                                            <th class="nk-tb-col tb-col"><span class="sub-text">Title</span></th>
                                           
                                            <th class="nk-tb-col "><span class="sub-text">User</span></th>
                                            <th class="nk-tb-col tb-col-lg"><span class="sub-text">Type</span></th>
                                            <th class="nk-tb-col tb-col text-center"><span class="sub-text">Status</span></th>
                                            <th class="nk-tb-col "><span class="sub-text">Data</span></th>
                                           


                                        </tr><!-- .nk-tb-item -->
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $task)
                                        @php
                                            $diffInDays = now()->diffInDays($task->expires_at, false);
                                           if($diffInDays>6){
                                            $clr="";
                                           }elseif($diffInDays>0){
                                                $clr="table-info";
                                            }else{
                                                $clr="table-danger";

                                            }
                                        @endphp
                                            <tr class="nk-tb-item {{$clr}}" >
                                                <td class="nk-tb-col text-nowrap">
                                                    <a href="{{route('admin.task.show',['task'=>$task->id])}}">
                                                       {{ $task->title }} -- {{$diffInDays}}
                                                    </a>
                                                  


                                                </td>
                                               
                                                <td class="nk-tb-col text-nowrap">
                                                    {{$task->user->name}}
                                                </td>
                                                <td class="nk-tb-col text-wrap">

                                                    {{ $task->type }}
                                                </td>
                                                <td class="nk-tb-col tb-col tb-col-lg">
                                                    {{ $task->status }}
                                                </td>



                                                <td class="nk-tb-col tb-col">
                                                    {{ $task->expires_at }}
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table><!-- .nk-tb-list -->
                            </div><!-- .card-inner -->
                            <div class="card-inner">
                                {{ $data->links() }}
                            </div><!-- .card-inner -->
                        </div><!-- .card-inner-group -->
                    </div><!-- .card -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
@endsection

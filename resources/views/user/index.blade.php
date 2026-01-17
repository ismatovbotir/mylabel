@extends('layouts.app')


@section('content')


    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Users</h3>
                            <div class="nk-block-des text-soft">
                                <p>You have total {{$data->total()}} items.</p>
                            </div>
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                    
                                        <li class="nk-block-tools-opt"><a href="" class="btn btn-primary"><em class="icon ni ni-update"></em><span>Update</span></a></li>
                                    </ul>
                                </div>
                            </div><!-- .toggle-wrap -->
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->

                <div class="nk-block">
                    <div class="card card-bordered card-stretch">
                        <div class="card-inner-group">
                            <div class="card-inner p-0">
                                <table class="nk-tb-list nk-tb-ulist">
                                    <thead>
                                        <tr class="nk-tb-item nk-tb-head">
                                            
                                            <th class="nk-tb-col tb-col-xs"><span class="sub-text">User Photo</span></th>
                                            <th class="nk-tb-col "><span class="sub-text">User Name</span></th>
                                            <th class="nk-tb-col tb-col-lg"><span class="sub-text">User Email</span></th>
                                            
                                            <th class="nk-tb-col nk-tb-col-tools text-right">
                                                Action
                                            </th>
                                        </tr><!-- .nk-tb-item -->
                                    </thead>
                                    <tbody>
                                        @foreach($data as $user)
                                        <tr class="nk-tb-item">
                                            <td class="nk-tb-col">
                                                <div class="user-avatar sq bg-green"><img src="images/items/{{$user->id}}.jpg" alt=""></div>
                                            </td>
                                            <td class="nk-tb-col">
                                                <a href="{{route('admin.user.show',['user'=>$user->id])}}" class="project-title">
                                                
                                                    <div class="project-info">
                                                        <h6 class="title">{{$user->name}}</h6>
                                                    </div>
                                                </a>
                                            </td>
                                            <td class="nk-tb-col tb-col">
                                                <span>{{$user->email}}</span>
                                            </td>
                                        
                                            <td class="nk-tb-col nk-tb-col-tools">
                                                <ul class="nk-tb-actions gx-1">
                                                    <li>
                                                        <div class="drodown">
                                                            <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li><a href={{route('admin.user.show',['user'=>$user->id])}}><em class="icon ni ni-eye"></em><span>View User</span></a></li>
                                                                    <li><a href="#"><em class="icon ni ni-edit"></em><span>Edit Price</span></a></li>
                                                                    <li><a href="#"><em class="icon ni ni-check-round-cut"></em><span>Delete</span></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table><!-- .nk-tb-list -->
                            </div><!-- .card-inner -->
                            <div class="card-inner">
                            {{$data->links()}}
                            </div><!-- .card-inner -->
                        </div><!-- .card-inner-group -->
                    </div><!-- .card -->
                </div><!-- .nk-block -->
            </div>
        </div>
    
</div>


@endsection
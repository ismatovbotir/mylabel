@extends('layouts.app')

@section('content')

 <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">Companies</h3>
                                            <div class="nk-block-des text-soft">
                                                <p>You have total 95 companies.</p>
                                            </div>
                                        </div><!-- .nk-block-head-content -->
                                        <div class="nk-block-head-content">
                                            <div class="toggle-wrap nk-block-tools-toggle">
                                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                                <div class="toggle-expand-content" data-content="pageMenu">
                                                    <ul class="nk-block-tools g-3">
                                                        <li>
                                                            {{--<div class="drodown">
                                                                <a href="#" class="dropdown-toggle btn btn-white btn-dim btn-outline-light" data-toggle="dropdown"><em class="d-none d-sm-inline icon ni ni-filter-alt"></em><span>Filtered By</span><em class="dd-indc icon ni ni-chevron-right"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <ul class="link-list-opt no-bdr">
                                                                        <li><a href="#"><span>Open</span></a></li>
                                                                        <li><a href="#"><span>Closed</span></a></li>
                                                                        <li><a href="#"><span>Onhold</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>--}}
                                                        </li>
                                                        <li class="nk-block-tools-opt">
                                                            <a href="#" class="btn btn-primary">
                                                                <em class="icon ni ni-loader"></em><span>Refresh</span>
                                                            </a>
                                                        </li>
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
                                                           {{--
                                                            <th class="nk-tb-col nk-tb-col-check">
                                                               <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                   <input type="checkbox" class="custom-control-input" id="pid-all">
                                                                   <label class="custom-control-label" for="pid-all"></label>
                                                               </div>
                                                           </th>
                                                            --}}
                                                            <th class="nk-tb-col"><span class="sub-text">Company Name</span></th>
                                                            <th class="nk-tb-col tb-col-xxl"><span class="sub-text">Name</span></th>
                                                            <th class="nk-tb-col tb-col-lg"><span class="sub-text">STIR</span></th>
                                                            <th class="nk-tb-col tb-col-lg"><span class="sub-text">Last Order</span></th>
                                                            <th class="nk-tb-col tb-col-xxl"><span class="sub-text">Qty</span></th>
                                                            <th class="nk-tb-col tb-col-md"><span class="sub-text">Total</span></th>
                                                            
                                                            <th class="nk-tb-col nk-tb-col-tools text-right">
                                                                Action
                                                            </th>
                                                        </tr><!-- .nk-tb-item -->
                                                    </thead>
                                                    <tbody>
                                                        <tr class="nk-tb-item">
                                                            {{--<td class="nk-tb-col nk-tb-col-check">
                                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                    <input type="checkbox" class="custom-control-input" id="pid-01">
                                                                    <label class="custom-control-label" for="pid-01"></label>
                                                                </div>
                                                            </td>--}}
                                                            <td class="nk-tb-col">
                                                                <a href="html/apps-kanban.html" class="project-title">
                                                                    <div class="user-avatar sq bg-purple"><span>NG</span></div>
                                                                    <div class="project-info">
                                                                        <h6 class="title">Nishon Group</h6>
                                                                    </div>
                                                                </a>
                                                            </td>
                                                            <td class="nk-tb-col tb-col-xxl">
                                                                <span>Nishon</span>
                                                            </td>
                                                            <td class="nk-tb-col tb-col-lg">
                                                                <span>123456789</span>
                                                            </td>
                                                            <td class="nk-tb-col tb-col-lg">
                                                                22-01-2025
                                                            </td>
                                                            <td class="nk-tb-col tb-col-xxl">
                                                                <span>12 000</span>
                                                            </td>
                                                            <td class="nk-tb-col tb-col-md">
                                                                12 500 000
                                                            </td>
                                                            
                                                            <td class="nk-tb-col nk-tb-col-tools">
                                                                <div class="dropdown">
                                                                    <a href="#" class="btn btn-xs btn-trigger btn-icon dropdown-toggle mr-n1" data-toggle="dropdown" data-offset="0,5"><em class="icon ni ni-more-h"></em></a>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                        <ul class="link-list-opt no-bdr">
                                                                            <li><a href="#"><em class="icon ni ni-eye"></em><span>View</span></a></li>
                                                                            <li><a href="#"><em class="icon ni ni-archive"></em><span>NewOrder</span></a></li>
                                                                            <li><a href="#"><em class="icon ni ni-list"></em><span>Items</span></a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            
                                                            </td>
                                                        </tr><!-- .nk-tb-item -->
                                                       
                                                    </tbody>
                                                </table><!-- .nk-tb-list -->
                                            </div><!-- .card-inner -->
                                            <div class="card-inner">
                                                <div class="nk-block-between-md g-3">
                                                    <div class="g">
                                                        <ul class="pagination justify-content-center justify-content-md-start">
                                                            <li class="page-item"><a class="page-link" href="#">Prev</a></li>
                                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                            <li class="page-item"><span class="page-link"><em class="icon ni ni-more-h"></em></span></li>
                                                            <li class="page-item"><a class="page-link" href="#">6</a></li>
                                                            <li class="page-item"><a class="page-link" href="#">7</a></li>
                                                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                                        </ul><!-- .pagination -->
                                                    </div>
                                                    <div class="g">
                                                        <div class="pagination-goto d-flex justify-content-center justify-content-md-start gx-3">
                                                            <div>Page</div>
                                                            <div>
                                                                <select class="form-select form-select-sm" data-search="on" data-dropdown="xs center">
                                                                    <option value="page-1">1</option>
                                                                    <option value="page-2">2</option>
                                                                    <option value="page-4">4</option>
                                                                    <option value="page-5">5</option>
                                                                    <option value="page-6">6</option>
                                                                    <option value="page-7">7</option>
                                                                    <option value="page-8">8</option>
                                                                    <option value="page-9">9</option>
                                                                    <option value="page-10">10</option>
                                                                    <option value="page-11">11</option>
                                                                    <option value="page-12">12</option>
                                                                    <option value="page-13">13</option>
                                                                    <option value="page-14">14</option>
                                                                    <option value="page-15">15</option>
                                                                    <option value="page-16">16</option>
                                                                    <option value="page-17">17</option>
                                                                    <option value="page-18">18</option>
                                                                    <option value="page-19">19</option>
                                                                    <option value="page-20">20</option>
                                                                </select>
                                                            </div>
                                                            <div>OF 102</div>
                                                        </div>
                                                    </div><!-- .pagination-goto -->
                                                </div><!-- .nk-block-between -->
                                            </div><!-- .card-inner -->
                                        </div><!-- .card-inner-group -->
                                    </div><!-- .card -->
                                </div><!-- .nk-block -->
                            </div>
                        

@endsection
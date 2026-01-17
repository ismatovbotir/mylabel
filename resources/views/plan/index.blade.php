@extends('layouts.app')

@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">


                <div class="nk-content-inner">
                    

                    <div class="nk-block z-5">
                        <div class="card card-bordered card-stretch">
                            <div class="card-inner-group">
                                <div class="card-inner p-0">
                                    <table class="nk-tb-list nk-tb-ulist">
                                        <thead>
                                            <tr class="nk-tb-item nk-tb-head">

                                                <th class="nk-tb-col tb-col"><span class="sub-text">Item</span></th>
                                                <th class="nk-tb-col "><span class="sub-text">Qty</span></th>
                                               
                                                <th class="nk-tb-col text-center">
                                                    <span class="ni ni-setting"></span>
                                                </th>
                                            </tr><!-- .nk-tb-item -->
                                        </thead>
                                        <tbody>
                                            @foreach ($items as $idx=> $item)
                                                <tr class="nk-tb-item" wire:key="plan-{{ $idx }}">
                                                    <td class="nk-tb-col">
                                                        {{$item->item->name}}
                                                       
                                                    </td>
                                                    <td class="nk-tb-col">{{ number_format($item->total_qty,0,' ',' ')}}</td>
                                                    

                                                    <td class="nk-tb-col">
                                                        <ul class="nk-tb-actions gx-1">
                                                            <li>
                                                                <div class="drodown">
                                                                    <a href="#"
                                                                        class="dropdown-toggle btn btn-sm btn-icon btn-trigger"
                                                                        data-toggle="dropdown"><em
                                                                            class="icon ni ni-more-h"></em></a>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                        <ul class="link-list-opt no-bdr">
                                                                            <li><a
                                                                                    href=""><em
                                                                                        class="icon ni ni-edit"></em><span>Supply Chain</span></a></li>


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
                                    {{ $items->links() }}
                                </div><!-- .card-inner -->
                            </div><!-- .card-inner-group -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>




            </div>
        </div>
    </div>
@endsection

<div>
    <div class="nk-block-head nk-block-head-sm z-10">
        <div class="nk-block-between">


            <div class="nk-block-head-content col-md-6 pl-0">
                <input class="form-control " type="text" wire:model.live="search" autofocus>
            </div><!-- .nk-block-head-content -->

            <div class="nk-block-head-content">
                <a class="btn btn-success" href="" wire:click.prevent="newOrder">New Order</a>
                
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

                                <th class="nk-tb-col tb-col"><span class="sub-text">Client</span></th>
                                <th class="nk-tb-col "><span class="sub-text">Data</span></th>
                                <th class="nk-tb-col tb-col-lg"><span class="sub-text">Author</span></th>
                                <th class="nk-tb-col tb-col text-center"><span class="sub-text">QTY/T/Delivered</span></th>
                                

                                <th class="nk-tb-col tb-col-lg"><span class="sub-text">Status</span></th>
                                <th class="nk-tb-col text-center">
                                    <span class="ni ni-setting"></span>
                                </th>
                            </tr><!-- .nk-tb-item -->
                        </thead>
                        <tbody>
                            @foreach ($data as $order)
                            @if($order->status!='Done')    
                            <tr class="nk-tb-item" wire:key="{{ $order->id }}">
                                    <td class="nk-tb-col">
                                        @if (auth()->user()->role_id == 3)
                                            <a href="{{ route('admin.order.bill', ['id' => $order->id]) }}"
                                                target="_blank">
                                                {{ $order->company->name }}
                                            </a>
                                        @else
                                            <a href="{{ route('admin.order.show', ['order' => $order->id]) }}">
                                                {{ $order->company->name }} - ( {{ $order->agreement_number }} /
                                                {{ $order->bill }} )
                                            </a>
                                        @endif

                                    </td>
                                    <td class="nk-tb-col text-nowrap">
                                        {{ $order->created_at->format('d-m-y') }}
                                    </td>
                                    <td class="nk-tb-col tb-col tb-col-lg">
                                        {{ $order->user->name }}
                                    </td>
                                    @if ($order->orderItems)
                                        @php
                                            $total = 0;
                                            $qty = 0;
                                            foreach ($order->orderItems as $item) {
                                                $qty = $qty + $item->qty;
                                                $total = $total + $item->qty * $item->price;
                                            }

                                        @endphp
                                        <td class="nk-tb-col tb-col  ">
                                            
                                                <p class="text-info text-center m-0">
                                                    {{ number_format($qty, 0, ' ', ' ') }}
                                                </p>


                                                <p class="text-primary text-center m-0">
                                                    {{ number_format($total, 0, ' ', ' ') }}
                                                </p>
                                                <p class="text-success  text-center m-0">
                                                    {{ number_format($order->delivery_items_sum_qty??0, 0, ' ', ' ') }}
                                                </p>

                                           



                                        </td>
                                    @else
                                        <td class="nk-tb-col tb-col">



                                        </td>
                                    @endif
                                   
                                    <td class="nk-tb-col tb-col tb-col-lg">
                                        {{ $order->status }}
                                    </td>

                                    <td class="nk-tb-col nk-tb-col-tools text-center">
                                        <ul class="nk-tb-actions gx-1 justify-content-center">
                                            <li>
                                                <div class="drodown">
                                                    <a href="#"
                                                        class="dropdown-toggle btn btn-sm btn-icon btn-trigger"
                                                        data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li>
                                                                <a href=""><em
                                                                        class="icon ni ni-coins"></em><span>Cash</span>
                                                                </a>
                                                            </li> 
                                                            <li><a
                                                                    href={{ route('admin.bill.show', ['bill' => $order->id]) }}><em
                                                                        class="icon ni ni-edit"></em><span>Payme</span></a>
                                                            </li>
                                                            @if (Auth::user()->role_id < 3 )
                                                                <li><a
                                                                        href={{ route('admin.order.show', ['order' => $order->id]) }}><em
                                                                            class="icon ni ni-edit"></em><span>Edit
                                                                            Order</span></a></li>
                                                            @endif
                                                            <li>
                                                                <a href=""><em
                                                                        class="icon ni ni-printer"></em><span>Print
                                                                        Order</span>
                                                                </a>
                                                            </li>
                                                           
                                                            @if($order->agreement_number!==null)
                                                            <li>
                                                                <a href="" wire:click.prevent="showModal('{{$order->id}}')"><em
                                                                        class="icon ni ni-truck"></em><span>Delivery</span>
                                                                </a>
                                                            </li>
                                                            @endif
                                                            @if($order->delivery_items_sum_qty>0)
                                                            <li>
                                                                <a
                                                                    wire:click.prevent="doneOrder('{{ $order->id }}')">
                                                                    <em class="icon ni ni-done"></em>
                                                                    <span>Done Order</span>
                                                                </a>

                                                            </li>
                                                            @endif
                                                            @if (count($order->orderItems) == 0)
                                                                <li>
                                                                    <a
                                                                        wire:click.prevent="delOrder('{{ $order->id }}')">
                                                                        <em class="icon ni ni-cross"></em>
                                                                        <span>Delete Order</span>
                                                                    </a>
                                                                </li>
                                                            @endif
                                                            
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @endif
                            @endforeach
                            
                        </tbody>
                    </table><!-- .nk-tb-list -->
                </div><!-- .card-inner -->
                <div class="card-inner">
                    {{ $data->links() }}
                </div><!-- .card-inner -->
                @if($modal)
                <div class="modal fade show" tabindex="-1" id="modalForm" style="display: block; padding-right: 17px; background: rgba(242, 242, 242, 0.7);" aria-modal="true" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{$current_order->company->name}}</h5>
                                <a href="" wire:click.prevent="closeModal" class="close" >
                                    <em class="icon ni ni-cross"></em>
                                </a>
                            </div>
                            <div class="modal-body">
                                
                                    
                                    <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Товар</th>
                                                <th>Ordered</th>
                                                <th>Delivered</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($dItems as $idx=> $item) 
                                            <tr wire:key="order-{{$idx}}">
                                                <td>
                                                    {{$item["name"]}}
                                                </td>
                                                <td>
                                                    {{$item["qty"]}}
                                                </td>
                                                <td>
                                                    <input type="text"
                                                                        class="form-control ps-1 pe-2 pt-1 pb-1 border-0 botder-bottom-1 text-right"
                                                                        x-data x-on:focus="$event.target.select()"
                                                                        x-on:change="$wire.deliveryQtyChanged({{$idx}}, $event.target.value)"
                                                                        value="{{$item['dqty']}}"
                                                                        inputmode="numeric" pattern="[0-9]*" >

                                                </td>
                                              </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                   
                                    
                               
                            </div>
                            <div class="modal-footer bg-light">
                                <div class="form-group">
                                    <button wire:click="saveDelivery()" class="btn btn-lg btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @endif

            </div><!-- .card-inner-group -->
        </div><!-- .card -->
    </div><!-- .nk-block -->
</div

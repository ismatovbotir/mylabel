<div class="nk-block">
    <div class="card card-preview">
        <div class="card-inner">
            <ul class="nav nav-tabs mt-n3">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#orders">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#offers">Offers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#items">Items</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="orders">
                    @if (count($orders) > 0)

                        <table class="nk-tb-list nk-tb-ulist">
                            <thead>
                                <tr class="nk-tb-item nk-tb-head">
                                    <th class="nk-tb-col d-flex">    
                                       <a href="{{ route('admin.company.newOrder', ['company' => $id]) }}"
                                            class="btn btn-success btn-sm"><span class="ni ni-plus"> </span></a>  
                                            <span class="sub-text ml-3">Data </span> 
                                    </th>
                                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Author</span></th>
                            <th class="nk-tb-col tb-col text-center"><span class="sub-text">QTY/Total</span></th>
                           
                            <th class="nk-tb-col tb-col"><span class="sub-text">Status</span></th>
                            <th class="nk-tb-col text-center">
                                <span class="ni ni-setting"></span>
                            </th>
                                </tr><!-- .nk-tb-item -->
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr class="nk-tb-item" wire:key>
                                        <td class="nk-tb-col">
                                            {{ $order->updated_at->format('d-m-y') }}
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            {{ $order->user->name }}
                                        </td>
                                        @php
                                        $total=0;
                                        $qty=0;
                                        foreach($order->orderItems as $item){

                                            $qty=$qty+$item->qty;
                                            $total=$total+($item->qty*$item->price);    
                                        }
    
                                        
                                    @endphp
                                <td class="nk-tb-col tb-col  ">
                                        <div class="row">
                                            <div class="text-info col-sm-6 text-right">
                                               {{number_format($qty,0,' ',' ')}}  
                                            </div>
                                           
                                            
                                            <div class="text-primary col-sm-6 text-left">
                                                {{number_format($total,0,' ',' ')}} 
                                            </div>    

                                        </div>
                                                                                
                                   
                                       
                                    </td>    

                                        <td class="nk-tb-col tb-col">
                                            {{ $order->status }}
                                        </td>
                                        <td class="nk-tb-col nk-tb-col-tools text-center">
                                           <a href="{{route('admin.order.show',['order'=>$order->id])}}"><em class="icon ni ni-edit"></em></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table><!-- .nk-tb-list -->
                    @else
                        <a href="{{ route('admin.company.newOrder', ['company' => $id]) }}"
                            class="btn btn-success btn-lg"><span class="ni ni-plus"> </span></a>
                    @endif
                </div>
                <div class="tab-pane" id="offers">
                    @forelse($offers as $offer)
                    
                    @empty
                        <a href="" class="btn btn-info btn-lg"><span class="ni ni-plus"> </span></a>
                    @endforelse
                </div>
                <div class="tab-pane" id="items">
                   
                        <livewire:company.items :companyId=$id />
                   
                </div>
            </div>
        </div>
    </div>
</div><!-- .nk-block -->

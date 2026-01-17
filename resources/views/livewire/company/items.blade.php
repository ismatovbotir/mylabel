<div class="row gy-4 align-center">
    <div class="container py-4 ">
        <div class="row">
            <div class="col-md-6 mb-2 pl-0">
                <input type="text" wire:model.live="search" class="form-control" placeholder="Введите товар..."
                    autofocus>
                @if (count($results) > 0)
                    <div class="dropdown-menu show w-100" style="max-height: 200px; overflow-y: auto;">
                        @foreach ($results as $result)
                            <button type="button" class="dropdown-item"
                                wire:click="selectItem('1' , '{{ $result->id }}')">
                                {{ $result->name }}
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>
            

        </div>


        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Item</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>%</th>
                    <th>Final</th>
                    
                    <th>Action</th>


                </tr>
            </thead>
            <tbody>
                @foreach ($items as $index => $item)
                    <tr class="position-relative" wire:key="order-item-{{ $item->id }}">
                        <td>
                             <strong>{{ $item->item->name }}</strong> 
                        </td>
                        <td>
                            {{ $item->priceType->name}}
                        </td>
                        <td>
                            @php
                            $prc=0;
                            @endphp
                            @forelse ($item->item->prices as $price)
                               
                                @if ($price->price_type_id==$company->price_type_id)
                                @php
                                    $prc=$price->price;
                                @endphp
                                {{$prc}}/{{$price->currency}}
                                    
                                @endif
                            @empty
                                0
                            @endforelse
                            
                        </td>
                        <td>
                            {{ $item->discount }}
                        </td>
                        <td>
                            @if($prc>0) 
                            <input type="text" class="form-control  ps-1 pe-2 pt-1 pb-1 border-0 text-right"
                                        x-data x-on:focus="$event.target.select()"
                                        x-on:change="$wire.changePrice({{ $item->id }}, $event.target.value,{{$prc}})"
                                        value="{{ round($prc-($prc*$item->discount)/100)}}" inputmode="numeric" pattern="[0-9]*">
                            @endif
                        </td>
                        
                        <td>
                             <button wire:click="removeItem('{{ $item->item_id }}')"
                                        class="btn btn-sm btn-outline-danger">✕</button>
                        </td>
                        <td></td>

                          

                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>
</div>


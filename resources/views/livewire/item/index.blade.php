<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content col-md-6 pl-0">
                        <input class="form-control " type="text" wire:model.live="search" autofocus>
                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                       

                                        <button wire:click="refreshItems" class="btn btn-primary"
                                            wire:loading.attr="disabled">
                                            <span wire:loading.remove> <span class="ni ni-update"></span></span>
                                            <span wire:loading> Loading Items...</span>
                                        </button>



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

                                        <th class="nk-tb-col "><span class="sub-text">Item Photo</span></th>
                                        <th class="nk-tb-col tb-col-lg "><span class="sub-text">Category</span></th>
                                        <th class="nk-tb-col "><span class="sub-text">Item Name</span></th>
                                        <th class="nk-tb-col "><span class="sub-text">Code</span></th>
                                        <th class="nk-tb-col "><span class="sub-text">Qty</span></th>
                                        <th class="nk-tb-col "><span class="sub-text">Price</span></th>

                                        <th class="nk-tb-col tb-col-lg text-center"><span class="sub-text">
                                            <div class="flex row m-auto p-auto">
                                                <div class="col-md-4">Chakana</div>
                                                <div class="col-md-4">Ulgurji</div>
                                                <div class="col-md-4">Hamkor</div>
                                            </div>
                                        </span>
                                        </th>

                                        <th class="nk-tb-col nk-tb-col-tools text-center">
                                            <span class="ni ni-setting"></span>
                                        </th>
                                    </tr><!-- .nk-tb-item -->
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr class="nk-tb-item" wire:key="{{ $item->id }}">
                                            <td class="nk-tb-col">
                                                <div class="user-avatar sq bg-green"><img
                                                        src="images/items/{{ $item->code }}.jpg" alt=""></div>
                                            </td>
                                            <td class="nk-tb-col tb-col-lg">

                                                <p class="title">{{ $item->category->name ?? "" }}</p>

                                            </td>

                                            <td class="nk-tb-col">
                                                <a href="{{ route('admin.item.show', ['item' => $item->id]) }}"
                                                    class="project-title">

                                                    <div class="project-info">
                                                        <h6 class="title">{{ $item->name }}</h6>
                                                    </div>
                                                </a>
                                            </td>

                                            <td class="nk-tb-col tb-col">
                                                <span>{{ $item->code }}</span>
                                            </td>
                                            <td class="nk-tb-col tb-col">
                                                <span>{{ number_format($item->qty,0,',',' ') }}</span>
                                            </td>
                                            <td class="nk-tb-col tb-col">
                                                <span>{{ $item->price > 1000 ? number_format($item->price,0,',',' ') : $item->price }}</span>
                                            </td>

                                            <td class="nk-tb-col tb-col-lg ">
                                                <div class="row justify-content-center">
                                                    @forelse($item->prices as $price)
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <div class="form-control-wrap">
                                                                    <div class="form-text-hint">
                                                                        <span
                                                                            class="overline-title text-{{ $price->currency == 'USD' ? 'success' : 'danger' }}">{{ $price->currency }}</span>
                                                                    </div>
                                                                    <input type="text"
                                                                        class="form-control  border-0  text-left"
                                                                        x-data x-on:focus="$event.target.select()"
                                                                        x-on:change="$wire.changePrice({{ $price->id }}, $event.target.value)"
                                                                        value="{{ $price->price }}" inputmode="numeric"
                                                                        pattern="[0-9]*">
                                                                </div>
                                                            </div>

                                                        </div>
                                                    @empty
                                                        <div class="btn-group " role="group"
                                                            aria-label="Basic mixed styles example">
                                                            <button type="button" class="btn btn-danger"
                                                                wire:click="prices('{{ $item->id }}','UZS')">UZS</button>

                                                            <button type="button" class="btn btn-success"
                                                                wire:click="prices('{{ $item->id }}','USD')">USD</button>
                                                        </div>
                                                    @endforelse

                                                </div>
                                            </td>
                                            <td class="nk-tb-col nk-tb-col-tools">
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
                                                                            href="{{ route('admin.item.show', ['item' => $item->id]) }}"><em
                                                                                class="icon ni ni-edit"></em><span>Edit
                                                                                Item</span></a></li>
                                                                    <li><a href="{{route('admin.item.report',['item'=>$item->id])}}" target="_blank"><em
                                                                                class="icon ni ni-report"></em><span>Report
                                                                                </span></a></li>
                                                                   
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
                            {{ $data->links() }}
                        </div><!-- .card-inner -->
                    </div><!-- .card-inner-group -->
                </div><!-- .card -->
            </div><!-- .nk-block -->
        </div>
    </div>
</div>

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview ">
                    <div class="nk-block-head nk-block-head-lg  mt-5">
                        <div class="nk-block-head-content d-flex justify-between">
                            <h2 class="nk-block-title fw-normal">{{$offer_id=='' ? 'New ' : 'Edit '}}Offer</h2>
<a href="{{ route('admin.offer.index') }}" class="btn btn-danger btn-lg"><span
                                class="ni ni-home "></span></a>
                        </div>

                       
                    </div><!-- .nk-block-head -->
                    
                    <div class="nk-block nk-block-lg">

                        <div class="card card-preview">
                            <div class="card-inner">
                                <div class="preview-block">

                                    <div class="row gy-4">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control"
                                                        wire:model.live="offerName" id="default-01"
                                                        placeholder="Offer name">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Client</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control"
                                                        wire:model.live="clientSearch" id="default-01"
                                                        placeholder="Input placeholder">
                                                    @if (count($clients) > 0)
                                                        <div class="dropdown-menu show w-100"
                                                            style="max-height: 200px; overflow-y: auto;">
                                                            @foreach ($clients as $client)
                                                                <button type="button" class="dropdown-item"
                                                                    wire:click="selectClient('{{ $client->id }}','{{ $client->name }}')">
                                                                    {{ $client->name }}
                                                                </button>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="form-label" for="default-05">Price Type</label>
                                                <div class="form-control-wrap">

                                                    <input type="text" class="form-control " id="default-05"
                                                        placeholder="Input placeholder" disabled
                                                        value={{ $priceTypeName }}>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="form-label" for="default-05"> Valid Till</label>
                                                <div class="form-control-wrap">

                                                    <input type="date" class="form-control" id="default-05"
                                                        placeholder="Input placeholder" wire:model.live="validDate" min="{{ \Carbon\Carbon::now()->addDays(5)->format('Y-m-d') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group h-100">

                                                <div class="form-control-wrap h-100">
                                                    @if (count($offerItems) > 0)
                                                        <button class="btn btn-success h-100"
                                                            wire:click="saveOffer">Save</button>
                                                    @else
                                                        <button class="btn btn-success h-100" disabled>Save</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div><!-- .card-preview -->

                        <div class="card card-preview">
                            <div class="card-inner">
                                <div class="preview-block">

                                    <div class="row gy-4">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Item</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="default-01"
                                                        placeholder="Input placeholder" wire:model.live="itemSearch">
                                                    @if (count($items) > 0)
                                                        <div class="dropdown-menu show w-100"
                                                            style="max-height: 200px; overflow-y: auto;">
                                                            @foreach ($items as $item)
                                                                <button type="button" class="dropdown-item"
                                                                    wire:click="selectItem('{{ $item->id }}')">
                                                                    {{ $item->name }}
                                                                </button>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <hr class="preview-hr">
                                    <div class="row gy-4 mt-2">
                                        <table class="table">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Товар</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($offerItems as $offerItem)
                                                    <tr class="position-relative"
                                                        wire:key="offer-item-".{{ $loop->index }}>

                                                        <td class="position-relative">
                                                            <div class="row d-flex flex-wrap">
                                                                <!-- Название товара - 1 строка -->
                                                                <div class="col-10 col-md-5 mb-2 p-0">
                                                                    <a href="{{ route('admin.item.show', ['item' => $offerItem['id']]) }}"
                                                                        target="_blank">
                                                                        <strong>{{ $offerItem['name'] }}</strong>
                                                                    </a>
                                                                </div>
                                                                <div class="col-2 col-md-1  text-end ">
                                                                    <button
                                                                        wire:click="removeItem({{ $loop->index }})"
                                                                        class="btn btn-sm btn-outline-danger">✕</button>
                                                                </div>

                                                                <!-- Кол-во -->
                                                                <div class="col-4 col-md-2 col-xs-3 mb-2 p-0">
                                                                    <input type="text"
                                                                        class="form-control ps-1 pe-2 pt-1 pb-1 border-0 botder-bottom-1 text-right"
                                                                        x-data x-on:focus="$event.target.select()"
                                                                        x-on:change="$wire.qtyChanged({{ $loop->index }}, $event.target.value)"
                                                                        value="{{ number_format($offerItem['qty'], 0, '.', ' ') }}"
                                                                        inputmode="numeric" pattern="[0-9]*">

                                                                </div>

                                                                <!-- Цена -->
                                                                <div class="col-4 col-md-2 mb-2 p-0">
                                                                    <input type="text"
                                                                        class="form-control ps-1 pe-2 pt-1 pb-1 border-0 botder-bottom-1 text-right"
                                                                        x-data x-on:focus="$event.target.select()"
                                                                        x-on:change="$wire.priceChanged({{ $loop->index }}, $event.target.value)"
                                                                        value="{{ number_format($offerItem['price'], 0, '.', ' ') }}"
                                                                        inputmode="numeric" pattern="[0-9]*">

                                                                </div>

                                                                <div class="col-4 col-md-2 mb-2 p-0">
                                                                    <input type="text"
                                                                        class="form-control ps-1 pe-2 pt-1 pb-1 border-0 botder-bottom-1 text-right"
                                                                        value="{{ number_format($offerItem['price'] * $offerItem['qty'], 0, '.', ' ') }}"
                                                                        disabled>

                                                                </div>



                                                                <!-- Кнопка удаления -->
                                                                










                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>


                                    </div>

                                </div>
                            </div>
                        </div><!-- .card-preview -->

                    </div><!-- .nk-block -->





                </div><!-- .components-preview -->
            </div>
        </div>
    </div>
</div>

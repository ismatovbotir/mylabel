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
                                {{ $result->name }} | {{$result->qty}}
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="col-md-6">
                <button class="btn btn-primary" wire:click="sendInvoice"  wire.loading.attr="disabled">
                    <span wire:loading.remove>Счет</span>
                    <span wire:loading>Loading...</span>
                        
                </button>

            </div>

        </div>


        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Товар</th>


                </tr>
            </thead>
            <tbody>
                @foreach ($orderItems as $index => $item)
                    <tr class="position-relative" wire:key="order-item-{{ $item->id }}">
                        <td class="position-relative">
                            <div class="row d-flex flex-wrap">

                                <!-- Название товара - 1 строка -->
                                <div class="col-12 col-md-6 mb-2 p-0">
                                    <a href="{{ route('admin.item.show', ['item' => $item->item->id]) }}" target="_blank">
                                        <strong>{{ $item->item->name }}</strong>
                                    </a>
                                </div>

                                <!-- Кол-во -->
                                <div class="col-4 col-md-2 mb-2 p-0">
                                    <input type="text"
                                        class="form-control ps-1 pe-2 pt-1 pb-1 border-0 botder-bottom-1 text-right"
                                        x-data x-on:focus="$event.target.select()"
                                        x-on:change="$wire.changeQty({{ $item->id }}, $event.target.value)"
                                        value="{{ $item->qty }}" inputmode="numeric" pattern="[0-9]*">
                                </div>

                                <!-- Цена -->
                                <div class="col-4 col-md-3 mb-2 p-0">
                                    <input type="text" class="form-control  ps-1 pe-2 pt-1 pb-1 border-0 text-right"
                                        x-data x-on:focus="$event.target.select()"
                                        x-on:change="$wire.changePrice({{ $item->id }}, $event.target.value)"
                                        value="{{ $item->price }}" inputmode="numeric" pattern="[0-9]*">
                                </div>

                                <!-- Кнопка удаления -->
                                <div class="col-2 col-md-1 text-end ">
                                    <button wire:click="removeItem({{ $item->id }})"
                                        class="btn btn-sm btn-outline-danger">✕</button>
                                </div>

                            </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>
</div>

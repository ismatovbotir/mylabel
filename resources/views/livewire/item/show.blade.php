<div class="nk-block nk-block-lg">

    <div class="card card-preview">
        <div class="card-inner">
            <div class="preview-block">
                <span class="preview-title-lg overline-title">{{ $item->name }}</span>
                <div class="row gy-4">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="default-01">Short name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="default-01" placeholder="Short name"
                                    value="{{ $item->short_name }}"
                                    wire:change="changeShortName('{{ $item->id }}', $event.target.value)">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="default-05">Acc Name</label>
                            <div class="form-control-wrap">

                                <input type="text" class="form-control" id="default-05"
                                    placeholder="Input placeholder" value="{{ $item->acc_name }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="form-group col-sm-3">

                                <label class="form-label" for="default-03">Price</label>
                                <div class="form-control-wrap">

                                    <input type="text" class="form-control" id="default-03"
                                        placeholder="Input placeholder" value="{{ $item->price }}" disabled>
                                </div>

                            </div>
                            <div class="form-group col-sm-3">

                                <label class="form-label" for="default-03">Qty</label>
                                <div class="form-control-wrap">

                                    <input type="text" class="form-control" id="default-03"
                                        placeholder="Input placeholder" value="{{ $item->qty }}" disabled>
                                </div>

                            </div>
                            <div class="form-group col-sm-3">

                                <label class="form-label" for="default-03">Code</label>
                                <div class="form-control-wrap">

                                    <input type="text" class="form-control" id="default-03"
                                        placeholder="Input placeholder" value="{{ $item->code }}" disabled>
                                </div>

                            </div>
                            <div class="form-group  col-sm-3">

                                <label class="form-label" for="default-03">Acc Code</label>
                                <div class="form-control-wrap">

                                    <input type="text" class="form-control" id="default-03"
                                        placeholder="Input placeholder" value="{{ $item->acc_code }}" disabled>
                                </div>

                            </div>
                        </div>


                    </div>

                    <div class="col-sm-6">
                        <div class="row">
                            <div class="form-group col-sm-8">

                                <label class="form-label" for="default-03">MXIK</label>
                                <div class="form-control-wrap">

                                    <input type="text" class="form-control" id="default-03"
                                        placeholder="Input placeholder" value="{{ $item->mxik }}" disabled>
                                </div>

                            </div>
                            <div class="form-group  col-sm-4">

                                <label class="form-label" for="default-03">P.code</label>
                                <div class="form-control-wrap">

                                    <input type="text" class="form-control" id="default-03"
                                        placeholder="Input placeholder" value="{{ $item->package_code }}" disabled>
                                </div>

                            </div>
                        </div>


                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="default-textarea">Description</label>
                            <div class="form-control-wrap">
                                <textarea class="form-control no-resize" wire:change="changeDescription('{{ $item->id }}', $event.target.value)"
                                    placeholder="Description">{{ $item->description }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="default-06">Photo</label>
                            <div class="form-control-wrap">
                                <div class="custom-file">
                                    <input type="file" multiple="" class="custom-file-input" id="customFile"
                                        disabled>
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="default-06">Gategory</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control"
                                        wire:change="changeCategory('{{ $item->id }}', $event.target.value)">
                                        {{-- <option value>Select Category</option> --}}
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $category->id == $item->category_id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <hr class="preview-hr">
                <span class="preview-title-lg overline-title">Prices</span>

                <div class="row gy-4 align-center">

                    @forelse($item->prices as $price)
                        <div class="col-md-4">
                            <div class="form-group">


                                <label class="form-label text-uppercase"
                                    for="default-05">{{ $price->type->name }}</label>
                                <div class="input-group mb-3">

                                    <input type="text" class="form-control text-right" x-data
                                        x-on:focus="$event.target.select()"
                                        x-on:change="$wire.changePrice({{ $price->id }}, $event.target.value)"
                                        value="{{ $price->price }}">
                                    <button
                                        wire:click="changePriceCurrency({{ $price->id }}, '{{ $price->currency }}')"
                                        class="btn btn-{{ $price->currency == 'USD' ? 'success' : 'danger' }}"
                                        type="button">{{ $price->currency }}</button>
                                </div>


                            </div>
                        </div>

                    @empty
                        <div class="col-md-4">
                            <div class="btn-group " role="group" aria-label="Basic mixed styles example">
                                <button type="button" class="btn btn-danger"
                                    wire:click="prices('{{ $item->id }}','UZS')">UZS</button>

                                <button type="button" class="btn btn-success"
                                    wire:click="prices('{{ $item->id }}','USD')">USD</button>
                            </div>
                        </div>
                    @endforelse

                </div>

            </div>
        </div>
    </div><!-- .card-preview -->

</div><!-- .nk-block -->

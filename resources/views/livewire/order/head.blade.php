<div class="row gy-4">
    <div class="col-sm-4">
        <div class="form-group">
            <label class="form-label" for="default-01">Client</label>
            <div class="form-control-wrap">
                <input type="text" class="form-control" id="default-01" placeholder="Input placeholder"
                    value="{{ $order->company->name }}" name="shortname" disabled>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="form-label" for="default-05">Date</label>
            <div class="form-control-wrap">

                <input type="text" class="form-control" id="default-05" placeholder="Input placeholder"
                    value="{{ $order->updated_at }}" disabled>
            </div>
        </div>
    </div>
    <div class="col-sm-2">

        <div class="form-group ">

            <label class="form-label" for="default-03">Avtor</label>
            <div class="form-control-wrap">

                <input type="text" class="form-control" id="default-03" placeholder="Input placeholder"
                    value="{{ $order->user->name }}" disabled>
            </div>

        </div>


    </div>
    <div class="col-md-2">

        <div class="form-group ">

            <label class="form-label" for="default-03">Status</label>
            <div class="form-control-wrap">

                <input type="text" class="form-control" id="default-03" placeholder="Input placeholder"
                    value="{{ $order->status }}" disabled>
            </div>

        </div>
    </div>
    <div class="col-sm-2">

        <div class="form-group">
            <label class="form-label" for="default-03">Price Type</label>

            <div class="form-control-wrap ">
                <div class="form-control-select">
                    <select class="form-control"
                        wire:change="changePriceType( $event.target.value)">
                        {{-- <option value>Select Category</option> --}}
                        @foreach ($priceTypes as $priceType)
                            <option value="{{ $priceType->id }}"
                                {{ $priceType->id == $order->price_type_id ? 'selected' : '' }}>
                                {{ $priceType->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            </select>
        </div>
    </div>

    <div class="col-sm-2">

        <div class="form-group">

            <label class="form-label" for="default-03">Currency</label>
            <div class="form-control-wrap">

                <input type="text" class="form-control p-2" id="default-03" placeholder="Input placeholder"
                    value="{{ $order->currency }}" disabled>
            </div>

        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label class="form-label" for="default-03">Type</label>

            <div class="form-control-wrap ">
                <div class="form-control-select">
                    <select class="form-control"
                        wire:change="changeType( $event.target.value)">
                        {{-- <option value>Select Category</option> --}}
                        @foreach ($types as $idx=>$type)
                            <option value="{{ $idx }}"
                                {{ $idx == $order->type ? 'selected' : '' }}>
                                {{ $type }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            </select>
        </div>
    </div>

    <div class="col-md-2">


        <div class="form-group">

            <label class="form-label" for="default-03">Expires</label>
            <div class="form-control-wrap">

                <input type="date" class="form-control" id="default-03" placeholder="Input placeholder"
                    value="{{ $order->expiry_date }}" wire:change="changeExpiryDate($event.target.value)" >
            </div>

        </div>
    </div>




    <div class="col-sm-1">
        <div class="form-group">
            <label class="form-label" for="default-textarea">Public</label>
            <div class="form-control-wrap">
                <input type="checkbox" wire:model.live="isPublic">
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="form-label" for="default-03">Payment Type</label>

            <div class="form-control-wrap ">
                <div class="form-control-select">
                    <select class="form-control"
                        wire:change="changeType( $event.target.value)">
                        {{-- <option value>Select Category</option> --}}
                        @foreach ($types as $idx=>$type)
                            <option value="{{ $idx }}"
                                {{ $idx == $order->type ? 'selected' : '' }}>
                                {{ $type }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            </select>
        </div>
    </div>

    <div class="col-sm-6">
        {{--
            
            <div class="form-group">
                <label class="form-label" for="default-06">Gategory</label>
                <div class="form-control-wrap ">
                    <div class="form-control-select">
                        <select class="form-control" id="default-06">
                            <option value>Select Category</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}" {{$category->id==$item->category_id?"selected":""}}>{{$category->name}}</option>
                            
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            --}}
    </div>

</div>

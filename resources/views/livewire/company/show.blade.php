<div class="accordion-inner">



    <div class="row gy-4">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="form-label" for="default-01">Company Name</label>
                <div class="form-control-wrap">
                    <input type="text" class="form-control" id="default-01" placeholder="Input placeholder"
                        value="{{ $company->fullName }}" name="shortname" disabled>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="form-label" for="default-03">Category</label>

                <div class="form-control-wrap ">
                    <div class="form-control-select">
                        <select class="form-control"
                            wire:change="changeCategory('{{ $company->id }}', $event.target.value)">
                            {{-- <option value>Select Category</option> --}}
                            @foreach ($priceTypes as $priceType)
                                <option value="{{ $priceType->id }}"
                                    {{ $priceType->id == $company->price_type_id ? 'selected' : '' }}>
                                    {{ $priceType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                </select>
            </div>
        </div>

        <div class="col-md-2">

            <div class="form-group ">

                <label class="form-label" for="default-03">Code</label>
                <div class="form-control-wrap">

                    <input type="text" class="form-control text-center" id="default-03"
                        placeholder="Input placeholder" value="{{ $company->code }}" disabled>
                </div>

            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">

                <label class="form-label" for="default-03">STIR</label>
                <div class="form-control-wrap">

                    <input type="text" class="form-control text-center" id="default-03"
                        placeholder="Input placeholder" value="{{ $company->stir }}" disabled>
                </div>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">

                <label class="form-label" for="default-03">Tel</label>
                <div class="form-control-wrap">

                    <input type="text" class="form-control text-right" id="default-03" placeholder="Telefon raqami"
                        value="{{ $company->mob }}">
                </div>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">

                <label class="form-label" for="default-03">Telegram</label>
                <div class="form-control-wrap">

                    <input type="text" class="form-control " id="default-03" placeholder="Telegram ID"
                        value="{{ $company->telegram }}">
                </div>

            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="form-label" for="default-06">Photo</label>
                <div class="form-control-wrap">
                    <div class="custom-file">
                        <input type="file" multiple="" class="custom-file-input" id="customFile" disabled>
                        <label class="custom-file-label" for="customFile">Choose
                            file</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-control-wrap">
                <textarea class="form-control no-resize" wire:change="changeAddress('{{ $company->id }}', $event.target.value)"
                    placeholder="Adress" {{strlen($company->address)==0?'':'disabled'}}>{{ $company->address }}</textarea>
            </div>
        </div>

    </div>
</div>

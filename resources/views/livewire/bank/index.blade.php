<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    
                    <div class="nk-block-head-content">

                        <input class="form-control-lg" type="date" wire:model="rDay" wire:change="getBankTransfer"
                            wire:loading.attr="disabled">


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
                                        <th class="nk-tb-col tb-col-xs"><span class="sub-text"> Date</span></th>
                                        <th class="nk-tb-col tb-col-xs"><span class="sub-text">Transaction Info</span></th>

                                        


                                    </tr><!-- .nk-tb-item -->
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr class="nk-tb-item" wire:key>
                                            <td class="nk-tb-col">
                                                {{$item['date']}}
                                            </td>
                                            <td class="nk-tb-col">
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <h6 class="text-secondary-light">{{ $item['name'] }}</h6>
                                                    </div>
                                                    
                                                
                                                    <div class="col-md-6 d-flex justify-content-end">
    
                                                        <h4 class="title text-success">{{ $item['total'] }}</h4>
                                                    </div>                                               
                                                 </div>

                                            </td>


                                        </tr>
                                    @endforeach
                                </tbody>
                            </table><!-- .nk-tb-list -->
                        </div><!-- .card-inner -->

                    </div><!-- .card-inner-group -->
                </div><!-- .card -->
            </div><!-- .nk-block -->
        </div>
    </div>
</div>

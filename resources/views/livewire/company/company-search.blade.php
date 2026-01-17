<div class="nk-content-body">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content row w-100">
                <div class="col-md-9">
                    <input class="form-control" type="text" wire:model.live="search" autofocus
                        placeholder="Search Company">

                </div>
                <div class="col-md-3">
                    @if (count($data) == 0)
                    <button wire:click="companyCreate" class="btn btn-success" wire.loading.attr="disabled">
                        <span class="ni ni-plus"></span> Company

                    </button>
                    @endif
                    @if ($search=="")
                    <button class="btn btn-primary" wire:click="refreshCompany" wire.loading.attr="disabled">
                        <span>Refresh</span>

                    </button>
                    @endif
                    <a class="btn btn-success p-2" href="{{route('admin.company.create')}}">
                        <span class="ni ni-user text-white text-bold"></span>
                    </a>
                </div>

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

                                <th class="nk-tb-col"><span class="sub-text">Company Name</span></th>
                                <th class="nk-tb-col tb-col-lg"><span class="sub-text">Category</span></th>
                                <th class="nk-tb-col tb-col-lg"><span class="sub-text">STIR</span></th>
                                <th class="nk-tb-col tb-col-lg"><span class="sub-text">Last Order</span>
                                </th>


                                <th class="nk-tb-col nk-tb-col-tools text-right">
                                    <span class="ni ni-setting"></span>
                                </th>
                            </tr><!-- .nk-tb-item -->
                        </thead>
                        <tbody>
                            @foreach ($data as $company)
                                <tr class="nk-tb-item">

                                    <td class="nk-tb-col">
                                        <a href="{{ route('admin.company.show', ['company' => $company->id]) }}"
                                            class="project-title">
                                            <div class="user-avatar sq bg-purple"><span>NG</span></div>
                                            <div class="project-info">
                                                <h6 class="title">{{ $company->fullName }}</h6>
                                            </div>
                                        </a>
                                    </td>

                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ $company->priceType->name }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-lg">
                                        <span>{{ $company->stir }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-lg">
                                        {{ $company->lastOrder ? $company->lastOrder->created_at->format('d-m-Y') : 'no order' }}
                                    </td>



                                    <td class="nk-tb-col nk-tb-col-tools">
                                        <div class="dropdown">
                                            <a href="#"
                                                class="btn btn-xs btn-trigger btn-icon dropdown-toggle mr-n1"
                                                data-toggle="dropdown" data-offset="0,5"><em
                                                    class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a
                                                            href="{{ route('admin.company.show', ['company' => $company->id]) }}"><em
                                                                class="icon ni ni-eye"></em><span>View</span></a>
                                                    </li>
                                                    <li><a
                                                            href="{{ route('admin.company.newOrder', ['company' => $company->id]) }}"><em
                                                                class="icon ni ni-archive"></em><span>NewOrder</span></a>
                                                    </li>
                                                    <li><a href="#"><em
                                                                class="icon ni ni-list"></em><span>Offer</span></a>
                                                    </li>
                                                    @if($company->stir)
                                                    <li><a href="{{route('admin.report.company',['stir'=>$company->stir])}}" target="_blank"><em
                                                        class="icon ni ni-reports"></em><span>Report</span></a>
                                                    </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>

                                    </td>
                                </tr><!-- .nk-tb-item -->
                            @endforeach
                        </tbody>
                    </table><!-- .nk-tb-list -->
                </div><!-- .card-inner -->

            </div><!-- .card-inner-group -->
        </div><!-- .card -->
    </div><!-- .nk-block -->

    <div class="nk-block">
        <div class="card card-bordered card-stretch">
            <div class="card-inner-group">

                <div class="card-inner p-0">

                    {{ $data->links() }}

                </div><!-- .card-inner -->
            </div><!-- .card-inner-group -->
        </div><!-- .card -->
    </div><!-- .nk-block -->



</div>


<div class="nk-content-inner">
    <div class="nk-block-head nk-block-head-sm z-10">
        <div class="nk-block-between">


            <div class="nk-block-head-content col-md-6 pl-0">
                <input class="form-control " type="text" wire:model.live="search" autofocus>
            </div><!-- .nk-block-head-content -->

            <div class="nk-block-head-content">
                <a class="btn btn-success" href="{{ route('admin.offer.create') }}">New Offer</a>
                </button>
            </div><!-- .nk-block-head-content -->

        </div><!-- .nk-block-between -->

    </div><!-- .nk-block-head -->

    <div class="nk-block z-5">
        <div class="card card-bordered card-stretch">
            <div class="card-inner-group">
                <div class="card-inner p-0">
                    <table class="nk-tb-list nk-tb-ulist">
                        <thead>
                            <tr class="nk-tb-item nk-tb-head">

                                <th class="nk-tb-col tb-col"><span class="sub-text">Client</span></th>
                                <th class="nk-tb-col "><span class="sub-text">Data</span></th>
                                <th class="nk-tb-col "><span class="sub-text">Valid Till</span></th>
                               
                                <th class="nk-tb-col tb-col-lg"><span class="sub-text">Author</span></th>
                               
                                <th class="nk-tb-col tb-col"><span class="sub-text">Public</span></th>
                                <th class="nk-tb-col tb-col"><span class="sub-text">Link</span></th>
                                <th class="nk-tb-col text-center">
                                    <span class="ni ni-setting"></span>
                                </th>
                            </tr><!-- .nk-tb-item -->
                        </thead>
                        <tbody>
                           @foreach ($data as $offer )
                               <tr class="nk-tb-item" wire:key="{{$offer->id}}">
                                   <td class="nk-tb-col">
                                   
                                   <a href="{{route('admin.offer.show',['offer'=>$offer->id])}}"> {{$offer->company->name}}</a>
                                    
                                    </td>
                                   <td class="nk-tb-col">{{$offer->created_at->format('d-m-y')}}</td>
                                   <td class="nk-tb-col">{{$offer->expiry_date}}</td>
                                  
                                   <td class="nk-tb-col">{{$offer->user->name}}</td>
                                   <td class="nk-tb-col">
                                    <input type="checkbox" {{$offer->public==1?'checked':''}} wire:click="publicStatus({{$offer->public}},'{{$offer->id}}')">    
                                </td>
                                   <td class="nk-tb-col">
                                    @if($offer->public)
                                    <a href="http://crm.mylabel.uz/offers/{{$offer->id}}" target="_blank">link</a>
                                   
                                    @endif

                                   </td>
                                   <td class="nk-tb-col">
                                    <ul class="nk-tb-actions gx-1">
                                        <li>
                                            <div class="drodown">
                                                <a href="#"
                                                    class="dropdown-toggle btn btn-sm btn-icon btn-trigger"
                                                    data-toggle="dropdown"><em
                                                        class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="{{route('admin.offer.show',['offer'=>$offer->id])}}"
                                                                ><em
                                                                    class="icon ni ni-edit"></em><span>Edit
                                                                    Offer</span></a></li>
                                                        <li><a href="#" wire:click.prevent="deleteOffer('{{$offer->id}}')"><em
                                                                    class="icon ni ni-delete"></em><span>Delete
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
                    {{-- $data->links() --}}
                </div><!-- .card-inner -->
            </div><!-- .card-inner-group -->
        </div><!-- .card -->
    </div><!-- .nk-block -->
</div>

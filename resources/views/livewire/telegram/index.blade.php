<div class="nk-block z-5">
    <div class="card card-bordered card-stretch">
        <div class="card-inner-group">
            <div class="card-inner p-0">
                <table class="nk-tb-list nk-tb-ulist">
                    <thead>
                        <tr class="nk-tb-item nk-tb-head">

                            <th class="nk-tb-col tb-col"><span class="sub-text">Client</span></th>
                            <th class="nk-tb-col tb-col"><span class="sub-text">Phone</span></th>

                            <th class="nk-tb-col "><span class="sub-text">Tip</span></th>
                            <th class="nk-tb-col "><span class="sub-text">Last Message</span></th>
                            <th class="nk-tb-col tb-col-lg"><span class="sub-text">User</span></th>
                            <th class="nk-tb-col tb-col text-center"><span class="sub-text">Company</span></th>
                           
                            
                        </tr><!-- .nk-tb-item -->
                    </thead>
                    <tbody>
                        @foreach ($data as $telegram)
                            <tr class="nk-tb-item" wire:key="{{$telegram->id}}">
                                <td class="nk-tb-col text-nowrap">
                                   
                                    <a href="{{route('admin.telegram.show',['telegram'=>$telegram->id])}}" >
                                        {{$telegram->id}} - {{$telegram->username}} : {{$telegram->first_name}} {{$telegram->last_name}}
                                    </a>
                                    
                                   
                                </td>
                                <td class="nk-tb-col text-nowrap">
                                    {{$telegram->phone}}
                                </td>
                                <td class="nk-tb-col text-nowrap">
                                    {{$telegram->lastMessage->type ?? ''}}
                                </td>
                                <td class="nk-tb-col text-wrap">
                                  
                                    {{$telegram->lastMessage->text ?? ''}}
                                </td>
                                <td class="nk-tb-col tb-col tb-col-lg">
                                   {{$telegram->user->name ?? ''}}
                                </td>
                               
                                
                               
                                 <td class="nk-tb-col tb-col">
                                    {{$telegram->company ?? ''}}
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
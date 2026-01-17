
                <div class="accordion-inner">
                   
                    <div class="relative">

                        <div class="col-md-6">
                           <input  class="form-control" wire:model.live="search" > 
                           @if(count($items)>0)
                           <div class="suggestion-box shadow-sm position-absolute z-500">
                            @foreach($items as $item)
                            <div class="suggestion-item">{{$item['name']}}</div>
                            
                            @endforeach
                          </div>
                          @endif
                        </div>
                       
                    </div>



                </div>
           
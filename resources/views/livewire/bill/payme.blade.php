<div class="preview-block">
    <span class="preview-title-lg overline-title">Payme</span>
    <div class="row gy-4">
        
        <div class="col-sm-9">

            <div class="form-group ">

                <label class="form-label" for="default-03">Mob:</label>
                <div class="form-control-wrap">

                    <input type="text" class="form-control" id="default-03"
                        placeholder="mobil raqam kiriting" name="phone" wire:model.live="phone">
                </div>

            </div>
        </div>
        
        <div class="col-sm-3 d-flex align-items-end">

            <div class="form-group h-100">


                <div class="form-control-wrap h-100">

                    <button wire:click="sendPayme" class="btn btn-success w-100 h-100">
                        Payme
                    </button>
                </div>

            </div>



        </div>



    </div>



</div>
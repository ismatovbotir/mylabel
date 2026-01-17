<div class="nk-content-body">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content col-md-12 pl-0">
                <div class="nk-block nk-block-lg">

                    <div class="card card-preview">
                        <div class="card-inner">
                            <form action="{{ route('admin.company.store') }}" method="POST">
                                @csrf
                                <div class="preview-block">
                                    <span class="preview-title-lg overline-title">Jismoniy Shaxs</span>
                                    <div class="row gy-4">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Ism</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="default-01"
                                                        name="clientName">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="default-05">Familiya</label>
                                                <div class="form-control-wrap">

                                                    <input type="text" class="form-control" id="default-05"
                                                        placeholder="Input placeholder" name="surename">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">

                                            <div class="form-group ">

                                                <label class="form-label" for="default-03">Mob:</label>
                                                <div class="form-control-wrap">

                                                    <input type="text" class="form-control" id="default-03"
                                                        placeholder="Input placeholder" name="phone">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-sm-3">

                                            <div class="form-group">

                                                <label class="form-label" for="default-03">Brand</label>
                                                <div class="form-control-wrap">

                                                    <input type="text" class="form-control" id="default-03"
                                                        placeholder="Input placeholder" name="brand">
                                                </div>

                                            </div>



                                        </div>
                                        <div class="col-sm-3 d-flex align-items-end">

                                            <div class="form-group h-100">


                                                <div class="form-control-wrap h-100">

                                                    <button type="submit" class="btn btn-success w-100 h-100">
                                                        Save
                                                    </button>
                                                </div>

                                            </div>



                                        </div>



                                    </div>



                                </div>

                            </form>

                        </div>
                    </div><!-- .card-preview -->

                </div><!-- .nk-block -->
            </div><!-- .nk-block-head-content -->

        </div><!-- .nk-block-between -->

    </div><!-- .nk-block-head -->




</div>

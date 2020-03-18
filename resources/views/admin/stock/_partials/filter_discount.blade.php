<div class="package-box">
    <div class="basic-center basic-wall shadow-none" data-id="{{ $main_unique }}">
        <div class="w-100">
            <div class="">
                <div class="row">

                    <div class="col-lg-12">
                        <label>Display as: </label>
                        {!! Form::select("variations[$main_unique][display_as]",
                        ['select_filter' => 'select filters','filter_popup' => "Pop up"],($main) ? $main->display_as : null,['class' => 'form-control display-change']) !!}
                    </div>

                    <div class="col-lg-8">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




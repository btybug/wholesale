<div class="box box-primary widget-view" data-title="Quick Email">
    <div class="d-flex flex-wrap  px-3 py-2">
        <i class="fa fa-envelope"></i>

        <h3 class="box-title h6 ml-1">Quick Email</h3>
        <!-- tools box -->
        {{--<div class="pull-right box-tools">--}}
            {{--<button type="button" class="btn btn-primary btn-sm" data-widget="remove" data-toggle="tooltip"--}}
                    {{--title="Remove">--}}
                {{--<i class="fa fa-times"></i></button>--}}
        {{--</div>--}}
        <!-- /. tools -->
    </div>
    <div class="box-body">
        <form action="#" method="post" id="quick-email">
            <div class="form-group">
                <input type="email" class="form-control" name="emailto" value="{!! old('emailto') !!}" placeholder="Email to:">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="subject" value="{!! old('subject') !!}" placeholder="Subject">
            </div>
            <div>
                  <textarea name="message" class="textarea" placeholder="Message"
                            style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
            </div>
        </form>
    </div>
    <div class="box-footer clearfix">
        <button type="button" class="pull-right btn btn-default" id="sendEmailQuickEmail">Send
            <i class="fa fa-arrow-circle-right"></i></button>
    </div>
</div>
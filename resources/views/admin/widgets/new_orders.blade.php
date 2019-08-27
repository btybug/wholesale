@inject('widget','App\Services\Widgets')

    <!-- small box -->
    <div class="small-box bg-aqua widget-view" data-title="New Orders">
        <div class="inner">
            <h3>{!! $widget->newOrders() !!}</h3>

            <p>New Orders</p>
        </div>
        <div class="icon">
            <i class="ion ion-bag"></i>
        </div>
        <a href="{!! route('admin_orders') !!}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>

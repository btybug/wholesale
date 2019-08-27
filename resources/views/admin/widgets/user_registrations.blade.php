@inject('widget','App\Services\Widgets')
    <!-- small box -->
    <div class="small-box bg-yellow widget-view" data-title="New Registered Users">
        <div class="inner">
            <h3>{!! $widget->userRegistrations() !!}</h3>

            <p>User Registrations</p>
        </div>
        <div class="icon">
            <i class="ion ion-person-add"></i>
        </div>
        <a href="{!! route('admin_customers') !!}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        <script>
          document.addEventListener('DOMContentLoaded', function() {
            console.log(document.querySelector('.main-content [data-id="New Registered Users"]'), 'log------------')
//            document.querySelectorAll('.main-content [data-id="New Registered Users"]') && alert('New Registered Users')
            console.log(gapi);
          })
        </script>
    </div>

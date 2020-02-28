<div class="voucher-card">

    <div class="d-flex">
        <div class="col-xs-5 p-0">
            <div class="voucher-card_left">
                <p class="voucher-card_left_title text-uppercase mb-0">{{ ($model) ? $model->name : $data['name'] }}</p>
                <a href="{!! url('/') !!}" class="d-block voucher-card_left-logo-holder">
                    <img src="{{ get_site_logo() }}" alt="logo">
                </a>
            </div>
        </div>

        <div class="col-xs-7">
            <div class="voucher-card_right">
                <p class="voucher-card_price"><strong>
                        {{ ($model) ?
                            convert_price($model->discount,get_currency(),false,(($model->type != 'f')?true:false))
                            :
                            convert_price($data['discount'],get_currency(),false,(($data['type'] != 'f')?true:false))
                        }}
                        {{ ($model) ? (($model->type != 'f')?"%":"") : (($data['type'] != 'f')?"%":"") }}
                    </strong></p>
                <p class="voucher-card_price_info">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium
                    assumenda distinctio doloremque, eaque facere facilis id libero nihil officiis praesentium quia
                    soluta, tempora voluptate voluptatum?</p>
                <div class="voucher-card_footer">
                    <p><strong>Lorem ipsum dolor sit amet.</strong></p>
                    <ul class="voucher-card_footer-list d-flex flex-wrap">
                        <li><a href="#">example@mail.ifo</a></li>
                        <li><a href="#">77 88588556</a></li>
                        <li><a href="#">sitename.com</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

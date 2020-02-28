<div class="d-flex align-items-center right-head">
    <span class="font-16 status">Status</span>
    @php
        $status = $order->history()->whereNotNull('status_id')->latest()->first()
    @endphp
    <div class="font-main-bold font-16 submit-btn" style="background-color: {{ @$status->status->color }}">
        @if($status && $status->status)
            {{ $status->status->name }}
        @endif
    </div>
    <div class="font-main-light font-16 lh-1 d-none status-pending">
        @if($status && $status->status)
            {{ $status->status->name }}
        @endif
    </div>
    <div class="font-main-light font-18 bg-blue-clr change-btn">Change</div>
</div>

<div class="d-none order__change-status-wrapper">
    {!! Form::open(['url' =>route('orders_add_note'),'class' => 'w-100']) !!}
    {!! Form::hidden('id',$order->id) !!}
    <div
        class="d-flex align-items-center justify-content-between font-main-reg order__change-status-wrapper-inner">
        <div class="d-flex align-items-center order__change-status-wrapper-left">
            <span class="font-sec-reg font-20 lh-1 text-tert-clr status-title">Change Status To</span>
            <div class="custom-status-select position-relative">
                {!! Form::select('status_id',$statuses,null,['class' => 'form-control  status-select']) !!}
                <span class="position-absolute icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="10px" height="9px">
<path fill-rule="evenodd" fill="rgb(53, 53, 53)"
      d="M5.544,8.368 L0.956,0.809 L9.955,0.704 L5.544,8.368 Z"/>
</svg>
                                </span>
            </div>

        </div>
        <div class="d-flex align-items-center order__change-status-wrapper-right">
            {!! Form::textarea('note',null,['class' => 'border-main add-note-area','cols' =>30,'rows' => 10,'placeholder' =>'Add Note']) !!}
            <button class="border-main font-18 text-sec-clr bg-blue-clr change-status-btn">Change</button>
            <div class="border-main close-status-icon">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    width="32px" height="32px">
                    <path fill-rule="evenodd" fill="rgb(53, 53, 53)"
                          d="M32.000,0.997 L31.004,-0.000 L16.000,15.002 L0.997,-0.000 L-0.000,0.997 L15.003,16.000 L-0.000,31.002 L0.997,32.000 L16.000,16.995 L31.004,32.000 L32.000,31.002 L16.997,16.000 L32.000,0.997 Z"/>
                </svg>
            </div>
        </div>

    </div>
    {!! Form::close() !!}
</div>

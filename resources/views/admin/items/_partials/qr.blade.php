<div class="row mt-5">
    <div class="col-xl-3">
        QR CODE
    </div>
    <div class="col-xl-6">
        {!! \DNS2D::getBarcodeHTML('https://kaliony.com/landings/'.$code, "QRCODE") !!}
    </div>
    <div class="col-xl-3">
        <a class="btn btn-success" href="{{ route("admin_items_download_code",[$code,'qr',($model)?$model->name: null]) }}">Download QR code</a>
    </div>
</div>


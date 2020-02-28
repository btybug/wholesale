@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div id="accordion" class="ebay-setting--page">
        <div class="card">
            <div class="card-header" id="headingSettings">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#settings" aria-expanded="true" aria-controls="settings">
                        SETTINGS
                    </button>
                </h5>
            </div>

            <div id="settings" class="collapse show" aria-labelledby="headingSettings" data-parent="#accordion">
                <div class="card-body">
                    <form>
                        <div class="form-group row">
                            <label for="select1" class="col-4 col-form-label">Attribute Set ID</label>
                            <div class="col-8">
                                <select id="select1" name="select1" class="custom-select">
                                    <option value="rabbit">Rabbit</option>
                                    <option value="duck">Duck</option>
                                    <option value="fish">Fish</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="select" class="col-4 col-form-label">Global Sites</label>
                            <div class="col-8">
                                <select id="select" name="select" class="custom-select">
                                    <option value="rabbit">Rabbit</option>
                                    <option value="duck">Duck</option>
                                    <option value="fish">Fish</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="text" class="col-4 col-form-label">eBay User ID</label>
                            <div class="col-8">
                                <input id="text" name="text" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="text1" class="col-4 col-form-label">eBay Authentication Token</label>
                            <div class="col-8">
                                <input id="text1" name="text1" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="text2" class="col-4 col-form-label">eBay Developer ID</label>
                            <div class="col-8">
                                <input id="text2" name="text2" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="text3" class="col-4 col-form-label">eBay Application ID</label>
                            <div class="col-8">
                                <input id="text3" name="text3" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="text4" class="col-4 col-form-label">eBay Certification ID</label>
                            <div class="col-8">
                                <input id="text4" name="text4" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="select2" class="col-4 col-form-label">Mode</label>
                            <div class="col-8">
                                <select id="select2" name="select2" class="custom-select">
                                    <option value="rabbit">Rabbit</option>
                                    <option value="duck">Duck</option>
                                    <option value="fish">Fish</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="text5" class="col-4 col-form-label">Shops Postal Code</label>
                            <div class="col-8">
                                <input id="text5" name="text5" type="text" class="form-control">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingCategory">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#category" aria-expanded="false" aria-controls="category">
                       GET EBAY CATEGORY
                    </button>
                </h5>
            </div>
            <div id="category" class="collapse" aria-labelledby="headingCategory" data-parent="#accordion">
                <div class="card-body">
                        <button class="btn btn-danger">DOWNLOAD EBAY CATEGORIES</button>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingPolicy">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#policy" aria-expanded="false" aria-controls="policy">
                       RETURNS POLICY
                    </button>
                </h5>
            </div>
            <div id="policy" class="collapse" aria-labelledby="headingPolicy" data-parent="#accordion">
                <div class="card-body">
                    <form>
                        <div class="form-group row">
                            <label for="select1" class="col-4 col-form-label">Define Return Policy</label>
                            <div class="col-8">
                                <select id="select1" name="select1" class="custom-select">
                                    <option value="rabbit">Rabbit</option>
                                    <option value="duck">Duck</option>
                                    <option value="fish">Fish</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="select" class="col-4 col-form-label">Return Within</label>
                            <div class="col-8">
                                <select id="select" name="select" class="custom-select">
                                    <option value="rabbit">Rabbit</option>
                                    <option value="duck">Duck</option>
                                    <option value="fish">Fish</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="select2" class="col-4 col-form-label">Pay By</label>
                            <div class="col-8">
                                <select id="select2" name="select2" class="custom-select">
                                    <option value="rabbit">Rabbit</option>
                                    <option value="duck">Duck</option>
                                    <option value="fish">Fish</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="textarea" class="col-4 col-form-label">Other Information</label>
                            <div class="col-8">
                                <textarea id="textarea" name="textarea" cols="40" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingListingDuration">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#listing-duration" aria-expanded="false" aria-controls="listing-duration">
                       LISTING DURATION
                    </button>
                </h5>
            </div>
            <div id="listing-duration" class="collapse" aria-labelledby="headingListingDuration" data-parent="#accordion">
                <div class="card-body">
                    <form>
                        <div class="form-group row">
                            <label for="select1" class="col-4 col-form-label">Listing Duration</label>
                            <div class="col-8">
                                <select id="select1" name="select1" class="custom-select">
                                    <option value="rabbit">Rabbit</option>
                                    <option value="duck">Duck</option>
                                    <option value="fish">Fish</option>
                                </select>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingDispatchTime">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#dispatch-time" aria-expanded="false" aria-controls="dispatch-time">
                       DISPATCH TIME
                    </button>
                </h5>
            </div>
            <div id="dispatch-time" class="collapse" aria-labelledby="headingDispatchTime" data-parent="#accordion">
                <div class="card-body">
                    <form>
                        <div class="form-group row">
                            <label for="select1" class="col-4 col-form-label">Dispatch Time</label>
                            <div class="col-8">
                                <select id="select1" name="select1" class="custom-select">
                                    <option value="rabbit">Rabbit</option>
                                    <option value="duck">Duck</option>
                                    <option value="fish">Fish</option>
                                </select>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingDefaultPaymentDetails">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#payment-details" aria-expanded="false" aria-controls="payment-details">
                       DEFAULT PAYMENT DETAILS
                    </button>
                </h5>
            </div>
            <div id="payment-details" class="collapse" aria-labelledby="headingDefaultPaymentDetails" data-parent="#accordion">
                <div class="card-body">
                    <form>
                        <div class="form-group row">
                            <label for="text" class="col-4 col-form-label">PayPal ID</label>
                            <div class="col-8">
                                <input id="text" name="text" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="select1" class="col-4 col-form-label">Default Category</label>
                            <div class="col-8">
                                <select id="select1" name="select1" class="custom-select">
                                    <option value="rabbit">Rabbit</option>
                                    <option value="duck">Duck</option>
                                    <option value="fish">Fish</option>
                                </select>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingDefaultShippingDetails">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#shipping-details" aria-expanded="false" aria-controls="shipping-details">
                       DEFAULT SHIPPING DETAILS
                    </button>
                </h5>
            </div>
            <div id="shipping-details" class="collapse" aria-labelledby="headingDefaultShippingDetails" data-parent="#accordion">
                <div class="card-body">
                    <form>
                        <div class="form-group row">
                            <label for="text" class="col-4 col-form-label">Shipping Service Priority</label>
                            <div class="col-8">
                                <input id="text" name="text" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="select1" class="col-4 col-form-label">Shipping Service</label>
                            <div class="col-8">
                                <select id="select1" name="select1" class="custom-select">
                                    <option value="rabbit">Rabbit</option>
                                    <option value="duck">Duck</option>
                                    <option value="fish">Fish</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="text" class="col-4 col-form-label">Shipping Service Cost</label>
                            <div class="col-8">
                                <input id="text" name="text" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="text" class="col-4 col-form-label">Shipping Service Additional Cost</label>
                            <div class="col-8">
                                <input id="text" name="text" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="text" class="col-4 col-form-label">Shipping Time Min</label>
                            <div class="col-8">
                                <input id="text" name="text" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="text" class="col-4 col-form-label">Shipping Time Max</label>
                            <div class="col-8">
                                <input id="text" name="text" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="select1" class="col-4 col-form-label">Shipping Free</label>
                            <div class="col-8">
                                <select id="select1" name="select1" class="custom-select">
                                    <option value="rabbit">YES</option>
                                    <option value="duck">NO</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

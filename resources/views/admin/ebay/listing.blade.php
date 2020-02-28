@extends('layouts.admin')
@section('content-header')

@stop
@section('content')
    <div class="ebay-listing-page--wrapper">
        <div class="import-wrap text-right mb-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ebayImportModalCenter">
                Import
            </button>
        </div>
        <div class="d-flex justify-content-between bg-secondary text-white p-2 align-items-center ebay-top-wrap mb-2 border-bottom-2">
            <div class="ebay-top-wrap-left h3 m-0">
Map Products
            </div>
            <div class="d-flex ebay-top-wrap-right">
                <a href="#" class="btn btn-warning mr-2">
                    Synchronize Form eBay
                </a>
                <a href="#" class="btn btn-warning">
                    Synchronize To eBay
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">ID</th>
                    <th scope="col">Product Id</th>
                    <th scope="col">Ebay Product Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Price</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Set Price Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td align="middle">
                        <input type="checkbox">
                    </td>
                    <td align="right">225</td>
                    <td align="right">436</td>
                    <td>11054864</td>
                    <td>checkprice pro</td>
                    <td>simple</td>
                    <td align="right">$120.1</td>
                    <td>
                        Dec 11,2019
                        <br>
                        00:00:32PM
                    </td>
                    <td>
                        <a href="#">Set Price</a>
                        </td>
                </tr>
                <tr>
                    <td align="middle">
                        <input type="checkbox">
                    </td>
                    <td align="right">225</td>
                    <td align="right">436</td>
                    <td>11054864</td>
                    <td>checkprice pro</td>
                    <td>simple</td>
                    <td align="right">$120.1</td>
                    <td>
                        Dec 11,2019
                        <br>
                        00:00:32PM
                    </td>
                    <td>
                        <a href="#">Set Price</a>
                    </td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="ebayImportModalCenter" tabindex="-1" role="dialog" aria-labelledby="ebayImportModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ebayImportModalCenterTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@stop

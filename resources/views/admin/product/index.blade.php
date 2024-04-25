@extends('admin.app')
@section('css')
<link rel="stylesheet" type="text/css" href="{{url('assets/src/plugins/fancybox/dist/jquery.fancybox.css')}}" />
<style>
    
#kendoGridProduct.k-grid td{
  overflow: unset !important;
}
</style>
@endsection
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="title">
                                <h4>Product</h4>
                            </div>
                            <div class="text-end mb-4">
                                <a href="{{ route('admin.product.create') }}" class="btn btn-primary align-items-center d-inline-flex"><i
                                        class="ri-add-circle-fill"></i> Add Product</a>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Product
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Simple Datatable start -->
                <div class="card-box mb-30 pd-20">
                    <div class="pb-20">
                        <div id="kendoGridProduct"></div>
                    </div>
                </div>
                <!-- Simple Datatable End -->
            </div>
        </div>
    </div>
 
@endsection
@section('script')
	<!-- fancybox Popup Js -->
    <script src="{{ url('assets/vendors/scripts/layout-settings.js') }}"></script>
    <script src="{{ url('assets/src/plugins/fancybox/dist/jquery.fancybox.js') }}"></script>
    <script>
$(document).on("click", ".delete-product", function (e) {
    var Id = $(this).attr("ref");
    var data = $(this);
    bootbox.confirm({
            message: "Are you sure you want to delete ?",
            buttons: {
                confirm: {
                    label: "Yes",
                    className: "btn-success",
                },
                cancel: {
                    label: "No",
                    className: "btn-danger",
                },
            },
            callback: function (result) {
                if (result) {
                    var token = $('meta[name="csrf-token"]').attr("content");
                    $.ajax({
                        url: web_url + "/admin/product/delete/" + Id,
                        type: "get",
                        dataType: "json",
                        data: {
                            _tocken: token,
                        },
                        statusCode: {
                            200: function (xhr) {
                                $.toast({
                                    heading: "success",
                                    text: xhr.message,
                                    position: "top-right",
                                    icon: "success",
                                    position: {
                                        right: 10,
                                        top: 90,
                                    },
                                });
                                data.closest("tr").remove();
                            },
                        },
                        error: function (xhr) {
                            showerror(xhr.responseJSON.error.message);
                        },
                    });
                }
            },
        });
    });
        $("#kendoGridProduct").kendoGrid({
        noRecords: {
            template: "No data available on current page.",
        },
        dataSource: {
            type: "json",
            transport: {
                read: web_url + "/admin/product/get",
                dataType: "json",
            },
            pageSize: 20,
            batch: true,
            serverPaging: true,
            serverSorting: true,
            schema: {
                model: {
                    CardId: "CardId",
                },
                data : function (response) {
                    return response.data;
                },
                total : function(response){
                    return response.__count
                }
            },
            change: function (e) {
                var view = this.view();
            },
        },
        height: 550,
        sortable: true,
        scrollable: {
            endless: true
        },
        filterable: true,
        pageable: {
            numeric: false,
            previousNext: false
        },
        noRecords: true,
        columns: [
            {
                title: "Image",
                template: function (params) {
                    return `<div class="chat-profile-photo"> <img src="${ ( params.media_arr[0] ) ? params.media_arr[0] : '' }"/> </div>`;
                },
            },
            {
                title: "Title", field : "title"
            },
            {
                title: "price",field : "product_price"
            },
            {
                title: "product price compared_at",field : "product_price_compared_at"
            },
            {
                title: "Status",
                template: function (params) {
                    return `<div class="form-check form-switch">
                                <input class="form-check-input change-status"  data-atr="${params.id}" type="checkbox" role="switch" id="flexSwitchCheckChecked" ${( params.status == 1 ) ? 'checked' : ''}>
                            </div>`;
                },
            },
            {
                title: "Action/Edit",
                template: function (params) {
                    let actionWrap = ` <div class="dropdown">
                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                        href="#" role="button" data-toggle="dropdown">
                        <i class="dw dw-more"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        <a class="dropdown-item edit-product" href="${web_url}/admin/product/${params.id}/edit" data-id="${params.id}"  type="button"><i
                                class="dw dw-edit2"></i> Edit </a>
                        <a class="dropdown-item delete-product" ref="${params.id}" href="#"><i class="dw dw-delete-3"></i>
                            Delete</a>
                    </div>
                </div>`
                    return actionWrap;
                },
            },
           
    ]});
    </script>
@endsection
    


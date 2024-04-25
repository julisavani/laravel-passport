@extends('admin.app')
@section('css')
<link rel="stylesheet" type="text/css" href="{{url('assets/src/plugins/fancybox/dist/jquery.fancybox.css')}}" />
@endsection
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="title">
                                <h4>Category</h4>
                            </div>
                            <div class="text-end mb-4">
                                <a href="{{ route('admin.category.create') }}" class="btn btn-primary align-items-center d-inline-flex"><i
                                        class="ri-add-circle-fill"></i> Add Category</a>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Category
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
         $("#kendoGridProduct").kendoGrid({
        noRecords: {
            template: "No data available on current page.",
        },
        dataSource: {
            type: "json",
            transport: {
                read: web_url + "/admin/category/get",
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
                title: "Name", field : "name"
            },
            {
                title: "Slug",field : "slug"
            },
            {
                title: "Parent",
                template: function (params) {
                    console.log("params" , params)
                    return params.parent.name;
                },
            },
            {
                title: "Is filterable",
                template: function (params) {
                    return params.is_filterable;
                },
            },
            {
                title: "Status",
                template: function (params) {
                    return `<div class="form-check form-switch">
                                <input class="form-check-input change-status"  data-atr="${params.id}" type="checkbox" role="switch" id="flexSwitchCheckChecked" ${( params.status == 1 ) ? 'checked' : ''}>
                            </div>`;
                },
            },
            // {
            //     title: "Action/Edit",
            //     template: function (params) {
            //         let actionWrap = ``
            //         return actionWrap;
            //     },
            // },
    ]});
    $(document).on('change' , '.change-status' , function(){
        let id = $(this).data('atr')
        $.ajax({
                url: web_url + "/admin/category/status-update/"+id,
                type: "get",
                dataType: "json",
                statusCode: {
                    200: function (res) {
                        $('#kendoGridProduct').data('kendoGrid').dataSource.read({});
                    }
                }
        })
        
    });
    </script>
@endsection
    


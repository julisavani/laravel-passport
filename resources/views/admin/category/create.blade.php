@extends('admin.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ url('assets/src/plugins/fancybox/dist/jquery.fancybox.css') }}" />
    <link
			rel="stylesheet"
			type="text/css"
			href="{{url('assets/src/styles/main.css')}}"
		/>

    
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
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Profile
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <form enctype="multipart/form-data" action="{{route('admin.category.store')}}" method="post" id="my-form">
                    @csrf
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-8 col-sm-12 mb-30">
                            <div class="pd-20 card-box height-100-p">
                                <div class="profile-info">
                                        <ul class="profile-edit-list">
                                            <li class="weight-500 col-md-12">
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-md-2 col-form-label">Name</label>
                                                <div class="col-sm-12 col-md-10"> <input
                                                        class="form-control form-control-lg"
                                                        type="text" name="name"
                                                    /></div>
                                                    @if ($errors->has('name'))
                                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-md-2 col-form-label">Slug</label>
                                                    <div class="col-sm-12 col-md-10"><input
                                                        class="form-control form-control-lg"
                                                        type="text" name="slug" 
                                                    /></div>
                                                    @if ($errors->has('slug'))
                                                        <span class="text-danger">{{ $errors->first('slug') }}</span>
                                                    @endif
                                                </div>
                                              
                                                <div class="form-group row">
                                                    <label  class="col-sm-12 col-md-2 col-form-label">Parent</label>
                                                    <div  class="col-sm-12 col-md-10"> 
                                                        <select class="form-control" name="parent_id" >
                                                        <option>Select Parent</option>
                                                        @foreach ($category as $item)
                                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach
                                                        </select>
                                                        
                                                    </div>
                                                    @if ($errors->has('parent_id'))
                                                    <span class="text-danger">{{ $errors->first('parent_id') }}</span>
                                                @endif
                                                </div>
                                                <div class="form-group row">
                                                    <label  class="col-sm-12 col-md-2 col-form-label">Is filterable</label>
                                                <div  class="col-sm-12 col-md-10"> 
                                                    <select class="form-control"  name="is_filterable">
                                                        <option value="1">yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label  class="col-sm-12 col-md-2 col-form-label">Status</label>
                                                <div  class="col-sm-12 col-md-10"> 
                                                    <select class="form-control" name="status">
                                                        <option value="1">Active</option>
                                                        <option value="0">Deactive</option>
                                                    </select>
                                                </div>
                                                </div>
                                                <div class="form-group text-end mt-3 mb-0">
                                                    <input
                                                        type="submit"
                                                        class="btn btn-primary"
                                                        value="save"
                                                    />
                                                </div>
                                            </li>
                                        </ul>
                                </div>
                            </div>
                        </div>
                      
                    </div>
             </form>
            </div>
            
        </div>
    </div>
@endsection
@section('script')
    <!-- fancybox Popup Js -->
    <script src="{{ url('assets/vendors/scripts/layout-settings.js') }}"></script>
    <script src="{{ url('assets/src/plugins/dropzone/src/dropzone.js')}}"></script>
    {{-- <script src="{{ url('assets/js/dropzone.js')}}"></script> --}}
    <script src="{{ url('assets/src/scripts/multiple-uploader.js')}}"></script>
    <script src="{{ url('assets/js/jquery.menu-aim.js')}}"></script>
  
    <script src="{{ url('assets/src/plugins/fancybox/dist/jquery.fancybox.js') }}"></script>
    <script>
        
          new MultipleUploader('#preview-image').init({
            // maxUpload : 20, // maximum number of uploaded images
            maxSize:2, // in size in mb
            filesInpName:'preview_image', // input name sent to backend
            formSelector: '#my-form', // form selector
        });
          new MultipleUploader('#image').init({
            // maxUpload : 20, // maximum number of uploaded images
            maxSize:2, // in size in mb
            filesInpName:'image', // input name sent to backend
            formSelector: '#my-form', // form selector
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
                    data: function(response) {
                        return response.data;
                    },
                    total: function(response) {
                        return response.__count
                    }
                },
                change: function(e) {
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
            columns: [{
                    title: "Image",
                    template: function(params) {
                        return `<div class="chat-profile-photo"> <img src="${params.featured_image[0].original_url}"/> </div>`;
                    },
                },
                {
                    title: "Title",
                    field: "title"
                },
                {
                    title: "Category 1",
                    field: "category_1"
                },
                {
                    title: "Category 1",
                    field: "category_2"
                },
                {
                    title: "shop by metal",
                    field: "shop_by_shape"
                },
                {
                    title: "shop by material",
                    field: "shop_by_material"
                },
                {
                    title: "price",
                    field: "product_price"
                },
                {
                    title: "product price compared_at",
                    field: "product_price_compared_at"
                },
                {
                    title: "Status",
                    template: function(params) {
                        return `<div class="form-check form-switch">
                                <input class="form-check-input change-status"  data-atr="${params.id}" type="checkbox" role="switch" id="flexSwitchCheckChecked" ${( params.status == 1 ) ? 'checked' : ''}>
                            </div>`;
                    },
                },
                // { field: "name", title: "name" },
                // {
                //     title: "Action/Edit",
                //     template: function (params) {
                //         let actionWrap = ``
                //         return actionWrap;
                //     },
                // },
            ]
        });
        $(".item-detail").click(function (e) { 
         let name = $(".item-detail-input").val()
         if(name != ""){
                let html = `<div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">${name}</label>
                                <div class="col-sm-12 col-md-8">
                                    <input class="form-control" type="text" name="item-detail['${name}']">
                                </div>
                                <div class="col-sm-12 col-md-2">
                                    <a href="javascript:;" class="remove-task" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
                                </div>
                            </div>`;
                $(".item-detail-div").append(html);
                $(".item-detail-input").val("")
            }
        });
        $(".side-diamond").click(function (e) { 
         let name = $(".side-diamond-input").val()
         if(name != ""){
                let html = `<div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">${name}</label>
                                <div class="col-sm-12 col-md-8">
                                    <input class="form-control" type="text" name="side-diamond['${name}']">
                                </div>
                                <div class="col-sm-12 col-md-2">
                                    <a href="javascript:;" class="remove-task" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
                                </div>
                            </div>`;
                $(".side-diamond-div").append(html);
                $(".side-diamond-input").val("")
            }
        });
        $(".center-diamonnd").click(function (e) { 
         let name = $(".center-diamonnd-input").val()
         if(name != ""){
                let html = `<div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">${name}</label>
                                <div class="col-sm-12 col-md-8">
                                    <input class="form-control" type="text" name="center-diamonnd['${name}']">
                                </div>
                                <div class="col-sm-12 col-md-2">
                                    <a href="javascript:;" class="remove-task" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
                                </div>
                            </div>`;
                $(".center-diamonnd-div").append(html);
                $(".center-diamonnd-input").val("")
            }
        });
    </script>
@endsection

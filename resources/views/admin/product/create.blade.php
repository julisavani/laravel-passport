@extends('admin.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ url('assets/src/plugins/fancybox/dist/jquery.fancybox.css') }}" />
    <link
			rel="stylesheet"
			type="text/css"
			href="{{url('assets/src/styles/main.css')}}"
		/>
        <link
        rel="stylesheet"
        type="text/css"
        href="{{url('assets/css/reset.css')}}"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        ul {
            list-style: none;
            padding-left: 0;
        }

        .menu-list li {
            display: flex;
        }

        .menu-list li input {
            margin-right: 10px;
        }

        .menu-list li label {
            cursor: pointer;
        }

        a {
            text-decoration: none;
            color: #000;
        }
    </style>
@endsection
@section('content')
    <div class="main-container">
        <form enctype="multipart/form-data"  id="my-form">
            <input name="id" type="hidden" value="{{$data['product']['id']}}" />
            @csrf
            <div class="pd-ltr-20 xs-pd-20-10">
                <div class="min-height-200px">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="title">
                                    <h4>Product</h4>
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
                    @csrf
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-8 col-sm-12 mb-30">
                                <div class="pd-20 card-box height-100-p">
                                    <div class="profile-info">
                                            <ul class="profile-edit-list">
                                                <li class="weight-500 col-md-12">
                                                    <div class="form-group row">
                                                        <label class="col-sm-12 col-md-2 col-form-label">Title</label>
                                                    <div class="col-sm-12 col-md-10"> <input
                                                            class="form-control form-control-lg" value="{{$data['product']['title']??""}}"
                                                            type="text" name="title"
                                                        /></div>
                                                        @if ($errors->has('title'))
                                                            <span class="text-danger">{{ $errors->first('title') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-12 col-md-2 col-form-label">caption</label>
                                                        <div class="col-sm-12 col-md-10"><input
                                                            class="form-control form-control-lg" value="{{$data['product']['caption']??""}}"
                                                            type="text" name="caption" 
                                                        /></div>
                                                        @if ($errors->has('caption'))
                                                            <span class="text-danger">{{ $errors->first('caption') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-12 col-md-2 col-form-label">Price</label>
                                                        <div class="col-sm-12 col-md-10"><input
                                                            class="form-control form-control-lg" 
                                                            type="text" name="product_price"
                                                            value="{{$data['product']['product_price']??""}}"
                                                        /></div>
                                                        @if ($errors->has('product_price'))
                                                            <span class="text-danger">{{ $errors->first('product_price') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group row ">
                                                        <label class="col-sm-12 col-md-2 col-form-label">Discount Price</label>
                                                        <div class="col-sm-12 col-md-10"><input
                                                            class="form-control form-control-lg"
                                                            type="text" name="discount_price"
                                                        /></div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label  class="col-sm-12 col-md-2 col-form-label">Category</label>
                                                        <div  class="col-sm-12 col-md-10"> 
                                                            <select class="form-control change-category" name="category" >
                                                            <option>Select category</option>
                                                            @foreach ($category as $item)
                                                                <option value="{{$item->id}}" @php echo ($data['product']['title']??"" == $item->id) ? "selected" : ""  @endphp  >{{$item->name}}</option>
                                                            @endforeach
                                                            </select>
                                                        </div>
                                                        @if ($errors->has('category'))
                                                        <span class="text-danger">{{ $errors->first('category') }}</span>
                                                    @endif
                                                    </div>
                                                    <div class="form-group row">
                                                        <label  class="col-sm-12 col-md-2 col-form-label">Status</label>
                                                    <div  class="col-sm-12 col-md-10"> <select
                                                            class="selectpicker form-control form-control-lg"
                                                            data-style="btn-outline-secondary btn-lg"
                                                            title="Not Chosen" name="status"
                                                        >
                                                            <option value="1">Active</option>
                                                            <option value="0">Deactive</option>
                                                        </select>
                                                    </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-12 col-md-2 col-form-label">Preview image</label>
                                                        <div class="multiple-uploader" id="preview-image">
                                                           
                                                            @if($type == 2)
                                                                <div class="mup-msg">
                                                                    <span class="mup-main-msg"></span>
                                                                    {{-- <span class="mup-msg" id="max-upload-number">Upload up to 10 images</span> --}}
                                                                    {{-- <span class="mup-msg">Only images, pdf and psd files are allowed for upload</span>  --}}
                                                                </div>
                                                                <div class="image-container" data-image-index="0" id="mup-image-0" data-acceptable-image="1">
                                                                    <div class="image-size"> 46.7 KB </div>
                                                                    @foreach ($data['preview_media_arr'] as $item)
                                                                    <img src="{{$item}}" class="image-preview" alt="">
                                                                        
                                                                    @endforeach
                                                                </div>
                                                                @else
                                                                    <div class="mup-msg">
                                                                        <span class="mup-main-msg">click to upload images.</span>
                                                                        {{-- <span class="mup-msg" id="max-upload-number">Upload up to 10 images</span> --}}
                                                                        {{-- <span class="mup-msg">Only images, pdf and psd files are allowed for upload</span>  --}}
                                                                    </div>
                                                                @endif
                                                        </div>
                                                        @if ($errors->has('preview_image'))
                                                            <span class="text-danger">{{ $errors->first('preview-image') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-12 col-md-2 col-form-label">image</label>
                                                        <div class="multiple-uploader" id="image">
                                                            {{-- @php dd($data['media_arr']); @endphp --}}
                                                            @if($type == 2)
                                                            <div class="mup-msg">
                                                                <span class="mup-main-msg"></span>
                                                                {{-- <span class="mup-msg" id="max-upload-number">Upload up to 10 images</span> --}}
                                                                {{-- <span class="mup-msg">Only images, pdf and psd files are allowed for upload</span>  --}}
                                                            </div>
                                                            @foreach ($data['media_arr'] as $item)
                                                                <div class="image-container" data-image-index="0" id="mup-image-0" data-acceptable-image="1">
                                                                    <div class="image-size"> 46.7 KB </div>
                                                                    <img src="{{$item}}" class="image-preview" alt="">
                                                                </div>
                                                            @endforeach
                                                            @else
                                                                <div class="mup-msg">
                                                                    <span class="mup-main-msg">click to upload images.</span>
                                                                    {{-- <span class="mup-msg" id="max-upload-number">Upload up to 10 images</span> --}}
                                                                    {{-- <span class="mup-msg">Only images, pdf and psd files are allowed for upload</span>  --}}
                                                                </div>
                                                            @endif
                                                        </div>
                                                        @if ($errors->has('image'))
                                                            <span class="text-danger">{{ $errors->first('image') }}</span>
                                                        @endif
                                                    </div>
                                                </li>
                                            </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-30">
                                <div class="card-box height-100-p overflow-hidden">
                                    <div class="profile-tab height-100-p">
                                        <div class="tab height-100-p">
                                            <ul class="nav nav-tabs customtab" role="tablist">
                                                <li class="nav-item">
                                                    <a
                                                        class="nav-link active"
                                                        data-toggle="tab"
                                                        href="#item-detail"
                                                        role="tab"
                                                        >Item Detail</a
                                                    >
                                                </li>
                                                <li class="nav-item">
                                                    <a
                                                        class="nav-link"
                                                        data-toggle="tab"
                                                        href="#center-diamonnd-detail"
                                                        role="tab"
                                                        >Center diamond detail</a
                                                    >
                                                </li>
                                                <li class="nav-item">
                                                    <a
                                                        class="nav-link"
                                                        data-toggle="tab"
                                                        href="#side-diamond-detail"
                                                        role="tab"
                                                        >Side diamond detail</a
                                                    >
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <!-- Timeline Tab start -->
                                            
                                                <div
                                                    class="tab-pane fade show active"
                                                    id="item-detail"
                                                    role="tabpanel" >
                                                    <div class="pd-20 mb-30">
                                                        <div class="item-detail-div">
                                                            @if ($type == 1)
                                                            <div class="form-group row  item-detail-0">
                                                                <label class="col-sm-12 col-md-2 col-form-label">SKU</label>
                                                                <div class="col-sm-12 col-md-8">
                                                                    <input class="form-control" type="text" name="item-detail[SKU]" >
                                                                </div>
                                                                <div class="col-sm-12 col-md-2">
                                                                <a href="javascript:;" class="remove-task" data-atr="0" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row item-detail-1">
                                                                <label class="col-sm-12 col-md-2 col-form-label">Style</label>
                                                                <div class="col-sm-12 col-md-8">
                                                                    <input class="form-control" type="text" name="item-detail[Style]">
                                                                </div>

                                                                <div class="col-sm-12 col-md-2">
                                                                    <a href="javascript:;" class="remove-task" data-atr="1" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
                                                                    </div>
                                                            </div>
                                                            <div class="form-group row item-detail-2">
                                                                <label class="col-sm-12 col-md-2 col-form-label">Making Process</label>
                                                                <div class="col-sm-12 col-md-8">
                                                                    <input class="form-control" type="text" name="item-detail[Making Process]">
                                                                </div>
                                                                <div class="col-sm-12 col-md-2">
                                                                    <a href="javascript:;" class="remove-task" data-atr="2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
                                                                </div>

                                                            </div>
                                                            <div class="form-group row item-detail-3">
                                                                <label class="col-sm-12 col-md-2 col-form-label">Rhodium Plated</label>
                                                                <div class="col-sm-12 col-md-8">
                                                                    <input class="form-control" type="text" name="item-detail[Rhodium Plated]"  >
                                                                </div>
                                                                <div class="col-sm-12 col-md-2">
                                                                    <a href="javascript:;" class="remove-task"  data-atr="3" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row item-detail-4">
                                                                <label class="col-sm-12 col-md-2 col-form-label">Carat Total Weight</label>
                                                                <div class="col-sm-12 col-md-8">
                                                                    <input class="form-control" type="text" name="item-detail[Carat Total Weight]" >
                                                                </div>
                                                                <div class="col-sm-12 col-md-2">
                                                                    <a href="javascript:;" class="remove-task"  data-atr="4"  data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row item-detail-5">
                                                                <label class="col-sm-12 col-md-2 col-form-label">Metal Type & Color</label>
                                                                <div class="col-sm-12 col-md-8">
                                                                    <input class="form-control" type="text" name="item-detail[Metal Type & Color]" >
                                                                </div>
                                                                <div class="col-sm-12 col-md-2">
                                                                    <a href="javascript:;" class="remove-task"   data-atr="5"   data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
                                                                </div>
                                                            </div>
                                                            @else
                                                            @php $item_detail = json_decode($data['product']['item_detail']);
                                                            $count = 0;
                                                            @endphp
                                                            @foreach ($item_detail as $k=>$item)
                                                            <div class="form-group row item-detail-{{$count}}">
                                                                <label class="col-sm-12 col-md-2 col-form-label">{{$k}}</label>
                                                                <div class="col-sm-12 col-md-8">
                                                                    <input class="form-control" type="text" name="item-detail[{{$k}}]" value="{{$item}}" >
                                                                </div>
                                                                <div class="col-sm-12 col-md-2">
                                                                    <a href="javascript:;" class="remove-task"   data-atr="{{$count}}"   data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
                                                                </div>
                                                            </div>
                                                            @php $count++; @endphp
                                                            @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="form-group row  ">
                                                            <label class="col-sm-12 col-md-2 col-form-label"></label>
                                                            <div class="col-sm-12 col-md-8">
                                                                <input class="form-control item-detail-input" type="text" >
                                                            </div>
                                                            <div class="col-sm-12 col-md-2">
                                                                <a href="task-add" data-toggle="modal"   data-target="#task-add" class="item-detail bg-light-blue btn text-blue weight-500"><i class="ion-plus-round"></i> Add</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Timeline Tab End -->
                                                <!-- Tasks Tab start -->
                                                <div class="tab-pane fade" id="center-diamonnd-detail" role="tabpanel">
                                                    <div class="pd-20 profile-task-wrap mb-30">
                                                        <div class="center-diamond-div">
                                                            @if ($type == 1)
                                                            <div class="form-group row center-diamonnd-detail-0">
                                                                <label class="col-sm-2 col-md-2 col-form-label">IGI</label>
                                                                <div class="col-sm-12 col-md-8">
                                                                    <input class="form-control" type="text" name="center-diamond[IGI]" >
                                                                </div>
                                                                <div class="col-sm-12 col-md-2">
                                                                    <a href="javascript:;" class="remove-task" data-atr="0" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row center-diamonnd-detail-1">
                                                                <label class="col-sm-12 col-md-2 col-form-label">Color</label>
                                                                <div class="col-sm-12 col-md-8">
                                                                    <input class="form-control" type="text" name="center-diamond[Color]">
                                                                </div>
                                                                <div class="col-sm-12 col-md-2">
                                                                    <a href="javascript:;" class="remove-task"  data-atr="1" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row center-diamonnd-detail-2">
                                                                <label class="col-sm-12 col-md-2 col-form-label">Count</label>
                                                                <div class="col-sm-12 col-md-8">
                                                                    <input class="form-control" type="text" name="center-diamond[Count]" >
                                                                </div>
                                                                <div class="col-sm-12 col-md-2">
                                                                    <a href="javascript:;" class="remove-task" data-atr="2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row center-diamonnd-detail-3">
                                                                <label class="col-sm-12 col-md-2 col-form-label">Shape</label>
                                                                <div class="col-sm-12 col-md-8">
                                                                    <input class="form-control" type="text" name="center-diamond[Shape]">
                                                                </div>
                                                                <div class="col-sm-12 col-md-2">
                                                                    <a href="javascript:;" class="remove-task" data-atr="3"  data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row center-diamonnd-detail-4">
                                                                <label class="col-sm-12 col-md-2 col-form-label">Clarity</label>
                                                                <div class="col-sm-12 col-md-8">
                                                                    <input class="form-control" type="text"  name="center-diamond[Clarity]"> 
                                                                </div>
                                                                <div class="col-sm-12 col-md-2">
                                                                    <a href="javascript:;" class="remove-task" data-atr="4" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row center-diamonnd-detail-5">
                                                                <label class="col-sm-12 col-md-2 col-form-label">Setting</label>
                                                                <div class="col-sm-12 col-md-8">
                                                                    <input class="form-control" type="text"  name="center-diamond[Setting]" >
                                                                </div>
                                                                <div class="col-sm-12 col-md-2">
                                                                    <a href="javascript:;" class="remove-task" data-atr="5" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row center-diamonnd-detail-6">
                                                                <label class="col-sm-12 col-md-2 col-form-label">Cut Grade</label>
                                                                <div class="col-sm-12 col-md-8">
                                                                    <input class="form-control" type="text" name="center-diamond[Cut Grade]">
                                                                </div>
                                                                <div class="col-sm-12 col-md-2">
                                                                    <a href="javascript:;" class="remove-task" data-atr="6" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row center-diamonnd-detail-7">
                                                                <label class="col-sm-12 col-md-2 col-form-label">Stone Type</label>
                                                                <div class="col-sm-12 col-md-8">
                                                                    <input class="form-control" type="text"  name="center-diamond[Stone Type]">
                                                                </div>
                                                                <div class="col-sm-12 col-md-2">
                                                                    <a href="javascript:;" class="remove-task" data-atr="7" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row center-diamonnd-detail-8">
                                                                <label class="col-sm-12 col-md-2 col-form-label">Total Carat Weight</label>
                                                                <div class="col-sm-12 col-md-8">
                                                                    <input class="form-control" type="text" name="center-diamond[Total Carat Weight]" >
                                                                </div>
                                                                <div class="col-sm-12 col-md-2">
                                                                    <a href="javascript:;" class="center-diamonnd-remove-task" data-atr="8" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
                                                                </div>
                                                            </div>
                                                            @else
                                                            @php $item_detail = json_decode($data['product']['item_detail']);
                                                            $jcount = 0;
                                                            @endphp
                                                            @foreach ($item_detail as $k=>$item)
                                                            <div class="form-group row center-diamonnd-detail-{{$jcount}}">
                                                                <label class="col-sm-12 col-md-2 col-form-label">{{$k}}</label>
                                                                <div class="col-sm-12 col-md-8">
                                                                    <input class="form-control" type="text" name="center-diamond[{{$k}}]" value="{{$item}}" >
                                                                </div>
                                                                <div class="col-sm-12 col-md-2">
                                                                    <a href="javascript:;" class="center-diamonnd-remove-task" data-atr="{{$jcount}}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
                                                                </div>
                                                            </div> 
                                                            @php $jcount++; @endphp
                                                            @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-12 col-md-2 col-form-label"></label>
                                                            <div class="col-sm-12 col-md-8">
                                                                <input class="form-control center-diamonnd-input" type="text" >
                                                            </div>
                                                            <div class="col-sm-12 col-md-2">
                                                                <a href="task-add" data-toggle="modal" data-target="#task-add" class="center-diamond bg-light-blue btn text-blue weight-500"><i class="ion-plus-round"></i>Add</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Tasks Tab End -->
                                                <!-- Setting Tab start -->
                                                <div
                                                    class="tab-pane fade height-100-p"
                                                    id="side-diamond-detail"
                                                    role="tabpanel">
                                                    <div class="profile-setting">
                                                        <div class="pd-20 mb-30">
                                                            <div class="side-diamond-div  ">
                                                                @if ($type == 1)
                                                                <div class="form-group row side-diamond-detail-0">
                                                                    <label class="col-sm-12 col-md-2 col-form-label">Color</label>
                                                                    <div class="col-sm-12 col-md-8">
                                                                        <input class="form-control" type="text" name="side-diamond[Color]">
                                                                    </div>
                                                                    <div class="col-sm-12 col-md-2">
                                                                        <a href="javascript:;" class="remove-task" data-atr="0" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row side-diamond-detail-1">
                                                                    <label class="col-sm-12 col-md-2 col-form-label">Count</label>
                                                                    <div class="col-sm-12 col-md-8">
                                                                        <input class="form-control" type="text" name="side-diamond[Count]">
                                                                    </div>
                                                                    <div class="col-sm-12 col-md-2">
                                                                        <a href="javascript:;" class="remove-task"  data-atr="1" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row side-diamond-detail-2">
                                                                    <label class="col-sm-12 col-md-2 col-form-label">Shape</label>
                                                                    <div class="col-sm-12 col-md-8">
                                                                        <input class="form-control" type="text" data-atr="2"  name="side-diamond[Shape]" >
                                                                    </div>
                                                                    <div class="col-sm-12 col-md-2">
                                                                        <a href="javascript:;" class="remove-task" data-atr="2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row side-diamond-detail-3">
                                                                    <label class="col-sm-12 col-md-2 col-form-label">Clarity</label>
                                                                    <div class="col-sm-12 col-md-8">
                                                                        <input class="form-control" type="text" name="side-diamond[Clarity]">
                                                                    </div>
                                                                    <div class="col-sm-12 col-md-2">
                                                                        <a href="javascript:;" class="remove-task" data-atr="3"  data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row side-diamond-detail-4">
                                                                    <label class="col-sm-12 col-md-2 col-form-label">Setting</label>
                                                                    <div class="col-sm-12 col-md-8">
                                                                        <input class="form-control" type="text" name="side-diamond[Setting]">
                                                                    </div>
                                                                    <div class="col-sm-12 col-md-2">
                                                                        <a href="javascript:;" class="remove-task"  data-atr="4"   data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row side-diamond-detail-5">
                                                                    <label class="col-sm-12 col-md-2 col-form-label">Cut Grade</label>
                                                                    <div class="col-sm-12 col-md-8">
                                                                        <input class="form-control" type="text" name="side-diamond[Cut Grade]" >
                                                                    </div>
                                                                    <div class="col-sm-12 col-md-2">
                                                                        <a href="javascript:;" class="remove-task"  data-atr="5"  data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row side-diamond-detail-6">
                                                                    <label class="col-sm-12 col-md-2 col-form-label">Stone Type</label>
                                                                    <div class="col-sm-12 col-md-8">
                                                                        <input class="form-control" type="text" name="side-diamond[Stone Type]">
                                                                    </div>
                                                                    <div class="col-sm-12 col-md-2">
                                                                        <a href="javascript:;" class="remove-task" data-atr="6"   data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row side-diamond-detail-7">
                                                                    <label class="col-sm-12 col-md-2 col-form-label">Total Carat Weight</label>
                                                                    <div class="col-sm-12 col-md-8">
                                                                        <input class="form-control" type="text"  name="side-diamond[Total Carat Weight]">
                                                                    </div>
                                                                    <div class="col-sm-12 col-md-2">
                                                                        <a href="javascript:;" class="side-diamond-remove-task"  data-atr="7"  data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
                                                                    </div>
                                                                </div>
                                                                @else
                                                                @php $item_detail = json_decode($data['product']['item_detail']);
                                                                $kcount = 0;
                                                                @endphp
                                                                @foreach ($item_detail as $k=>$item)
                                                                <div class="form-group row side-diamond-detail-{{$kcount}}">
                                                                    <label class="col-sm-12 col-md-2 col-form-label">{{$k}}</label>
                                                                    <div class="col-sm-12 col-md-8">
                                                                        <input class="form-control" type="text"  name="side-diamond[{{$k}}]" value="{{$item}}">
                                                                    </div>
                                                                    <div class="col-sm-12 col-md-2">
                                                                        <a href="javascript:;" class="side-diamond-remove-task"  data-atr="{{$kcount}}"  data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
                                                                    </div>
                                                                </div>
                                                                @php $kcount++; @endphp
                                                                @endforeach
                                                                @endif
                                                            </div>
                                                            <div class="form-group row side-diamond-detail-8">
                                                                <label class="col-sm-12 col-md-2 col-form-label"></label>
                                                                <div class="col-sm-12 col-md-8">
                                                                    <input class="form-control side-diamond-input" type="text" >
                                                                </div>
                                                                <div class="col-sm-12 col-md-2">
                                                                    <a href="task-add" data-toggle="modal"  data-atr="8" data-target="#task-add" class="side-diamond bg-light-blue btn text-blue weight-500"><i class="ion-plus-round"></i> Add</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Setting Tab End -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="form-group mt-3 mb-0">
                                <input
                                    type="submit"
                                    class="btn btn-primary"
                                    value="save"
                                />
                            </div>
                        </div>
                
                </div>
            </div>
        </form>
        <div class="modal fade bd-example-modal-lg" tabindex="-1" id="category_modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-body"  id="modal-container">
                    </div>
                </div>
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
    <script src="{{ url('assets/src/plugins/fancybox/dist/jquery.fancybox.js') }}"></script>
    <script>
     
         $(document).ready(function () {
              $(document).on("click" , '.remove-task' , function() {
                let id = $(this).data('atr')
                $(`.item-detail-${id}`).remove()
            })
            $(document).on("click" , '.side-diamond-remove-task' , function() {
                let id = $(this).data('atr')
                $(`.side-diamond-detail-${id}`).remove()
            })
            $(document).on("click" , '.center-diamonnd-remove-task' , function() {
                let id = $(this).data('atr')
                $(`.center-diamonnd-detail-${id}`).remove()
            })
            $("#my-form").submit(function (e) { 
            event.preventDefault();
            var form = $('#my-form')[0];
                var token = $('meta[name="csrf-token"]').attr("content");
                var data = new FormData(form);
                let arr = []
                $(".form-check:checked").each(function (index, element) {
                    arr.push($(this).val())
                });
                data.append("category_arr", arr);
                
                $.ajax({
                    enctype: 'multipart/form-data',
                    url: web_url + "/admin/product/store",
                    processData: false, 
                    contentType: false,
                    type: "post",
                    data : data,
                    dataType: "json",
                    statusCode: {
                        200: function (xhr) {
                            $.toast({
                                heading: "success",
                                text: xhr.data.message,
                                position: "top-right",
                                icon: "success",
                                position: {
                                    right: 10,
                                    top: 90,
                                },
                            });
                            window.location.href = web_url + "/admin/product"; 
                        }
                    },
                    error: function (xhr) {
                        console.log("xhr.responseJSON.error." , xhr.responseJSON.error)
                        var result = xhr.responseJSON.error.filter(obj => {
                            // if( $(`input[name="${obj.name}"]`).val() == "" || ){
                                $.each(xhr.responseJSON.error, function (indexInArray, valueOfElement) { 
                                    showerror(valueOfElement.message);
                                });
                            // }
                        })
                    },
                 })
            });
        }); 
    
        $(".change-category").change(function (e) { 
            $(".form-check").prop('checked' , false)
           let id = $(this).val()
                $.ajax({
                    url: `${web_url}/admin/product/get-category-data/${id}?product_id=${$("input[name='id']").val()}`,
                    type: "get",
                    dataType: "html",
                    statusCode: {
                        200: function (res) {
                            $("#modal-container").html(res)
                            $('#category_modal').modal('show');
                        }
                    }
                 })
        })
          new MultipleUploader('#preview-image').init({
            // maxUpload : 20, // maximum number of uploaded images
            // maxSize:2, // in size in mb
            filesInpName:'preview_image', // input name sent to backend
            formSelector: '#my-form', // form selector
        });
          new MultipleUploader('#image').init({
            // maxUpload : 20, // maximum number of uploaded images
            // maxSize:2, // in size in mb
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
            let Count = $(".item-detail-div").find('.form-group').length
            console.log("count" , Count)
            let name = $(".item-detail-input").val()
            if(name != ""){
                    let html = `<div class="form-group row item-detail-${Count}">
                                    <label class="col-sm-12 col-md-2 col-form-label">${name}</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input class="form-control" type="text" name="item-detail['${name}']">
                                    </div>
                                    <div class="col-sm-12 col-md-2">
                                        <a href="javascript:;" class="remove-task" data-atr="${Count}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
                                    </div>
                                </div>`;
                    $(".item-detail-div").append(html);
                    $(".item-detail-input").val("")
                }
        });
        $(".side-diamond").click(function (e) { 
        let Count = $(".item-detail-div").find('.form-group').length
        console.log("count" , Count)
         let name = $(".side-diamond-input").val()
         if(name != ""){
                let html = `<div class="form-group row center-diamond side-diamond-detail-${Count}">
                                <label class="col-sm-12 col-md-2 col-form-label">${name}</label>
                                <div class="col-sm-12 col-md-8">
                                    <input class="form-control" type="text" name="side-diamond['${name}']">
                                </div>
                                <div class="col-sm-12 col-md-2">
                                    <a href="javascript:void(0);" class="side-diamond-remove-task" data-atr="${Count}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
                                </div>
                            </div>`;
                $(".side-diamond-div").append(html);
                $(".side-diamond-input").val("")
            }
        });
        $(".center-diamond").click(function (e) { 
        let Count = $(".item-detail-div").find('.form-group').length
        console.log("count" , Count)
         let name = $(".center-diamonnd-input").val()
         if(name != ""){
                let html = `<div class="form-group row  center-diamonnd-detail-${Count} ">
                                <label class="col-sm-12 col-md-2 col-form-label">${name}</label>
                                <div class="col-sm-12 col-md-8">
                                    <input class="form-control" type="text" name="center-diamonnd['${name}']">
                                </div>
                                <div class="col-sm-12 col-md-2">
                                    <a href="javascript:void(0);" class="center-diamonnd-remove-task" data-atr="${Count}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
                                </div>
                            </div>`;
                $(".center-diamond-div").append(html);
                $(".center-diamonnd-input").val("")
            }
        });
        function showerror(message) {
            $.toast({
                heading: "error",
                text: message,
                position: "top-right",
                icon: "error",
                position: {
                    right: 10,
                    top: 90,
                },
            });
        }
    </script>
    
@endsection

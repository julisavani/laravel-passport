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
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Orders</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Orders
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Simple Datatable start -->
                <div class="card-box mb-30 pd-20">
                    <div class="pb-20">
                        <table class="data-table table stripe hover nowrap">
                            <thead> 
                                <tr>
                                    <th class="table-plus datatable-nosort">Order No</th>
                                    <th>Customer</th>
                                    <th>Order Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order as $item)
                                    <tr>
                                        <td class="table-plus">{{ $item['code'] }}</td>
                                        <td class="table-plus">{{ $item['user']['first_name'] }}</td>
                                        <td> {{ date('Y-m-d', strtotime($item['updated_at'])) }}</td>
                                        <td>{{ $item['status'] == 1 ? 'Active' : 'Deactive' }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <a class="dropdown-item" href="#"
                                                ><i class="dw dw-eye"></i> View</a>
                                                    {{-- <a class="dropdown-item edit-prompt" data-id="{{ $item['id'] }}"  type="button"><i
                                                            class="dw dw-edit2"></i> Edit </a> --}}
                                                   
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
@endsection
    


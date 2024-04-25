

<div class="container">
        <div class="row gx-lg-5">
            <div class="col-md-12">
                <div class="row">
                    @foreach ($level1 as $l1)
                        <div class="col-md-3">
                            <div class="d-flex">
                                <input class="form-check" @php echo (in_array( $l1['id'] , $categoryId)) ? 'checked' : ''  @endphp  name="category_arr[]" value="{{$l1['id']}}"  type="checkbox" id="@php echo str_replace(' ', '', $l1['name']).'_'.$l1['id'] @endphp" />
                                <label class="pl-2" for="@php echo str_replace(' ', '', $l1['name']).'_'.$l1['id'] @endphp"> <h5 class="mb-3 fw-bold">{{$l1['name']}}</h5></lable>
                                </div>
                            <ul class="menu-list">
                                @foreach ($l1['level2'] as $l2)
                                <li>
                                    <input class="form-check" @php echo (in_array( $l2['id'] , $categoryId)) ? 'checked' : ''  @endphp  name="category_arr[]" value="{{$l2['id']}}" type="checkbox" id="@php echo str_replace(' ', '', $l2['name']).'_'.$l2['id'] @endphp" />
                                    <label for="@php echo str_replace(' ', '', $l2['name']).'_'.$l2['id']  @endphp">{{$l2['name']}}</label>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

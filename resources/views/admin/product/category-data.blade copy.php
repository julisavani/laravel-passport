<div class="cd-dropdown-wrapper">
    <a class="cd-dropdown-trigger" href="#0">Dropdown</a>
    <nav class="cd-dropdown">
        <h2>Title</h2>
        <a href="#0" class="cd-close">Close</a>
        {{-- <div id="category-navbar"></div> --}}
        <ul class="cd-dropdown-content">
            @foreach ($navbarArr as $level1)
           <li class="has-children">
                <a href="javascriot:void(0)">{{$level1['name']}}</a>
                <ul class="cd-secondary-dropdown is-hidden">
                    @foreach ($level1['level1'] as $l1=>$level2)
                    <li class="has-children">
                        <a href="javascriot:void(0)">
                            <div class="custom-control custom-checkbox mb-5">
                                <input type="checkbox" class="custom-control-input"  id="{{$l1}}_{{$level2['name']}}">
                                <label class="custom-control-label" for="{{$l1}}_{{$level2['name']}}">{{$level2['name']}}</label>
                            </div> 
                        </a>
                      
                        <ul class="is-hidden">
                            @foreach ($level2['level2'] as $l3=>$level3)
                            <li class="has-children">
                                <a href="javascriot:void(0)">
                                    <div class="custom-control custom-checkbox mb-5">
                                        <input type="checkbox" class="custom-control-input" id="{{$l3}}_{{$level3['name']}}">
                                        <label class="custom-control-label" for="{{$l3}}_{{$level3['name']}}"> {{$level3['name']}}</label>
                                    </div> 
                                 </a>
                                    <ul class="is-hidden">
                                            <li class="go-back"><a href="#0"></a></li>
                                        @foreach ($level3['level3'] as $f=>$final)
                                            <li>
                                              <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input" id="{{$f}}_{{$level3['name']}}">
                                                    <label class="custom-control-label" for="{{$f}}_{{$level3['name']}}">{{$level3['name']}}</label>
                                                </div> 
                                                <a href="http://codyhouse.co/?p=748">{{$final['name']}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                            
                        </ul>
                    </li>
        
                    @endforeach
                </ul> <!-- .cd-secondary-dropdown -->
            </li> <!-- .has-children -->
            @endforeach
         
        </ul> <!-- .cd-dropdown-content -->
     
    </nav> <!-- .cd-dropdown -->
</div> <!-- .cd-dropdown-wrapper -->

<ul class="cd-dropdown-content">
    <li>
        <form class="cd-search">
            <input type="search" placeholder="Search...">
        </form>
    </li>
    <li class="has-children">
        <a href="javascriot:void(0)">Clothing</a>

        <ul class="cd-secondary-dropdown is-hidden">
            <li class="go-back"><a href="#0">Menu</a></li>
            <li class="see-all"><a href="http://codyhouse.co/?p=748">All Clothing</a></li>
            <li class="has-children">
                <a href="http://codyhouse.co/?p=748">Accessories</a>

                <ul class="is-hidden">
                    <li class="go-back"><a href="#0">Clothing</a></li>
                    <li class="see-all"><a href="http://codyhouse.co/?p=748">All Accessories</a></li>
                    <li class="has-children">
                        <a href="#0">Beanies</a>

                        <ul class="is-hidden">
                            <li class="go-back"><a href="#0">Accessories</a></li>
                            <li class="see-all"><a href="http://codyhouse.co/?p=748">All Benies</a></li>
                            <li><a href="http://codyhouse.co/?p=748">Caps &amp; Hats</a></li>
                            <li><a href="http://codyhouse.co/?p=748">Gifts</a></li>
                            <li><a href="http://codyhouse.co/?p=748">Scarves &amp; Snoods</a></li>
                        </ul>
                    </li>
                    <li class="has-children">
                        <a href="#0">Caps &amp; Hats</a>

                        <ul class="is-hidden">
                            <li class="go-back"><a href="#0">Accessories</a></li>
                            <li class="see-all"><a href="http://codyhouse.co/?p=748">All Caps &amp; Hats</a></li>
                            <li><a href="http://codyhouse.co/?p=748">Beanies</a></li>
                            <li><a href="http://codyhouse.co/?p=748">Caps</a></li>
                            <li><a href="http://codyhouse.co/?p=748">Hats</a></li>
                        </ul>
                    </li>
                    <li><a href="http://codyhouse.co/?p=748">Glasses</a></li>
                    <li><a href="http://codyhouse.co/?p=748">Gloves</a></li>
                    <li><a href="http://codyhouse.co/?p=748">Jewellery</a></li>
                    <li><a href="http://codyhouse.co/?p=748">Scarves</a></li>
                </ul>
            </li>

            <li class="has-children">
                <a href="http://codyhouse.co/?p=748">Bottoms</a>

                <ul class="is-hidden">
                    <li class="go-back"><a href="#0">Clothing</a></li>
                    <li class="see-all"><a href="http://codyhouse.co/?p=748">All Bottoms</a></li>
                    <li><a href="http://codyhouse.co/?p=748">Casual Trousers</a></li>
                    <li class="has-children">
                        <a href="#0">Jeans</a>

                        <ul class="is-hidden">
                            <li class="go-back"><a href="#0">Bottoms</a></li>
                            <li class="see-all"><a href="http://codyhouse.co/?p=748">All Jeans</a></li>
                            <li><a href="http://codyhouse.co/?p=748">Ripped</a></li>
                            <li><a href="http://codyhouse.co/?p=748">Skinny</a></li>
                            <li><a href="http://codyhouse.co/?p=748">Slim</a></li>
                            <li><a href="http://codyhouse.co/?p=748">Straight</a></li>
                        </ul>
                    </li>
                    <li><a href="#0">Leggings</a></li>
                    <li><a href="#0">Shorts</a></li>
                </ul>
            </li>

            <li class="has-children">
                <a href="http://codyhouse.co/?p=748">Jackets</a>

                <ul class="is-hidden">
                    <li class="go-back"><a href="#0">Clothing</a></li>
                    <li class="see-all"><a href="http://codyhouse.co/?p=748">All Jackets</a></li>
                    <li><a href="http://codyhouse.co/?p=748">Blazers</a></li>
                    <li><a href="http://codyhouse.co/?p=748">Bomber jackets</a></li>
                    <li><a href="http://codyhouse.co/?p=748">Denim Jackets</a></li>
                    <li><a href="http://codyhouse.co/?p=748">Duffle Coats</a></li>
                    <li><a href="http://codyhouse.co/?p=748">Leather Jackets</a></li>
                    <li><a href="http://codyhouse.co/?p=748">Parkas</a></li>
                </ul>
            </li>

            <li class="has-children">
                <a href="http://codyhouse.co/?p=748">Tops</a>

                <ul class="is-hidden">
                    <li class="go-back"><a href="#0">Clothing</a></li>
                    <li class="see-all"><a href="http://codyhouse.co/?p=748">All Tops</a></li>
                    <li><a href="http://codyhouse.co/?p=748">Cardigans</a></li>
                    <li><a href="http://codyhouse.co/?p=748">Coats</a></li>
                    <li><a href="http://codyhouse.co/?p=748">Polo Shirts</a></li>
                    <li><a href="http://codyhouse.co/?p=748">Shirts</a></li>
                    <li class="has-children">
                        <a href="#0">T-Shirts</a>

                        <ul class="is-hidden">
                            <li class="go-back"><a href="#0">Tops</a></li>
                            <li class="see-all"><a href="http://codyhouse.co/?p=748">All T-shirts</a></li>
                            <li><a href="http://codyhouse.co/?p=748">Plain</a></li>
                            <li><a href="http://codyhouse.co/?p=748">Print</a></li>
                            <li><a href="http://codyhouse.co/?p=748">Striped</a></li>
                            <li><a href="http://codyhouse.co/?p=748">Long sleeved</a></li>
                        </ul>
                    </li>
                    <li><a href="http://codyhouse.co/?p=748">Vests</a></li>
                </ul>
            </li>
        </ul> <!-- .cd-secondary-dropdown -->
    </li> <!-- .has-children -->

    <li class="has-children">
        <a href="http://codyhouse.co/?p=748">Gallery</a>

        <ul class="cd-dropdown-gallery is-hidden">
            <li class="go-back"><a href="#0">Menu</a></li>
            <li class="see-all"><a href="http://codyhouse.co/?p=748">Browse Gallery</a></li>
            <li>
                <a class="cd-dropdown-item" href="http://codyhouse.co/?p=748">
                    <img src="img/img.png" alt="Product Image">
                    <h3>Product #1</h3>
                </a>
            </li>

            <li>
                <a class="cd-dropdown-item" href="http://codyhouse.co/?p=748">
                    <img src="img/img.png" alt="Product Image">
                    <h3>Product #2</h3>
                </a>
            </li>

            <li>
                <a class="cd-dropdown-item" href="http://codyhouse.co/?p=748">
                    <img src="img/img.png" alt="Product Image">
                    <h3>Product #3</h3>
                </a>
            </li>

            <li>
                <a class="cd-dropdown-item" href="http://codyhouse.co/?p=748">
                    <img src="img/img.png" alt="Product Image">
                    <h3>Product #4</h3>
                </a>
            </li>
        </ul> <!-- .cd-dropdown-gallery -->
    </li> <!-- .has-children -->

    <li class="has-children">
        <a href="http://codyhouse.co/?p=748">Services</a>
        <ul class="cd-dropdown-icons is-hidden">
            <li class="go-back"><a href="#0">Menu</a></li>
            <li class="see-all"><a href="http://codyhouse.co/?p=748">Browse Services</a></li>
            <li>
                <a class="cd-dropdown-item item-1" href="http://codyhouse.co/?p=748">
                    <h3>Service #1</h3>
                    <p>This is the item description</p>
                </a>
            </li>

            <li>
                <a class="cd-dropdown-item item-2" href="http://codyhouse.co/?p=748">
                    <h3>Service #2</h3>
                    <p>This is the item description</p>
                </a>
            </li>

            <li>
                <a class="cd-dropdown-item item-3" href="http://codyhouse.co/?p=748">
                    <h3>Service #3</h3>
                    <p>This is the item description</p>
                </a>
            </li>

            <li>
                <a class="cd-dropdown-item item-4" href="http://codyhouse.co/?p=748">
                    <h3>Service #4</h3>
                    <p>This is the item description</p>
                </a>
            </li>

            <li>
                <a class="cd-dropdown-item item-5" href="http://codyhouse.co/?p=748">
                    <h3>Service #5</h3>
                    <p>This is the item description</p>
                </a>
            </li>

            <li>
                <a class="cd-dropdown-item item-6" href="http://codyhouse.co/?p=748">
                    <h3>Service #6</h3>
                    <p>This is the item description</p>
                </a>
            </li>

            <li>
                <a class="cd-dropdown-item item-7" href="http://codyhouse.co/?p=748">
                    <h3>Service #7</h3>
                    <p>This is the item description</p>
                </a>
            </li>

            <li>
                <a class="cd-dropdown-item item-8" href="http://codyhouse.co/?p=748">
                    <h3>Service #8</h3>
                    <p>This is the item description</p>
                </a>
            </li>

            <li>
                <a class="cd-dropdown-item item-9" href="http://codyhouse.co/?p=748">
                    <h3>Service #9</h3>
                    <p>This is the item description</p>
                </a>
            </li>

            <li>
                <a class="cd-dropdown-item item-10" href="http://codyhouse.co/?p=748">
                    <h3>Service #10</h3>
                    <p>This is the item description</p>
                </a>
            </li>

            <li>
                <a class="cd-dropdown-item item-11" href="http://codyhouse.co/?p=748">
                    <h3>Service #11</h3>
                    <p>This is the item description</p>
                </a>
            </li>

            <li>
                <a class="cd-dropdown-item item-12" href="http://codyhouse.co/?p=748">
                    <h3>Service #12</h3>
                    <p>This is the item description</p>
                </a>
            </li>

        </ul> <!-- .cd-dropdown-icons -->
    </li> <!-- .has-children -->

    <li class="cd-divider">Divider</li>

    <li><a href="http://codyhouse.co/?p=748">Page 1</a></li>
    <li><a href="http://codyhouse.co/?p=748">Page 2</a></li>
    <li><a href="http://codyhouse.co/?p=748">Page 3</a></li>
</ul> <!-- .cd-dropdown-content -->
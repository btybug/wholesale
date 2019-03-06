<header id="header-area" class="header-area bg-primary">
    <div class="header-mini">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">

                    <nav id="navbar_0" class="navbar navbar-expand-md navbar-dark navbar-0 p-0">
                        <div class="navbar-brand">
                            <select name="change_language" id="change_language" class="change-language" style="display: none;">

                                <option value="en" data-class="en" data-style="background-image: url(http://laravelcommerce.com/resources/assets/images/language_flags/1486556365.503984030_english.jpg);">English</option>

                                <option value="ar" data-class="ar" data-style="background-image: url(http://laravelcommerce.com/resources/assets/images/language_flags/1502799254.1501241757.uae.jpg);">عربى</option>

                            </select><span tabindex="0" id="change_language-button" role="combobox" aria-expanded="false" aria-autocomplete="list" aria-owns="change_language-menu" aria-haspopup="true" class="ui-selectmenu-button ui-selectmenu-button-closed ui-corner-all ui-button ui-widget"><span class="ui-selectmenu-icon ui-icon ui-icon-triangle-1-s"></span><span class="ui-selectmenu-text">English</span><span id="change_language_image" class="ui-selectmenu-image" style="background-image: url(http://laravelcommerce.com/resources/assets/images/language_flags/1486556365.503984030_english.jpg);">&nbsp;</span></span>
                        </div>


                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar_collapse_0" aria-controls="navbar_collapse_0" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbar_collapse_0">
                            @if(Auth::check())
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="{!! url('public/images/other.png') !!}" width="20px" alt=""/>
                                    <span class="d-none d-md-inline">{!! Auth::user()->name !!}</span> <b class="caret"></b>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{!! url('my-account') !!}" class="dropdown-item">Edit Profile</a>
                                    <div class="dropdown-divider"></div>
                                    {!! Form::open(['url'=>route('logout')]) !!}
                                    <button type="submit" class="btn btn-default btn-flat">Sign out</button>
                                    {!! Form::close() !!}
                                </div>
                            @else
                                <ul class="navbar-nav">
                                    <li class="nav-item"><div class="nav-link">Welcome Guest!</div></li>
                                    <li class="nav-item"> <a href="{!! route('login') !!}" class="nav-link -before"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;Login/Register</a> </li>
                                </ul>
                            @endif
                        </div>
                    </nav></div>

            </div>
        </div>
    </div>
    <div class="header-maxi">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-sm-12 col-lg-3 spaceright-0">
                    <a href="{!! url('/') !!}" class="logo">
                        <strong>E</strong>COMMERCE
                    </a>
                </div>

                <div class="col-12 col-sm-7 col-md-8 col-lg-6 px-0">
                    <form class="form-inline" action="http://laravelcommerce.com/shop" method="get">
                        <div class="search-categories">
                            <select id="category_id" name="category" style="display: none;">
                                <option value="all">All Categories</option>
                                <option value="men-s-clothing">Men's Clothing</option>
                                <option value="men-polo-shirts">--Men Polo shirts</option>
                                <option value="men-polo-shirts-1">--Men Polo shirts</option>
                                <option value="men-jeans">--Men Jeans</option>
                                <option value="men-shoes">--Men Shoes</option>
                                <option value="sunglasses-glasses">--Sunglasses &amp; Glasses</option>

                                <option value="women-s-clothing">Women's Clothing</option>
                                <option value="women-dresses">--Women Dresses</option>
                                <option value="women-shirts-tops">--Women Shirts &amp; Tops</option>
                                <option value="women-jeans">--Women Jeans</option>
                                <option value="women-hand-bags">--Women Hand Bags</option>

                                <option value="boy-s-clothing">Boy's Clothing</option>
                                <option value="boy-polo-shirts">--Boy Polo shirts</option>
                                <option value="boy-casual-shirts">--Boy Casual Shirts</option>
                                <option value="boy-pants-jeans">--Boy Pants &amp; Jeans</option>
                                <option value="boy-shoes">--Boy Shoes</option>

                                <option value="girl-s-clothing">Girl's Clothing</option>
                                <option value="dresses-rompers">--Dresses &amp; Rompers</option>
                                <option value="shorts-skirts">--Shorts &amp; Skirts</option>
                                <option value="sweaters">--Sweaters</option>

                                <option value="baby-mother">Baby &amp; Mother</option>
                                <option value="new-born">--New Born</option>
                                <option value="baby-dresses">--Baby Dresses</option>
                                <option value="baby-blankets-swaddles">--Baby Blankets &amp; Swaddles</option>

                                <option value="household-merchandises">Household Merchandises</option>
                                <option value="bedding-collections">--Bedding Collections</option>
                                <option value="throws-pillows">--Throws &amp; Pillows</option>
                                <option value="bath-robes">--Bath Robes</option>

                                <option value="health-beauty-hair">Health &amp; Beauty, Hair</option>

                                <option value="automobiles-motorcycles">Automobiles &amp; Motorcycles</option>

                                <option value="jewelry-watches">Jewelry &amp; Watches</option>

                                <option value="cellphones-accessories">Cellphones &amp; Accessories</option>

                                <option value="computer-office-security">Computer, Office, Security</option>


                            </select><span tabindex="0" id="category_id-button" role="combobox" aria-expanded="false" aria-autocomplete="list" aria-owns="category_id-menu" aria-haspopup="true" class="ui-selectmenu-button ui-button ui-widget ui-selectmenu-button-closed ui-corner-all" aria-activedescendant="ui-id-1" aria-labelledby="ui-id-1" aria-disabled="false"><span class="ui-selectmenu-icon ui-icon ui-icon-triangle-1-s"></span><span class="ui-selectmenu-text">All Categories</span></span>
                            <input type="search" name="search" placeholder="Search entire store here..." value="" aria-label="Search">
                            <button type="submit" class="btn btn-secondary"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-sm-5 col-md-4 col-lg-3 spaceleft-0">
                    <ul class="top-right-list">


                        <li class="wishlist-header">
                            <a href="{!! route('my_account_favourites') !!}">
                                <span class="badge badge-secondary" id="wishlist-count">0</span>                            <span class="fa-stack fa-lg">
                              <i class="fa fa-shopping-bag fa-stack-2x"></i>
                              <i class="fa fa-heart fa-stack-2x"></i>
                            </span>
                            </a>
                        </li>

                        <li class="cart-header dropdown head-cart-content">
                            <a href="{!!route('shop_my_cart')  !!}" id="dropdownMenuButton" {{--class="dropdown-toggle"--}}{{-- aria-haspopup="true" aria-expanded="false"--}}>
                                <span class="badge badge-secondary cart-count">{{ cartCount() }}</span>
                                <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                                <!--<img class="img-fluid" src="http://laravelcommerce.com/public/images/shopping_cart.png" alt="icon">-->

                                <span class="block">
                    	<span class="title">My Cart</span>

                            <span class="items">(<span class="cart-count">{{ cartCount() }}</span>)&nbsp;Item(s)</span>

                    </span>
                            </a>


                            <div class="shopping-cart shopping-cart-empty dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <ul class="shopping-cart-items">
                                    <li>You have no items in your shopping cart.</li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="header-navi">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-12">
                    <nav id="navbar_1" class="navbar navbar-expand-lg navbar-dark navbar-1 p-0 d-none d-lg-block">

                        <div class="collapse navbar-collapse" id="navbar_collapse_1">

                            <ul class="navbar-nav position-relative">
                                <li class="nav-item first"><a href="{!! url('/') !!}" class="nav-link"><i class="fa fa-home"></i></a></li>
                                {{--<li class="nav-item dropdown open">--}}
                                    {{--<a class="nav-link dropdown-toggle" href="">Home Pages</a>--}}
                                    {{--<ul class="dropdown-menu" aria-expanded="false">--}}
                                        {{--<li> <a class="dropdown-item" href="http://laravelcommerce.com/setStyle?style=one">Home Page 1</a> </li>--}}
                                        {{--<li> <a class="dropdown-item" href="http://laravelcommerce.com/setStyle?style=two">Home Page 2</a> </li>--}}
                                        {{--<li> <a class="dropdown-item" href="http://laravelcommerce.com/setStyle?style=three">Home Page 3</a> </li>--}}
                                    {{--</ul>--}}
                                {{--</li>--}}
                                <li class="nav-item"> <a class="nav-link" href="{!! route('product_vape') !!}">Vape</a> </li>
                                {{--! HAS SUBMENU MUST HAVE CLASS (has-subnav)--}}
                                <li class="nav-item has-subnav"> <a class="nav-link" href="{!! route('product_juice') !!}">Juice</a>
                                    <ul class="subnav list-unstyled position-absolute d-flex">
                                        <li class="subnav-item">
                                            <a href="#" class="subnav-link d-inline-block">subnav item 1</a>
                                        </li>
                                        <li class="subnav-item">
                                            <a href="#" class="subnav-link d-inline-block">subnav item 2</a>
                                        </li>
                                        <li class="subnav-item">
                                            <a href="#" class="subnav-link d-inline-block">subnav item 3</a>
                                        </li>
                                        <li class="subnav-item">
                                            <a href="#" class="subnav-link d-inline-block">subnav item 4</a>
                                        </li>
                                    </ul>
                                </li>
                                {{--! HAS SUBMENU--}}
                                <li class="nav-item has-subnav"> <a class="nav-link" href="{!! route('product_sales') !!}">Sales</a>
                                    <ul class="subnav list-unstyled position-absolute d-flex">
                                        <li class="subnav-item">
                                            <a href="#" class="subnav-link d-inline-block">sales subnav item 1</a>
                                        </li>
                                        <li class="subnav-item">
                                            <a href="#" class="subnav-link d-inline-block">sales subnav item 2</a>
                                        </li>
                                        <li class="subnav-item">
                                            <a href="#" class="subnav-link d-inline-block">sales subnav item 3</a>
                                        </li>
                                        <li class="subnav-item">
                                            <a href="#" class="subnav-link d-inline-block">sales subnav item 4</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item"> <a class="nav-link" href="{!! route('blog') !!}">News</a> </li>
                                <li class="nav-item"> <a class="nav-link" href="{!! route('forum') !!}">Forums</a> </li>
                                <li class="nav-item"> <a class="nav-link" href="{!! route('product_support') !!}">Support</a> </li>
                                <li class="nav-item"> <a class="nav-link" href="{!! route('product_contact_us') !!}">Contact Us</a> </li>
                                {{--<li class="nav-item dropdown open">--}}
                                    {{--<a class="nav-link" href="{!! route('blog') !!}">Blog</a>--}}
                                {{--</li>--}}
                                {{--<li class="nav-item last"><a class="nav-link"><span>Hotline</span>(+92 312 1234567)</a></li>--}}
                            </ul>
                        </div>
                    </nav>


                    <nav id="navbar_2" class="navbar navbar-expand-lg navbar-dark navbar-2 p-0 d-block d-lg-none">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_collapse_2" aria-controls="navbar_collapse_2" aria-expanded="false" aria-label="Toggle navigation"> Menu </button>

                        <div class="collapse navbar-collapse" id="navbar_collapse_2">

                            <ul class="navbar-nav">
                                <li class="nav-item first"><a href="http://laravelcommerce.com" class="nav-link"><i class="fa fa-home"></i></a></li>
                                <li class="nav-item dropdown open">
                                    <div class="nav-link dropdown-toggle">Home Pages</div>
                                    <ul class="dropdown-menu">
                                        <li> <a class="dropdown-item" href="http://laravelcommerce.com/setStyle?style=one">Home Page 1</a> </li>
                                        <li> <a class="dropdown-item" href="http://laravelcommerce.com/setStyle?style=two">Home Page 2</a> </li>
                                        <li> <a class="dropdown-item" href="http://laravelcommerce.com/setStyle?style=three">Home Page 3</a> </li>
                                    </ul>
                                </li>
                                <li class="nav-item"> <a class="nav-link" href="http://laravelcommerce.com/shop">Shop</a> </li>

                                <li class="nav-item dropdown mega-dropdown open">
                                    <div class="nav-link dropdown-toggle">
                                        Collection                                <span class="badge badge-secondary">Hot</span>
                                    </div>

                                    <ul class="dropdown-menu mega-dropdown-menu row">
                                        <li class="col-sm-3">
                                            <ul>
                                                <li class="dropdown-header underline">New in Stores</li>

                                                <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                                    <div class="carousel-inner">

                                                        <div class="carousel-item  active ">
                                                            <span products_id="81" class="fa  fa-heart-o  is_liked"><span class="badge badge-secondary">2</span></span>
                                                            <a href="http://laravelcommerce.com/product-detail/ruffled-cotton-cardigan"><img src="http://laravelcommerce.com/resources/assets/images/product_images/1502366686.pPOLO2-25207761_standard_v400.jpg" alt="RUFFLED COTTON CARDIGAN"></a>
                                                            <small>Girl's Clothing</small>
                                                            <h5>RUFFLED COTTON CARDIGAN</h5>

                                                            <div class="block">
                                                    <span class="price">
                                                                                                                    $49.5
                                                                                                            </span>

                                                                <div class="buttons">
                                                                    <a href="http://laravelcommerce.com/product-detail/ruffled-cotton-cardigan" class="btn btn-dark">View Detail</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Item -->
                                                        <div class="carousel-item ">
                                                            <span products_id="80" class="fa  fa-heart-o  is_liked"><span class="badge badge-secondary">2</span></span>
                                                            <a href="http://laravelcommerce.com/product-detail/flag-combed-cotton-sweater"><img src="http://laravelcommerce.com/resources/assets/images/product_images/1502366586.pPOLO2-25834797_standard_v400.jpg" alt="FLAG COMBED COTTON SWEATER"></a>
                                                            <small>Girl's Clothing</small>
                                                            <h5>FLAG COMBED COTTON SWEATER</h5>

                                                            <div class="block">
                                                    <span class="price">
                                                                                                                    <span class="line-through">$99.99</span>
                                                            $125
                                                                                                            </span>

                                                                <div class="buttons">
                                                                    <a href="http://laravelcommerce.com/product-detail/flag-combed-cotton-sweater" class="btn btn-dark">View Detail</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Item -->
                                                        <div class="carousel-item ">
                                                            <span products_id="79" class="fa  fa-heart-o  is_liked"><span class="badge badge-secondary">2</span></span>
                                                            <a href="http://laravelcommerce.com/product-detail/fair-isle-hooded-sweater"><img src="http://laravelcommerce.com/resources/assets/images/product_images/1502366462.pPOLO2-26090829_standard_v400.jpg" alt="FAIR ISLE HOODED SWEATER"></a>
                                                            <small>Girl's Clothing</small>
                                                            <h5>FAIR ISLE HOODED SWEATER</h5>

                                                            <div class="block">
                                                    <span class="price">
                                                                                                                    $45
                                                                                                            </span>

                                                                <div class="buttons">
                                                                    <a href="http://laravelcommerce.com/product-detail/fair-isle-hooded-sweater" class="btn btn-dark">View Detail</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Item -->
                                                        <div class="carousel-item ">
                                                            <span products_id="78" class="fa  fa-heart-o  is_liked"><span class="badge badge-secondary">2</span></span>
                                                            <a href="http://laravelcommerce.com/product-detail/cable-knit-cashmere-sweater"><img src="http://laravelcommerce.com/resources/assets/images/product_images/1502366342.pPOLO2-26090785_standard_v400.jpg" alt="CABLE-KNIT CASHMERE SWEATER"></a>
                                                            <small>Girl's Clothing</small>
                                                            <h5>CABLE-KNIT CASHMERE SWEATER</h5>

                                                            <div class="block">
                                                    <span class="price">
                                                                                                                    $195
                                                                                                            </span>

                                                                <div class="buttons">
                                                                    <a href="http://laravelcommerce.com/product-detail/cable-knit-cashmere-sweater" class="btn btn-dark">View Detail</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Item -->
                                                        <div class="carousel-item ">
                                                            <span products_id="77" class="fa  fa-heart-o  is_liked"><span class="badge badge-secondary">2</span></span>
                                                            <a href="http://laravelcommerce.com/product-detail/pleated-madras-skirt"><img src="http://laravelcommerce.com/resources/assets/images/product_images/1502366105.pPOLO2-26091049_alternate1_v400.jpg" alt="PLEATED MADRAS SKIRT"></a>
                                                            <small>Girl's Clothing</small>
                                                            <h5>PLEATED MADRAS SKIRT</h5>

                                                            <div class="block">
                                                    <span class="price">
                                                                                                                    $56.5
                                                                                                            </span>

                                                                <div class="buttons">
                                                                    <a href="http://laravelcommerce.com/product-detail/pleated-madras-skirt" class="btn btn-dark">View Detail</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Item -->

                                                    </div>
                                                    <!-- End Carousel Inner -->
                                                </div>

                                            </ul>
                                        </li>
                                        <li class="col-sm-9 pl-4 row">

                                            <ul class="col-sm-4">
                                                <li class="dropdown-header"><a href="http://laravelcommerce.com/shop?category=men-s-clothing">Men's Clothing</a></li>
                                                <li><a href="http://laravelcommerce.com/shop?category=men-polo-shirts">Men Polo shirts</a></li>
                                                <li><a href="http://laravelcommerce.com/shop?category=men-polo-shirts-1">Men Polo shirts</a></li>
                                                <li><a href="http://laravelcommerce.com/shop?category=men-jeans">Men Jeans</a></li>
                                                <li><a href="http://laravelcommerce.com/shop?category=men-shoes">Men Shoes</a></li>
                                                <li><a href="http://laravelcommerce.com/shop?category=sunglasses-glasses">Sunglasses &amp; Glasses</a></li>



                                            </ul>

                                            <ul class="col-sm-4">
                                                <li class="dropdown-header"><a href="http://laravelcommerce.com/shop?category=women-s-clothing">Women's Clothing</a></li>
                                                <li><a href="http://laravelcommerce.com/shop?category=women-dresses">Women Dresses</a></li>
                                                <li><a href="http://laravelcommerce.com/shop?category=women-shirts-tops">Women Shirts &amp; Tops</a></li>
                                                <li><a href="http://laravelcommerce.com/shop?category=women-jeans">Women Jeans</a></li>
                                                <li><a href="http://laravelcommerce.com/shop?category=women-hand-bags">Women Hand Bags</a></li>



                                            </ul>

                                            <ul class="col-sm-4">
                                                <li class="dropdown-header"><a href="http://laravelcommerce.com/shop?category=boy-s-clothing">Boy's Clothing</a></li>
                                                <li><a href="http://laravelcommerce.com/shop?category=boy-polo-shirts">Boy Polo shirts</a></li>
                                                <li><a href="http://laravelcommerce.com/shop?category=boy-casual-shirts">Boy Casual Shirts</a></li>
                                                <li><a href="http://laravelcommerce.com/shop?category=boy-pants-jeans">Boy Pants &amp; Jeans</a></li>
                                                <li><a href="http://laravelcommerce.com/shop?category=boy-shoes">Boy Shoes</a></li>



                                            </ul>

                                            <ul class="col-sm-4">
                                                <li class="dropdown-header"><a href="http://laravelcommerce.com/shop?category=girl-s-clothing">Girl's Clothing</a></li>
                                                <li><a href="http://laravelcommerce.com/shop?category=dresses-rompers">Dresses &amp; Rompers</a></li>
                                                <li><a href="http://laravelcommerce.com/shop?category=shorts-skirts">Shorts &amp; Skirts</a></li>
                                                <li><a href="http://laravelcommerce.com/shop?category=sweaters">Sweaters</a></li>



                                            </ul>

                                            <ul class="col-sm-4">
                                                <li class="dropdown-header"><a href="http://laravelcommerce.com/shop?category=baby-mother">Baby &amp; Mother</a></li>
                                                <li><a href="http://laravelcommerce.com/shop?category=new-born">New Born</a></li>
                                                <li><a href="http://laravelcommerce.com/shop?category=baby-dresses">Baby Dresses</a></li>
                                                <li><a href="http://laravelcommerce.com/shop?category=baby-blankets-swaddles">Baby Blankets &amp; Swaddles</a></li>



                                            </ul>

                                            <ul class="col-sm-4">
                                                <li class="dropdown-header"><a href="http://laravelcommerce.com/shop?category=household-merchandises">Household Merchandises</a></li>
                                                <li><a href="http://laravelcommerce.com/shop?category=bedding-collections">Bedding Collections</a></li>
                                                <li><a href="http://laravelcommerce.com/shop?category=throws-pillows">Throws &amp; Pillows</a></li>
                                                <li><a href="http://laravelcommerce.com/shop?category=bath-robes">Bath Robes</a></li>



                                            </ul>

                                            <ul class="col-sm-4">
                                                <li class="dropdown-header"><a href="http://laravelcommerce.com/shop?category=health-beauty-hair">Health &amp; Beauty, Hair</a></li>


                                            </ul>

                                            <ul class="col-sm-4">
                                                <li class="dropdown-header"><a href="http://laravelcommerce.com/shop?category=automobiles-motorcycles">Automobiles &amp; Motorcycles</a></li>


                                            </ul>

                                            <ul class="col-sm-4">
                                                <li class="dropdown-header"><a href="http://laravelcommerce.com/shop?category=jewelry-watches">Jewelry &amp; Watches</a></li>


                                            </ul>

                                            <ul class="col-sm-4">
                                                <li class="dropdown-header"><a href="http://laravelcommerce.com/shop?category=cellphones-accessories">Cellphones &amp; Accessories</a></li>


                                            </ul>

                                            <ul class="col-sm-4">
                                                <li class="dropdown-header"><a href="http://laravelcommerce.com/shop?category=computer-office-security">Computer, Office, Security</a></li>


                                            </ul>

                                        </li>


                                    </ul>

                                </li>
                                <li class="nav-item dropdown open">
                                    <div class="nav-link dropdown-toggle">News</div>

                                    <ul class="dropdown-menu">

                                        <li>
                                            <a class="dropdown-item" href="http://laravelcommerce.com/news?category=app-features">App Features</a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item" href="http://laravelcommerce.com/news?category=introduction">Introduction</a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item" href="http://laravelcommerce.com/news?category=platforms">Platforms</a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item" href="http://laravelcommerce.com/news?category=screen-shots">Screen Shots</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown open">
                                    <div class="nav-link dropdown-toggle">Info Pages</div>

                                    <ul class="dropdown-menu">
                                        <li> <a href="http://laravelcommerce.com/page?name=about-us" class="dropdown-item">About Us</a> </li>
                                        <li> <a href="http://laravelcommerce.com/page?name=privacy-policy" class="dropdown-item">Privacy Policy</a> </li>
                                        <li> <a href="http://laravelcommerce.com/page?name=refund-policy" class="dropdown-item">Refund Policy</a> </li>
                                        <li> <a href="http://laravelcommerce.com/page?name=term-services" class="dropdown-item">Term &amp; Services</a> </li>

                                    </ul>
                                </li>

                                <li class="nav-item"> <a class="nav-link" href="http://laravelcommerce.com/contact-us">Contact Us</a> </li>
                                <li class="nav-item last"><a class="nav-link"><span>Hotline</span>(+92 312 1234567)</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>

</header>
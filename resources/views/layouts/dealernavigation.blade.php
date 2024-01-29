
@php $name = request()->segment(count(request()->segments())); 

@endphp
    <div class="sidebar_menu col-lg-2 col-md-4 bg-dark vh-100 px-0 d-md-block d-none">
                    <!-- <div class="sidebar_menu_content"> -->
                    <div class="py-3 ps-2"><img src="{{ asset('public/dealer/images/dsi-logo-white-db.png') }}"></div>    
                    <ul class="px-0 " style="list-style:none;">
                        <li class="<?php if( ($name == 'dashboard')){ ?> active <?php }?>  menu_li"><a class="d-flex" href="{{route('dealer/dashboard')}}"><span><img src="{{ asset('public/dealer/images/view-dashboard.svg') }}"></span>Dashboard</a></li>
                        <li>
                            <div class="accordion sidebar_accordion accordion-flush" id="accordionFlush">
                                <div class="accordion-item">
                                  <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        <span><img src="{{ asset('public/dealer/images/order-details.svg') }}"></span>Online order management
                                    </button>
                                  </h2>
                                  <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlush">
                                    <div class="accordion-body">
                                        <ul class="">
                                            <li class=" <?php if( ($name == 'pending-orders')){ ?> active <?php }?>  acc_body_li"  ><a class="" href="{{route('dealer/pending-orders')}}">Pending Pickup Orders</a></li>
                                            <li class="<?php if( ($name == 'completed-orders')){ ?> active <?php }?> acc_body_li"><a class="" href="{{route('dealer/completed-orders')}}">Completed Orders</a></li>
                                            <li class="<?php if( ($name == 'cancelled-orders')){ ?> active <?php }?> acc_body_li"><a class="" href="{{route('dealer/cancelled-orders')}}">Cancelled orders</a></li>
                                          </ul>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </li>
                        <!-- <li class="menu_li"><a class="d-flex" href="#"><span><img src="{{ asset('public/dealer/images/document.svg') }}"></span>Invoice management</a></li> -->
                        <li class="<?php if( ($name == 'dealer-stock-list')){ ?> active <?php }?> menu_li"><a class="d-flex" href="{{route('dealer/dealer-stock-list')}}"><span><img src="{{ asset('public/dealer/images/stickies.svg') }}"></span>Stock management</a></li>
                        <li class="<?php if( ($name == 'dealer-user-profile')){ ?> active <?php }?> menu_li"><a class="d-flex" href="{{route('dealer/dealer-user-profile')}}"><span><img src="{{ asset('public/dealer/images/Vector.svg') }}"></span>Profile management</a></li>
                        <li class="<?php if( ($name == 'user-list')){ ?> active <?php }?> menu_li"><a class="d-flex" href="{{route('dealer/user-list')}}"><span><img src="{{ asset('public/dealer/images/list.svg') }}"></span>Current User List</a></li>
                        <li class="<?php if( ($name == 'commission-report')){ ?> active <?php }?>  menu_li"><a href="{{route('commission-report')}}"><span><img class="icon_img" src="{{ asset('public/dealer/images/document.svg') }}"></span>Commission Report</a></li>
                    </ul>
                    <!-- </div> -->
                </div>
                <div class="db_right col-lg-10 col-md-8 col-12 px-0 bg-light">
                <div class="sticky_header bg-white">
                        <div class="m-auto row">
                        <div class="d-md-none d-block col-6 d-flex">
                            <div>
                                <a class="btn" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                                    <span><img src="{{ asset('public/dealer/images/hamburger_icon.svg') }}" alt=""></span>
                                </a>      
                                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                                <div class="offcanvas-header">
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>

                                <!-- Mobile Menu Start -->
                                <div class="mobile_menu offcanvas-body">
                                    <ul class="px-0 " style="list-style:none;">
                                        <li class="<?php if( ($name == 'dashboard')){ ?> active <?php }?> menu_li"><a href="{{route('dealer/dashboard')}}"><span><img src="{{ asset('public/dealer/images/view-dashboard.svg') }}"></span>Dashboard</a></li>
                                        <li>
                                            <div class="accordion sidebar_accordion accordion-flush" id="accordionFlush">
                                                <div class="accordion-item">
                                                  <h2 class="accordion-header" id="flush-headingOne">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                        <span><img src="{{ asset('public/dealer/iimages/order-details.svg') }}"></span>Online order management
                                                    </button>
                                                  </h2>
                                                  <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlush">
                                                    <div class="accordion-body">
                                                        <ul class="bg-dark">
                                                            <li class=" <?php if( ($name == 'pending-orders')){ ?> active <?php }?> acc_body_li"><a  href="{{route('dealer/pending-orders')}}">Pending Pickup Orders</a></li>
                                                            <li class="<?php if( ($name == 'completed-orders')){ ?> active <?php }?> acc_body_li"><a href="{{route('dealer/completed-orders')}}">Completed Orders</a></li>
                                                            <li class="<?php if( ($name == 'cancelled-orders')){ ?> active <?php }?> acc_body_li"><a href="{{route('dealer/cancelled-orders')}}">Cancelled orders</a></li>
                                                          </ul>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- <li class="menu_li"><a href="#"><span><img class="icon_img" src="{{ asset('public/dealer/images/document.svg') }}"></span>Invoice management</a></li> -->
                                        <li class="<?php if( ($name == 'dealer-stock-list')){ ?> active <?php }?> menu_li"><a href="{{route('dealer/dealer-stock-list')}}"><span><img class="icon_img" src="{{ asset('public/dealer/images/stickies.svg') }}"></span>Stock management</a></li>
                                        <li class="<?php if( ($name == 'dealer-user-profile')){ ?> active <?php }?> menu_li"><a href="{{route('dealer/dealer-user-profile')}}"><span><img class="icon_img" src="{{ asset('public/dealer/images/Vector.svg') }}"></span>Profile management</a></li>
                                        <li class="<?php if( ($name == 'user-list')){ ?> active <?php }?>  menu_li"><a href="{{route('dealer/user-list')}}"><span><img class="icon_img" src="{{ asset('public/dealer/images/list.svg') }}"></span>Current User List</a></li>
                                        <li class="<?php if( ($name == 'commission-report')){ ?> active <?php }?>  menu_li"><a href="{{route('commission-report')}}"><span><img class="icon_img" src="{{ asset('public/dealer/images/document.svg') }}"></span>Commission Report</a></li>
                                    </ul>
                                </div>
                                <!-- Mobile Menu End -->

                                </div>
                            </div>
                            <div class="mobile_logo"><img src="{{ asset('public/dealer/images/logo_colored.png') }}"></div> 
                        </div>
                        <div class="col-lg-12 col-6 text-end">
                            <a href="{{route('dealer/dealer-user-profile')}}"><img src="{{ asset('public/dealer/images/account.svg') }}"></a>
                            <a href="{{route('dealer-logout')}}"><img src="{{ asset('public/dealer/images/logout.svg') }}"></a>
                        </div>
                    </div>
                    </div>
                    

@section('script')

<script type="text/javascript">
    $('#logout').on('click', function(e) {
        event.preventDefault();
        const url = $(this).attr('href');
        // var repl = "route('logout')";
        var id = $(this).val();
        $.SmartMessageBox({
            title : "<i class='fa fa-sign-out txt-color-orangeDark'></i> Confirm Logout <span class='txt-color-orangeDark'><strong>" + $('#show-shortcut').text() + "</strong></span>",
            content : $this.data('logout-msg') || "Are you sure you want to logout?",
            buttons : '[No][Yes]'

            }, function(ButtonPressed) {
                if (ButtonPressed == "Yes") {
                    window.location.replace('{{ route('logout') }}');
                }
            });
    });
</script>
@endsection

  <!--header start here-->
                <div class="header-main">
                    <div class="header-left">
                        <div class="logo-name text-center">

                             <img  src="{{ URL::asset('/admin/images/p1.png') }}" style="top: 15px;left: 15px;"  alt="Logo" />




                        </div>
@if (session('key'))
                                <p style="font-size: 28px;color: #6495ed;font-weight: 300;">
                                    {{ session('myname') }}
                                </p>
                                <p style="font-size: 20px;color: #C9C9C9;font-weight: 300;">{{ session('farmname') }}</p>
                            @endif
                        <div class="clearfix"> </div>
                    </div>
                    <div class="header-right">
                        <span class="label label-success pull-right" style="padding: 10px;font-size: 16px;font-weight: 300;">{{ session('role') }}</span>
                        <!--//end-search-box-->
                        <div class="profile_details_left">
                            <!--notifications of menu start -->

                            <div class="clearfix"> </div>
                        </div>
                        <!--notification menu end -->
                        <div class="profile_details">
                            <ul>
                                <li class="dropdown profile_details_drop">
                                </li>
                            </ul>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <!--heder end here-->
                <!-- script-for sticky-nav -->
                <script>
                $(document).ready(function() {
                    var navoffeset = $(".header-main").offset().top;
                    $(window).scroll(function() {
                        var scrollpos = $(window).scrollTop();
                        if (scrollpos >= navoffeset) {
                            $(".header-main").addClass("fixed");
                        } else {
                            $(".header-main").removeClass("fixed");
                        }
                    });

                });
                </script>
                <!-- /script-for sticky-nav -->

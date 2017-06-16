<style>
    ul li a i span{
        padding-left: 10px;
        font-family: 'Prompt';
        font-weight: 300;
        font-size: 16px;
        vertical-align: middle;

    }
    a{
         color: #9DA0A7;
    }
    .fa-2x{
        font-size: 1.6em!important;
    }

</style>
<style>
     @media screen and (min-width: 48em) {
          .menubar{
            margin-left: 15px;
          }
    }
</style>
<!--slider menu-->
<div class="sidebar-menu" style="position: fixed;">
    <div style="padding: 0.7em 0em;background-color: #22272A;box-shadow: 0 1px 3px rgba(0,0,0,0.15);">
        <ul id="menu" style="margin:10px 0;">
            <li>
                <a href="{{ url('/admins') }}" style="padding: 8px 20px;">
                    <img alt="Logo" class="img img-responsive center-block" id="logopic" src="{{ URL::asset('/admin/images/LogoHeader_Admin.png') }}"/>
                </a>
            </li>
        </ul>
    </div>
    <div class="menu" style="font-weight: 300;">
        <!-- Admin Zone -->
         @if (session('role') == 'Admin')
        <ul id="menu" style="margin:0px 0;">
            <li id="menu-home">
                <a class="menubar" href="{{ url('/admins') }}" style="text-align: left!important;">
                    <i aria-hidden="true" class="fa fa-tachometer fa-2x" style="margin-bottom: 0px;">
                        <span>
                            Dashboard
                        </span>
                    </i>
                </a>
            </li>
        </ul>
        <ul id="menu" style="margin:8px 0;">
            <li id="form-text">
                <a class="menubar" href="{{ url('/admins/form') }}" style="text-align: left!important;">
                <i class="fa fa-inbox fa-2x" aria-hidden="true" style="margin-bottom: 0px;">
                        <span>
                              Product Form
                        </span>
                    </i>
                </a>
            </li>
        </ul>
        <ul id="menu" style="margin:8px 0;">
            <li id="product-text">
                <a class="menubar" href="{{ url('/admins/product') }}" style="text-align: left!important;">
                <i class="fa fa-leaf fa-2x" aria-hidden="true" style="margin-bottom: 0px;">
                        <span>
                             Add Product
                        </span>
                    </i>
                </a>
            </li>
        </ul>
        <ul id="menu" style="margin:8px 0 40px 0;">
            <li id="verify-text">
                <a class="menubar" href="{{ url('/admins/verify') }}" style="text-align: left!important;">
                    <i aria-hidden="true" class="fa fa-paper-plane fa-2x" style="margin-bottom: 0px;">
                        <span>
                            Review
                        </span>
                    </i>
                </a>
            </li>
        </ul>
        @endif
        <!-- End Admin Zone -->
        <ul id="menu" style="margin:8px 0;">
            <li id="create-text">
                <a class="menubar" href="{{ url('/admins/writing') }}" style="text-align: left!important;">
                    <i aria-hidden="true" class="fa fa-plus-circle fa-2x" style="margin-bottom: 0px;">
                        <span style="" >
                            Create Article
                        </span>
                    </i>
                </a>
            </li>
        </ul>
        <ul id="menu" style="margin:8px 0;">
            <li id="my-article-text">
                <a class="menubar" href="{{ url('/admins/myarticle') }}" style="text-align: left!important;">
                    <i class="fa fa-clock-o fa-2x" aria-hidden="true" style="margin-bottom: 0px;">
                        <span>
                            My Article
                        </span>
                    </i>
                </a>
            </li>
        </ul>
        <ul id="menu" style="margin:40px 0 8px 0;">
            <li id="my-account-text">
                <a class="menubar" href="{{ url('/admins/profile') }}" style="text-align: left!important;">
                    <i class="fa fa-cog fa-2x" aria-hidden="true" style="margin-bottom: 0px;">
                        <span>
                            My Account
                        </span>
                    </i>
                </a>
            </li>
        </ul>
        <ul id="menu" style="margin-bottom: 0px;">
            <li>
                <a class="menubar" href="{{ url('/admins/logout') }}" style="text-align: left!important;">
                    <i aria-hidden="true" class="fa fa-power-off fa-2x">
                        <span>
                            Logout
                        </span>
                    </i>
                </a>
            </li>
        </ul>





    </div>
</div>
<div class="clearfix">
</div>


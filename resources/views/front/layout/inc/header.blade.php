  
        <nav id="topnav" class="defaultscroll is-sticky">
            <div class="container relative">
                <!-- Logo container-->
                <a class="logo" href="/">
                    <img src="/images/site/{{ get_settings()->site_logo }}" width="98" class="inline-block dark:hidden" alt="">
                    <img src="/images/site/{{ get_settings()->site_logo }}" width="98" class="hidden dark:inline-block" alt="">
                </a>
                <!-- End Logo container-->

             @include('front.layout.inc.mobile-menu')

                <!--Login button Start-->
                <ul class="buy-button list-none mb-0">
                    
                   
        @if (Auth::guard('user')->check())
    <li class="inline mb-0">
        <a href="{{ route('user.profile') }}" class="btn btn-icon bg-green-600 hover:bg-green-700 border-green-600 dark:border-green-600 text-white rounded-full">
             <i data-feather="user" class="size-4 stroke-[3]"></i>
        </a>
    </li>
@else
    <li class="inline ps-1 mb-0">
        <a href="{{ route('user.login') }}" class="btn bg-green-600 hover:bg-green-700 border-green-600 dark:border-green-600 text-white rounded-full">
            Connectez-Vous
        </a>
    </li>
@endif

   
                </ul>
                <!--Login button End-->

                <div id="navigation">
                    <!-- Navigation Menu-->   
                    <ul class="navigation-menu justify-end">
                        
                
                        <li><a href="{{ route('vente-vehicule') }}" class="sub-menu-item">Achetez</a></li>
                
                        <li><a href="{{ route('location-vehicule') }}" class="sub-menu-item">Louer</a></li>

                      
                
                        <li class="has-submenu parent-parent-menu-item">
                            <a href="javascript:void(0)" class="sub-menu-item">Contactez-Nous</a><span class="menu-arrow"></span>
                         <ul class="submenu">
                             <li><a href="https://wa.me/2250758700692" target="_blank" class="sub-menu-item"><i class="uil uil-whatsapp size-4"></i> Whatsapp</a></li>
                             <li><a href="tel:{{ get_settings()->site_phone }}" target="_blank" class="sub-menu-item"><i class="uil uil-phone size-2"></i> Telephone</a></li>
                             <li><a href="{{ get_social_network()->facebook_url }}" target="_blank" class="sub-menu-item"><i class="uil uil-facebook size-2"></i> Facebook </a></li>
                             <li><a href="{{ get_social_network()->instagram_url }}" target="_blank" class="sub-menu-item"><i class="uil uil-instagram size-2"></i> Instagram </a></li>
                             <li><a href="mailto:{{ get_settings()->site_email }}" target="_blank" class="sub-menu-item"><i class="uil uil-envelope size-2"></i> Email</a></li>
                        </ul> 
                    </li>
                    </ul><!--end navigation menu-->
                </div><!--end navigation-->
            </div><!--end container-->
        </nav><!--end header-->
        <!-- End Navbar -->
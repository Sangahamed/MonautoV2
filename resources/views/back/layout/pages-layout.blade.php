<!DOCTYPE html>
<html>
	<head>
		
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>@yield('pageTitle')</title>
		<!-- Site favicon -->
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<link
			rel="icon"
			type="image/png"
			sizes="16x16"
			href="/images/site/{{ get_settings()->site_favicon }}"
		/>

		<!-- Mobile Specific Metas -->
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, maximum-scale=1"
		/>

		<!-- Google Font -->
		<link
			href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
			rel="stylesheet"
		/>
		<!-- CSS -->
		{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> --}}
		<link rel="stylesheet" type="text/css" href="/back/vendors/styles/core.css" />
		
		<link
			rel="stylesheet"
			type="text/css"
			href="/back/src/plugins/jquery-asColorPicker/dist/css/asColorPicker.css"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="/back/vendors/styles/icon-font.min.css"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="/back/src/plugins/jquery-steps/jquery.steps.css"
		/>
		<link rel="stylesheet" type="text/css" href="/back/vendors/styles/style.css" />
		<link rel="stylesheet" type="text/css" href="/back/vendors/styles/styleim.css" />
<script>
			window.dataLayer = window.dataLayer || [];
			function gtag() {
				dataLayer.push(arguments);
			}
			gtag("js", new Date());

			gtag("config", "G-GBZ3SGGX85");
		</script>

		<script>
			(function (w, d, s, l, i) {
				w[l] = w[l] || [];
				w[l].push({ "gtm.start": new Date().getTime(), event: "gtm.js" });
				var f = d.getElementsByTagName(s)[0],
					j = d.createElement(s),
					dl = l != "dataLayer" ? "&l=" + l : "";
				j.async = true;
				j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
				f.parentNode.insertBefore(j, f);
			})(window, document, "script", "dataLayer", "GTM-NXZMQSS");
		</script>
		<!-- End Google Tag Manager -->
    
	   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/selectize@0.12.6/dist/css/selectize.bootstrap3.min.css">
	   <link rel="stylesheet" href="/extra-assets/ijaboCropTool/ijaboCropTool.min.css">
	   <link rel="stylesheet" href="/extra-assets/jquery-ui-1.13.2/jquery-ui.min.css">
	   <link rel="stylesheet" href="/extra-assets/jquery-ui-1.13.2/jquery-ui.structure.min.css">
	   <link rel="stylesheet" href="/extra-assets/jquery-ui-1.13.2/jquery-ui.theme.min.css">
	   <link rel="stylesheet" href="/extra-assets/summernote/summernote-bs4.min.css">
	   <style>
		.swal2-popup{
			font-size: 0.78em;


			.checkbox-container {
		display: flex;
		align-items: center;
		justify-content: space-between; /* Distributes space evenly */
		width: 100%; /* Ensures full width of the container */
		padding: 10px;
		border: 1px solid #ccc;
		border-radius: 5px;
		margin-bottom: 10px;
		}

		.checkbox-container input[type="checkbox"] {
		width: 20px;
		height: 20px;
		margin-right: 10px; /* Adds space between checkbox and label */
		}

		.checkbox-container label {
		font-size: 14px;
		color: #333;
		}

		}
	   </style>
	   {{-- @kropifyStyles --}}
	   @livewireStyles
        @stack('stylesheets')
	</head>
	<body>
		{{-- <div class="pre-loader">
			<div class="pre-loader-box">
				<div class="loader-logo">
					<img src="/back/vendors/images/deskapp-logo.svg" alt="" />
				</div>
				<div class="loader-progress" id="progress_div">
					<div class="bar" id="bar1"></div>
				</div>
				<div class="percent" id="percent1">0%</div>
				<div class="loading-text">Loading...</div>
			</div>
		</div> --}}

		<div class="header">
			<div class="header-left">
				<div class="menu-icon bi bi-list"></div>
				<div
					class="search-toggle-icon bi bi-search"
					data-toggle="header_search"
				></div>
				<div class="header-search">
					<form>
						<div class="form-group mb-0">
							<i class="dw dw-search2 search-icon"></i>
							<input
								type="text"
								class="form-control search-input"
								placeholder="Search Here"
							/>
							<div class="dropdown">
								<a
									class="dropdown-toggle no-arrow"
									href="#"
									role="button"
									data-toggle="dropdown"
								>
									<i class="ion-arrow-down-c"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right">
									<div class="form-group row">
										<label class="col-sm-12 col-md-2 col-form-label"
											>From</label
										>
										<div class="col-sm-12 col-md-10">
											<input
												class="form-control form-control-sm form-control-line"
												type="text"
											/>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-12 col-md-2 col-form-label">To</label>
										<div class="col-sm-12 col-md-10">
											<input
												class="form-control form-control-sm form-control-line"
												type="text"
											/>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-12 col-md-2 col-form-label"
											>Subject</label
										>
										<div class="col-sm-12 col-md-10">
											<input
												class="form-control form-control-sm form-control-line"
												type="text"
											/>
										</div>
									</div>
									<div class="text-right">
										<button class="btn btn-primary">Search</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="header-right">
				
				@if ( Route::is('admin.*') )
				<div class="dashboard-setting user-notification">
					<div class="dropdown">
						<a
							class="dropdown-toggle no-arrow"
							href="javascript:;"
							data-toggle="right-sidebar"
						>
							<i class="dw dw-settings2"></i>
						</a>
					</div>
				</div>
              @else
			  @endif
				<div class="user-notification">
					<div class="dropdown">
						<a
							class="dropdown-toggle no-arrow"
							href="#"
							role="button"
							data-toggle="dropdown"
						>
							<i class="icon-copy dw dw-notification"></i>
							<span class="badge notification-active"></span>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<div class="notification-list mx-h-350 customscroll">
								<ul>
									<li>
										<a href="#">
											<img src="/back/vendors/images/img.jpg" alt="" />
											<h3>John Doe</h3>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed...
											</p>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="/back/vendors/images/photo1.jpg" alt="" />
											<h3>Lea R. Frith</h3>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed...
											</p>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="/back/vendors/images/photo2.jpg" alt="" />
											<h3>Erik L. Richards</h3>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed...
											</p>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="/back/vendors/images/photo3.jpg" alt="" />
											<h3>John Doe</h3>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed...
											</p>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="/back/vendors/images/photo4.jpg" alt="" />
											<h3>Renee I. Hansen</h3>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed...
											</p>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="/back/vendors/images/img.jpg" alt="" />
											<h3>Vicki M. Coleman</h3>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed...
											</p>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>

				{{-- <livewire:admin-user-header-profile-info> --}}
					@livewire('admin-user-header-profile-info')



				
			</div>
		</div>

		<div class="right-sidebar">
			<div class="sidebar-title">
				<h3 class="weight-600 font-16 text-blue">
					Layout Settings
					<span class="btn-block font-weight-400 font-12"
						>User Interface Settings</span
					>
				</h3>
				<div class="close-sidebar" data-toggle="right-sidebar-close">
					<i class="icon-copy ion-close-round"></i>
				</div>
			</div>
			<div class="right-sidebar-body customscroll">
				<div class="right-sidebar-body-content">
					<h4 class="weight-600 font-18 pb-10">Header Background</h4>
					<div class="sidebar-btn-group pb-30 mb-10">
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary header-white active"
							>White</a
						>
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary header-dark"
							>Dark</a
						>
					</div>

					<h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
					<div class="sidebar-btn-group pb-30 mb-10">
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary sidebar-light"
							>White</a
						>
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary sidebar-dark active"
							>Dark</a
						>
					</div>

					<h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
					<div class="sidebar-radio-group pb-10 mb-10">
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebaricon-1"
								name="menu-dropdown-icon"
								class="custom-control-input"
								value="icon-style-1"
								checked=""
							/>
							<label class="custom-control-label" for="sidebaricon-1"
								><i class="fa fa-angle-down"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebaricon-2"
								name="menu-dropdown-icon"
								class="custom-control-input"
								value="icon-style-2"
							/>
							<label class="custom-control-label" for="sidebaricon-2"
								><i class="ion-plus-round"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebaricon-3"
								name="menu-dropdown-icon"
								class="custom-control-input"
								value="icon-style-3"
							/>
							<label class="custom-control-label" for="sidebaricon-3"
								><i class="fa fa-angle-double-right"></i
							></label>
						</div>
					</div>

					<h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
					<div class="sidebar-radio-group pb-30 mb-10">
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-1"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-1"
								checked=""
							/>
							<label class="custom-control-label" for="sidebariconlist-1"
								><i class="ion-minus-round"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-2"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-2"
							/>
							<label class="custom-control-label" for="sidebariconlist-2"
								><i class="fa fa-circle-o" aria-hidden="true"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-3"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-3"
							/>
							<label class="custom-control-label" for="sidebariconlist-3"
								><i class="dw dw-check"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-4"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-4"
								checked=""
							/>
							<label class="custom-control-label" for="sidebariconlist-4"
								><i class="icon-copy dw dw-next-2"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-5"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-5"
							/>
							<label class="custom-control-label" for="sidebariconlist-5"
								><i class="dw dw-fast-forward-1"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-6"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-6"
							/>
							<label class="custom-control-label" for="sidebariconlist-6"
								><i class="dw dw-next"></i
							></label>
						</div>
					</div>

					<div class="reset-options pt-30 text-center">
						<button class="btn btn-danger" id="reset-settings">
							Reset Settings
						</button>
					</div>
				</div>
			</div>
		</div>

		<div class="left-side-bar">
			<div class="brand-logo">
				<a href="/">
					<img src="/images/site/{{ get_settings()->site_logo }}" alt="" class="dark-logo" />
					<img
						src="/images/site/{{ get_settings()->site_logo }}"
						alt=""
						class="light-logo"
					/>
				</a>
				<div class="close-sidebar" data-toggle="left-sidebar-close">
					<i class="ion-close-round"></i>
				</div>
			</div>
			<div class="menu-block customscroll">
				<div class="sidebar-menu">
					<ul id="accordion-menu">

						@if ( Route::is('admin.*') )
						<li>
							<a href="{{ route('admin.home') }}" class="dropdown-toggle no-arrow {{ Route::is('admin.home') ? 'active' : '' }}">
								<span class="micon fa fa-home"></span
								><span class="mtext">Home</span>
							</a>
						</li>

						<li>
							<a href="{{ route('admin.manage-categories.cats-subcats-list') }}" class="dropdown-toggle no-arrow {{ Route::is('admin.manage-categories.*') ? 'active' : '' }}">
								<span class="micon dw dw-align-left3"></span
								><span class="mtext">Categories</span>
							</a>
						</li>


						<li>
							<a href="{{ route('admin.users') }}" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-receipt-cutoff"></span
								><span class="mtext">Utilisateur</span>
							</a>
						</li>

						<li>
							<a href="{{ route('admin.locations') }}" class="dropdown-toggle no-arrow">
								<span class="micon"><img width="50" height="50" src="https://img.icons8.com/?size=100&id=12666&format=png&color=7950F2" alt="car"/> </span>
								
								<span class="mtext">Location</span>
							</a>
						</li>


						<li>
							
							<a href="{{ route('admin.ventes') }}" class="dropdown-toggle no-arrow">
								<span class="micon"><img width="50" height="50" src="https://img.icons8.com/?size=100&id=12666&format=png&color=7950F2" alt="car"/> </span>
								<span class="mtext">Ventes</span>
							</a>
						</li>

						<li>
							<div class="dropdown-divider"></div>
						</li>
						<li>
							<div class="sidebar-small-cap">Parametre</div>
						</li>

						<li>
							<a
								href="{{ route('admin.profile') }}"

								class="dropdown-toggle no-arrow {{ Route::is('admin.profile') ? 'active' : '' }}"
							>
								<span class="micon fa fa-user"></span>
								<span class="mtext"
									>Profile
									</span>
							</a>
						</li>
						<li>
							<a
								href="{{ route('admin.settings') }}"

								class="dropdown-toggle no-arrow {{ Route::is('admin.settings') ? 'active' : '' }}"
							>
								<span class="micon icon-copy fi-widget"></span>
								<span class="mtext"
									>Parametre
									</span>
							</a>
						</li>
						@else
						<li>
							<a href="{{ route('user.home') }}" class="dropdown-toggle no-arrow {{ Route::is('user.home') ? 'active' : '' }}">
								<span class="micon fa fa-home"></span
								><span class="mtext">Home</span>
							</a>
						</li>



						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle {{ Route::is('user.vendre.*') ? 'active' : '' }}">
								<span class="micon"><img width="50" height="50" src="https://img.icons8.com/?size=100&id=12666&format=png&color=7950F2" alt="car"/> </span> <span class="mtext">VENDRE Vehicule</span>
							</a>
							<ul class="submenu">
								<li><a href="{{ route('user.vendre.all-vendres') }}" class="{{ Route::is('user.vendre.all-vendres') ? 'active' : '' }}">Voir Vehicule</a></li>
								<li><a href="{{ route('user.vendre.add-vehicule') }}" class="{{ Route::is('user.vendre.add-vehicule') ? 'active' : '' }}">Ajouter Vehicule</a></li>
							</ul>
						</li>

						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle {{ Route::is('user.location.*') ? 'active' : '' }}">
								<span class="micon"><img width="50" height="50" src="https://img.icons8.com/?size=100&id=55300&format=png&color=7950F2" alt="car"/></span><span class="mtext">Location Vehicule</span>
							</a>
							<ul class="submenu">
								<li><a href="{{ route('user.location.all-locations') }}" class="{{ Route::is('user.location.all-locations') ? 'active' : '' }}">Voir Vehicules</a></li>
								<li><a href="{{ route('user.location.add-location') }}" class="{{ Route::is('user.location.add-location') ? 'active' : '' }}">Ajouter Vehicule</a></li>
							</ul>
						</li>

						{{-- <li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle {{ Route::is('user.product.*') ? 'active' : '' }}">
								<span class="micon bi bi-bag"></span><span class="mtext">Manage Products</span>
							</a>
							<ul class="submenu">
								<li><a href="{{ route('user.product.all-products') }}" class="{{ Route::is('user.product.all-products') ? 'active' : '' }}">All Products</a></li>
								<li><a href="{{ route('user.product.add-product') }}" class="{{ Route::is('user.product.add-product') ? 'active' : '' }}">Add Product</a></li>
							</ul>
						</li> --}}

						<li>
							<div class="dropdown-divider"></div>
						</li>
						<li>
							<div class="sidebar-small-cap">Parametre</div>
						</li>

						<li>
							<a
								href="{{ route('user.profile') }}"

								class="dropdown-toggle no-arrow {{ Route::is('user.profile') ? 'active' : '' }}"
							>
								<span class="micon fa fa-user"></span>
								<span class="mtext"
									>Profile
									</span>
							</a>
						</li>
	<li>
							<a
								href="{{ route('user.concession-settings') }}"

								class="dropdown-toggle no-arrow {{ Route::is('user.concession-settings') ? 'active' : '' }}"
							>
								<span class="micon bi bi-shop"></span>
								<span class="mtext"
									>Concession Parametre
									</span>
							</a>
						</li>

						@endif



					</ul>
				</div>
			</div>
		</div>
		<div class="mobile-menu-overlay"></div>

		<div class="main-container">
			<div class="pd-ltr-20 xs-pd-20-10">
				<div class="min-height-200px">

					<div>
                        @yield('content')
                    </div>
				</div>
				<div class="footer-wrap pd-20 mb-20 card-box">
					Monauto.ci par learderautoservice
					<a  href="https://github.com/dropways" target="_blank"
						>LearderAutoServices</a
					>
					<a hidden href="https://github.com/dropways" target="_blank"
						>Sanga hamed bakayoko</a
					>
				</div>
			</div>
		</div>

		<!-- js -->
		
		<script src="/back/vendors/scripts/core.js"></script>
		<script src="/back/vendors/scripts/script.min.js"></script>
		<script src="/back/vendors/scripts/process.js"></script>
		<script src="/back/vendors/scripts/layout-settings.js"></script>
		<script src="/back/vendors/scripts/custom.js"></script>
		<script src="/back/vendors/scripts/process.js"></script>
		<script src="/back/vendors/scripts/layout-settings.js"></script>
		<script src="/back/src/plugins/jquery-steps/jquery.steps.js"></script>
		<script src="/back/vendors/scripts/steps-setting.js"></script>
		<script>
			if( navigator.userAgent.indexOf("Firefox") != -1 ){
				history.pushState(null, null, document.URL);
				window.addEventListener('popstate', function(){
					history.pushState(null, null, document.URL);
				});
			}
		</script>
		
		<script src="/extra-assets/ijaboCropTool/ijaboCropTool.min.js"></script>
		{{-- <script src="/extra-assets/jquery-ui-1.13.2/jquery-ui.min.js"></script> --}}
		<script src="/extra-assets/summernote/summernote-bs4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script src="https://cdn.jsdelivr.net/npm/selectize@0.12.6/dist/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/jquery-multifile@2.2.2/jquery.MultiFile.min.js" integrity="sha256-TiSXq9ubGgxFwCUu3belTfML3FOjrdlF0VtPjFLpksk=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    
		<script>
			$(document).ready(function(){
                $('.summernote').summernote({
					height:200
				});
			});
		</script>
		<script>
			window.addEventListener('showToastr', function(event){
                  toastr.remove();
				  if( event.detail[0].type === 'info' ){ toastr.info(event.detail[0].message); }
				  else if( event.detail[0].type === 'success' ){ toastr.success(event.detail[0].message); }
				  else if( event.detail[0].type === 'error' ){ toastr.error(event.detail[0].message); }
				  else if( event.detail[0].type === 'warning' ){ toastr.warning(event.detail[0].message); }
				  else{ return false; }
			});
		</script>
		{{-- @kropifyScripts --}}
		@livewireScripts
	    @stack('scripts')
	</body>
</html>

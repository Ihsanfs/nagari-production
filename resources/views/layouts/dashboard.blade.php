<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Dashboard</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{ asset('images/icon/favicon.ico') }}" type="image/x-icon" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts and icons -->
    <script src="{{ asset('../assets/js/plugin/webfont/webfont.min.js') }}"></script>
    @stack('styles')
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                "urls": ["{{ asset('assets/css/fonts.min.css') }}"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-html5-1.6.2/datatables.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-html5-1.6.2/datatables.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('../assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('../assets/css/atlantis.min.css') }}">
    <link rel="stylesheet" href="{{ asset('../assets/css/demo.css') }}">
</head>

<body data-background-color="white">
    <div class="wrapper">
        <div class="main-header">

            <div class="logo-header" data-background-color="dark">


                <button class="navbar-toggler sidenav-toggler ml-auto " type="button" data-toggle="collapse"
                    data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="icon-menu"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar mt-4">
                        <i class="icon-menu"></i>
                    </button>
                </div>
            </div>

            <nav class="navbar navbar-header navbar-expand-lg" data-background-color="dark">

                <div class="container-fluid">
                    <div class="collapse col col-6" id="search-nav">
                        <a href="{{ route('beranda') }}" target="_blank" style="color: black; text-decoration: none;"
                            class="form-control text-end">Lihat Website</a>

                    </div>
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        {{-- <li class="nav-item toggle-nav-search hidden-caret">
							<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
								<i class="fa fa-search"></i>
							</a>
						</li> --}}



                        <li class="nav-item dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"
                                aria-expanded="false">
                                <div class="avatar-sm">
                                    <img src="{{ asset(Auth::user()->gambar) }}" alt="image profile"
                                        class="avatar-img rounded-circle">

                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <div class="dropdown-user-scroll scrollbar-outer">
                                    <li>
                                        <div class="user-box">
                                            <div class="avatar-lg">
                                                <img src="{{ asset(Auth::user()->gambar) }}" alt="image profile"
                                                    class="avatar-img rounded">

                                            </div>
                                            <div class="u-text">

                                                <h4>{{ Auth::user()->name }}</h4>
                                                <p class="text-muted">{{ Auth::user()->email }}</p><a
                                                    href="{{ route($role . '.users') }}"
                                                    class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        {{-- <div class="dropdown-divider"></div> --}}
                                        {{-- <a class="dropdown-item" href="#">My Profile</a> --}}

                                        <div class="dropdown-divider"></div>
                                        <a href="{{ route('logout') }}" class="dropdown-item"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Log Out') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>

                                    </li>
                                </div>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>

        <!-- Sidebar -->
        <div class="sidebar sidebar-style-2" data-background-color="dark2">
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <div class="user">
                        <div class="avatar-sm float-left mr-2">
                            <img src="{{ asset(Auth::user()->gambar) }}" alt="image profile"
                                class="avatar-img rounded-circle">
                        </div>
                        <div class="info">
                            <a data-toggle="collapse" href="#collapseExample" aria-expanded="true"></a>
                            <div class="clearfix">
                                <p>{{ Auth::user()->name }}</p>
                            </div>
                        </div>
                    </div>

                    <ul class="nav nav-primary">
                        <li class="nav-item active">
                            <a href="{{ route($role . '.dashboard') }}" class="collapsed">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                                {{-- <span class="caret"></span> --}}
                            </a>
                            {{-- <div class="collapse" id="dashboard">
								<ul class="nav nav-collapse">
									<li>
										<a href="../demo1/index.html">
											<span class="sub-item">Dashboard 1</span>
										</a>
									</li>
									<li>
										<a href="../demo2/index.html">
											<span class="sub-item">Dashboard 2</span>
										</a>
									</li>
								</ul>
							</div> --}}
                        </li>
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">MENU</h4>
                        </li>

                        {{-- <li class="nav-item">
							<a data-toggle="collapse" href="#base">
								<i class="fas fa-layer-group"></i>
								<p>Kategori</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="base">
								<ul class="nav nav-collapse">
									<li>
										<a href="{{route($role.'.kategori')}}">
											<span class="sub-item">Kategori</span>
										</a>
									</li>

								</ul>
							</div>
						</li> --}}
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#berita">
                                <i class="fas fa-newspaper"></i>
                                <p>Berita</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="berita">
                                <ul class="nav nav-collapse">
                                    <li class="nav-item">
                                        <a href="{{ route($role . '.kategori') }}">
                                            <i class="fa-solid fa-tag"></i>
                                            <p>Kategori</p>

                                        </a>

                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ route($role . '.tag.index') }}">
                                            <i class="fa-solid fa-tag"></i>
                                            <p>Tag</p>

                                        </a>

                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ route($role . '.berita') }}">
                                            <i class="fa-solid fa-newspaper"></i>
                                            <p>Berita</p>

                                        </a>

                                    </li>



                                </ul>
                            </div>


                        </li>



                        <li class="nav-item">
                            <a data-toggle="collapse" href="#multimedia">
                                <i class="fa-solid fa-photo-film"></i>
                                <p>Multimedia</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="multimedia">
                                <ul class="nav nav-collapse">
                                    <li class="nav-item">
                                        <a href="{{ route($role . '.galery') }}">
                                            <i class="fa-solid fa-photo-film"></i>
                                            <p>Gallery</p>

                                        </a>

                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ route($role . '.slider_index') }}">
                                            <i class="fa-solid fa-photo-film"></i>
                                            <p>Slider</p>

                                        </a>

                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ route($role . '.video') }}">
                                            <i class="fa-solid fa-photo-film"></i>
                                            <p>Video</p>

                                        </a>

                                    </li>



                                </ul>
                            </div>


                        </li>
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#menu">
                                <i class="fas fa-newspaper"></i>
                                <p>Modul</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="menu">
                                <ul class="nav nav-collapse">
                                    <li class="nav-item">
                                        <a href="{{ route($role . '.menu') }}">
                                            <i class="fa-solid fa-photo-film"></i>
                                            <p>Menu</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ route($role . '.halaman') }}">
                                            <i class="fa-solid fa-photo-film"></i>
                                            <p>Halaman</p>

                                        </a>

                                    </li>





                                </ul>
                            </div>


                        </li>





                        <li class="nav-item">
                            <a data-toggle="collapse" href="#finansial">
                                <i class="fa-solid fa-money-bill"></i>
                                <p>Finansial</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="finansial">
                                <ul class="nav nav-collapse">
                                    <li class="nav-item">
                                        <a href="{{ route($role . '.sumber_dana') }}">
                                            <i class="fa-solid fa-money-bill"></i>
                                            <p>Sumber dana</p>

                                        </a>

                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ route($role . '.transaksi') }}">
                                            <i class="fa-solid fa-money-bill"></i>
                                            <p>Pengeluaran</p>

                                        </a>

                                    </li>



                                </ul>
                            </div>


                        </li>

                        <li class="nav-item">
                            <a href="{{ route($role . '.pegawai') }}">
                                <i class="fa-solid fa-user"></i>
                                <p>Pegawai</p>

                            </a>

                        </li>
                        <li class="nav-item">
                            <a href="{{ route($role . '.pelayanan') }}">
                                <i class="fa-solid fa-user"></i>
                                <p>Pelayanan</p>

                            </a>

                        </li>

                        <li class="nav-item">
                            <a href="{{ route($role . '.media') }}">
                                <i class="fa-solid fa-photo-film"></i>
                                <p>Sosial media</p>

                            </a>

                        </li>
                        <li class="nav-item">
                            <a href="{{ route($role . '.pengumuman') }}">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                <p>Pengumuman</p>

                            </a>

                        </li>

                        <li class="nav-item">
                            <a href="{{ route($role . '.download') }}">
                                <i class="fa-solid fa-download"></i>
                                <p>Download</p>

                            </a>

                        </li>
                        {{-- <li class="nav-item">
							<a href="{{route($role.'.berita')}}">
                                <i class="fa-solid fa-gear"></i>
								<p>Pengaturan</p>

							</a>

						</li> --}}



                        <li class="nav-item">
                            <a data-toggle="collapse" href="#sidebarLayouts">
                                <i class="fa-solid fa-gear"></i>
                                <p>Pengaturan</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="sidebarLayouts">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="{{ route($role . '.instansi') }}">
                                            <span class="sub-item">Instansi</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route($role . '.apps') }}">
                                            <span class="sub-item">Web App</span>
                                        </a>
                                    </li>



                                </ul>
                            </div>


                        </li>

                        <li class="nav-item">
                            <a data-toggle="collapse" href="#users">
                                <i class="fa-solid fa-user"></i>
                                <p>Users</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="users">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="{{ route($role . '.users') }}">
                                            <span class="sub-item">Profil</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route($role . '.users_password') }}">
                                            <span class="sub-item">Keamanan</span>
                                        </a>
                                    </li>
                                    @if (Auth::user()->role_id == 1)
                                        <li>
                                            <a href="{{ route($role . '.users_all') }}">
                                                <span class="sub-item">Tambah User</span>
                                            </a>
                                        </li>
                                    @endif

                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a href="{{asset('TATA CARA PENGGUNA WEB NAGARI.pdf')}}">
                                <i class="fa-solid fa-download"></i>
                                <p>Panduan Pengguna</p>

                            </a>

                        </li>

                        {{-- <li class="mx-4 mt-2">
							<a href="http://themekita.com/atlantis-bootstrap-dashboard.html" class="btn btn-primary btn-block"><span class="btn-label mr-2"> <i class="fa fa-heart"></i> </span>Buy Pro</a>
						</li> --}}
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    @yield('content')




                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav class="pull-left">
                        <ul class="nav">

                        </ul>
                    </nav>
                    <div class="copyright ml-auto">
                        {{-- 2018, made with <i class="fa fa-heart heart text-danger"></i> by <a href="https://www.themekita.com">ThemeKita</a> --}}
                        {{ \Carbon\Carbon::now()->format('Y') }}

                    </div>
                </div>
            </footer>
        </div>

        <!-- Custom template | don't include it in your project! -->
        <div class="custom-template">
            <div class="title">Settings</div>
            <div class="custom-content">
                <div class="switcher">
                    <div class="switch-block">
                        <h4>Logo Header</h4>
                        <div class="btnSwitch">
                            <button type="button" class="changeLogoHeaderColor" data-color="dark"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="blue"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="green"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="red"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="white"></button>
                            <br />
                            <button type="button" class="selected changeLogoHeaderColor"
                                data-color="dark2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
                        </div>
                    </div>
                    <div class="switch-block">
                        <h4>Navbar Header</h4>
                        <div class="btnSwitch">
                            <button type="button" class="selected changeTopBarColor" data-color="dark"></button>
                            <button type="button" class="changeTopBarColor" data-color="blue"></button>
                            <button type="button" class="changeTopBarColor" data-color="purple"></button>
                            <button type="button" class="changeTopBarColor" data-color="light-blue"></button>
                            <button type="button" class="changeTopBarColor" data-color="green"></button>
                            <button type="button" class="changeTopBarColor" data-color="orange"></button>
                            <button type="button" class="changeTopBarColor" data-color="red"></button>
                            <button type="button" class="changeTopBarColor" data-color="white"></button>
                            <br />
                            <button type="button" class="changeTopBarColor" data-color="dark2"></button>
                            <button type="button" class="changeTopBarColor" data-color="blue2"></button>
                            <button type="button" class="changeTopBarColor" data-color="purple2"></button>
                            <button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
                            <button type="button" class="changeTopBarColor" data-color="green2"></button>
                            <button type="button" class="changeTopBarColor" data-color="orange2"></button>
                            <button type="button" class="changeTopBarColor" data-color="red2"></button>
                        </div>
                    </div>
                    <div class="switch-block">
                        <h4>Sidebar</h4>
                        <div class="btnSwitch">
                            <button type="button" class="changeSideBarColor" data-color="white"></button>
                            <button type="button" class="changeSideBarColor" data-color="dark"></button>
                            <button type="button" class="selected changeSideBarColor" data-color="dark2"></button>
                        </div>
                    </div>
                    <div class="switch-block">
                        <h4>Background</h4>
                        <div class="btnSwitch">
                            <button type="button" class="changeBackgroundColor" data-color="bg2"></button>
                            <button type="button" class="changeBackgroundColor selected" data-color="bg1"></button>
                            <button type="button" class="changeBackgroundColor" data-color="bg3"></button>
                            <button type="button" class="selected changeBackgroundColor" data-color="dark"></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-toggle">
                <i class="flaticon-settings"></i>
            </div>
        </div>
        <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->

    <script src="{{ asset('../assets/js/core/jquery.3.2.1.min.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="{{ asset('../assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('../assets/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ asset('../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('../assets/js/plugin/chart.js/chart.min.js') }}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('../assets/js/plugin/chart-circle/circles.min.js') }}"></script>



    {{-- <script src="{{ asset('../assets/js/plugin/datatables/datatables.min.js') }}"></script> --}}

    <!-- Bootstrap Notify -->
    <script src="{{ asset('../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- jQuery Vector Maps -->
    <script src="{{ asset('../assets/js/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('../assets/js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- <script src="{{ asset('../assets/js/select2.min.js') }}"></script> --}}

    <!-- Sweet Alert -->
    <script src="{{ asset('../assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Atlantis JS -->
    <script src="{{ asset('../assets/js/atlantis.min.js') }}"></script>


    <script src="{{ asset('../assets/js/setting-demo.js') }}"></script>
    {{-- <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script> --}}


    <script>
        $('#lineChart').sparkline([102, 109, 120, 99, 110, 105, 115], {
            type: 'line',
            height: '70',
            width: '100%',
            lineWidth: '2',
            lineColor: 'rgba(255, 255, 255, .5)',
            fillColor: 'rgba(255, 255, 255, .15)'
        });

        $('#lineChart2').sparkline([99, 125, 122, 105, 110, 124, 115], {
            type: 'line',
            height: '70',
            width: '100%',
            lineWidth: '2',
            lineColor: 'rgba(255, 255, 255, .5)',
            fillColor: 'rgba(255, 255, 255, .15)'
        });

        $('#lineChart3').sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: 'line',
            height: '70',
            width: '100%',
            lineWidth: '2',
            lineColor: 'rgba(255, 255, 255, .5)',
            fillColor: 'rgba(255, 255, 255, .15)'
        });
    </script>
    <script>
        $(document).ready(function() {

            $(".js-example-tokenizer").select2({
                tags: true,
                tokenSeparators: [',', ' ']
            })

        });
    </script>
    @stack('scripts')
</body>

</html>

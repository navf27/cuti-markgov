<header class="main-nav">
    <div class="sidebar-user text-center">
        <a class="setting-primary" href="javascript:void(0)" data-bs-toggle="modal"
        data-bs-target="#changeAvatarModal"><i data-feather="settings"></i></a><img
            class="img-90 rounded-circle" src="{{ $pegawai_data->user->avatar }}"
            alt="" />
        {{-- <div class="badge-bottom"><span class="badge badge-primary">New</span></div> --}}
        <a href="javascript:void(0)">
            <h6 class="mt-3 f-14 f-w-600">{{Auth::user()->name}}</h6>
        </a>
        <p class="mb-0 font-roboto">{{$pegawai_data->divisi->nama_divisi}}</p>
        
        <a href="javascript:void(0)">
            <h6 class="mt-3 f-14 f-w-600 pb-0 mb-0">Informasi Cuti</h6>
        </a>
        <ul>
            <li>
                <span><span class="counter">{{$pegawai_data->jum_cuti}}</span> hari</span>
                <p>Kuota</p>
            </li>
            <li>
                <span>{{$pegawai_data->cuti_bulan}} hari</span>
                <p>Bulan Ini</p>
            </li>
            <li>
                <span><span class="counter">{{$pegawai_data->cuti_tahun}}</span> hari</span>
                <p>Tahun Ini</p>
            </li>
        </ul>
    </div>
    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i
                                class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>General</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="{{route('home')}}"><i
                                data-feather="home"></i><span>Dashboard</span></a>
                    </li>
                    {{-- <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i
                                data-feather="airplay"></i><span>Widgets</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="../widgets/general-widget.html" class="">General</a></li>
                            <li><a href="../widgets/chart-widget.html" class="">Chart</a></li>
                        </ul>
                    </li> --}}
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="{{route('user.password.edit')}}"><i data-feather="user"></i><span>Change Password</span></a>
                    </li>

                    <li class="sidebar-main-title">
                        <div>
                            <h6>Master</h6>
                        </div>
                    </li>
                    @if (Auth::user()->role == '1' || Auth::user()->role == '2')
                    <li class="dropdown">
                        <a class="nav-link " href={{ Auth::user()->role == '1' ? route('pegawai.index') : route('pegawai_kepala.index')}}><i
                                data-feather="box"></i><span>Data Pegawai</span></a>
                    </li>
                    @endif
                    <li class="dropdown">
                        <a class="nav-link " href={{route('divisi.index')}}><i
                            data-feather="box"></i><span>Data Divisi</span></a>
                    </li>
                    
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Daily Report</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="{{ route('daily.index') }}"><i data-feather="activity"></i></i><span>Daily Report</span></a>
                    </li>
                    @if (Auth::user()->role == '1' || Auth::user()->role == '2' ) 
                    <li class="dropdown">
                        <a class="nav-link " href={{ Auth::user()->role == '1' ? route('admin.daily.report') : route('daily.report')}}><i
                                data-feather="activity"></i><span>Report Daily Pegawai</span></a>
                    </li>
                    @endif

                    <li class="sidebar-main-title">
                        <div>
                            <h6>Cuti</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link " href="{{route('cuti.create')}}"><i
                                data-feather="server"></i><span>Pengajuan Cuti</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="../bootstrap-tables/bootstrap-basic-table.html"
                                    class="">Basic Tables</a></li>
                            <li><a href="../bootstrap-tables/bootstrap-sizing-table.html"
                                    class="">Sizing Tables</a></li>
                            <li><a href="../bootstrap-tables/bootstrap-border-table.html"
                                    class="">Border Tables</a></li>
                            <li><a href="../bootstrap-tables/bootstrap-styling-table.html"
                                    class="">Styling Tables</a></li>
                            <li><a href="../bootstrap-tables/table-components.html" class="">Table
                                    components</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link " href="{{route('cuti.index')}}"><i
                                data-feather="database"></i><span>Cuti Saya</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="../data-tables/datatable-basic-init.html" class="">Basic
                                    Init</a></li>
                            <li><a href="../data-tables/datatable-advance.html" class="">Advance
                                    Init</a></li>
                            <li><a href="../data-tables/datatable-styling.html" class="">Styling</a>
                            </li>
                            <li><a href="../data-tables/datatable-AJAX.html" class="">AJAX</a></li>
                            <li><a href="../data-tables/datatable-server-side.html" class="">Server
                                    Side</a></li>
                            <li><a href="../data-tables/datatable-plugin.html" class="">Plug-in</a>
                            </li>
                            <li><a href="../data-tables/datatable-API.html" class="">API</a></li>
                            <li><a href="../data-tables/datatable-data-source.html" class="">Data
                                    Sources</a></li>
                        </ul>
                    </li>
                    @if (Auth::user()->role == "1")
                    <li class="dropdown">
                        <a class="nav-link " href={{route('cuti.admin.fingerprint')}}><i class="fas fa-fingerprint me-3"></i><span>Check Fingerprint</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link " href={{route('cuti.admin.index')}}><i
                            data-feather="box"></i><span>Data Cuti Pegawai</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link " href="{{route('cuti.laporan.index')}}"><i data-feather="file"></i><span>Cetak Rekap Laporan</span></a>
                    </li>
                    @elseif(Auth::user()->role == "2")
                    <li class="dropdown">
                        <a class="nav-link " href={{route('cuti.kepala.index')}}><i
                            data-feather="box"></i><span>Data Cuti Pegawai</span></a>
                    </li>
                    @endif
                    <li class="dropdown mb-5">
                        <a class="nav-link " href="{{route('jadwal.index')}}"><i data-feather="database"></i><span>Jadwal Cuti dan</span><br><span class="ms-4">&nbsp;&nbsp;Libur Nasional</span></a>
                    </li>
                    {{-- <li class="sidebar-main-title">
                        <div>
                            <h6>Applications</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i
                                data-feather="box"></i><span>Project </span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="../project/projects.html" class="">Project List</a></li>
                            <li><a href="../project/projectcreate.html" class="">Create new </a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav " href="../file-manager.html"><i
                                data-feather="git-pull-request"></i><span>File manager</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav " href="../kanban.html"><i
                                data-feather="monitor"></i><span>Kanban Board</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i
                                data-feather="shopping-bag"></i><span>Ecommerce</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="../ecommerce/product.html" class="">Product</a></li>
                            <li><a href="../ecommerce/product-page.html" class="">Product page</a>
                            </li>
                            <li><a href="../ecommerce/list-products.html" class="">Product list</a>
                            </li>
                            <li><a href="../ecommerce/payment-details.html" class="">Payment
                                    Details</a></li>
                            <li><a href="../ecommerce/order-history.html" class="">Order History</a>
                            </li>
                            <li><a href="../ecommerce/invoice-template.html" class="">Invoice</a>
                            </li>
                            <li><a href="../ecommerce/cart.html" class="">Cart</a></li>
                            <li><a href="../ecommerce/list-wish.html" class="">Wishlist</a></li>
                            <li><a href="../ecommerce/checkout.html" class="">Checkout</a></li>
                            <li><a href="../ecommerce/pricing.html" class="">Pricing</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i
                                data-feather="mail"></i><span>Email</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="../email/email_inbox.html" class="">Mail Inbox</a></li>
                            <li><a href="../email/email_read.html" class="">Read mail</a></li>
                            <li><a href="../email/email_compose.html" class="">Compose</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i
                                data-feather="message-circle"></i><span>Chat</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="../chat/chat.html" class="">Chat App</a></li>
                            <li><a href="../chat/chat-video.html" class="">Video chat</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i
                                data-feather="users"></i><span>Users</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="../users/user-profile.html" class="">Users Profile</a></li>
                            <li><a href="../users/edit-profile.html" class="">Users Edit</a></li>
                            <li><a href="../users/user-cards.html" class="">Users Cards</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav " href="../bookmark.html"><i
                                data-feather="heart"></i><span>Bookmarks</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav " href="../contacts.html"><i
                                data-feather="list"></i><span>Contacts</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav " href="../task.html"><i
                                data-feather="check-square"></i><span>Tasks</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav " href="../calendar-basic.html"><i
                                data-feather="calendar"></i><span>Calender </span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav " href="../social-app.html"><i
                                data-feather="zap"></i><span>Social App</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav " href="../to-do.html"><i
                                data-feather="clock"></i><span>To-Do</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav " href="../search.html"><i
                                data-feather="search"></i><span>Search Result</span></a>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Pages</h6>
                        </div>
                    </li>
                    <li>

                    </li>
                    <li>
                        <a class="nav-link menu-title link-nav " href="../sample-page.html"><i
                                data-feather="file"></i><span>Sample page</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav " href="../internationalization.html"><i
                                data-feather="aperture"></i><span>Internationalization</span></a>
                    </li>
                    <li class="mega-menu">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i
                                data-feather="layers"></i><span>Others</span></a>
                        <div class="mega-menu-container menu-content" style="display: none;">
                            <div class="container">
                                <div class="row">
                                    <div class="col mega-box">
                                        <div class="link-section">
                                            <div class="submenu-title">
                                                <h5>Error Page</h5>
                                            </div>
                                            <div class="submenu-content opensubmegamenu">
                                                <ul>
                                                    <li><a href="../error-page1.html" class=""
                                                            target="_blank">Error page 1</a></li>
                                                    <li><a href="../error-page2.html" class=""
                                                            target="_blank">Error page 2</a></li>
                                                    <li><a href="../error-page3.html" class=""
                                                            target="_blank">Error page 3</a></li>
                                                    <li><a href="../error-page4.html" class=""
                                                            target="_blank">Error page 4 </a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col mega-box">
                                        <div class="link-section">
                                            <div class="submenu-title">
                                                <h5>Authentication</h5>
                                            </div>
                                            <div class="submenu-content opensubmegamenu">
                                                <ul>
                                                    <li><a href="../login.html" class=""
                                                            target="_blank">Login Simple</a></li>
                                                    <li><a href="../login_one.html" class=""
                                                            target="_blank">Login with bg image</a></li>
                                                    <li><a href="../login_two.html" class=""
                                                            target="_blank">Login with image two </a></li>
                                                    <li><a href="../login-bs-validation.html"
                                                            class="" target="_blank">Login With
                                                            validation</a></li>
                                                    <li><a href="../login-bs-tt-validation.html"
                                                            class="" target="_blank">Login with
                                                            tooltip</a></li>
                                                    <li><a href="../login-sa-validation.html"
                                                            class="" target="_blank">Login with
                                                            sweetalert</a></li>
                                                    <li><a href="../sign-up.html" class=""
                                                            target="_blank">Register Simple</a></li>
                                                    <li><a href="../sign-up-one.html" class=""
                                                            target="_blank">Register with Bg Image </a>
                                                    </li>
                                                    <li><a href="../sign-up-two.html" class=""
                                                            target="_blank">Register with Bg video </a>
                                                    </li>
                                                    <li><a href="../unlock.html" class="">Unlock
                                                            User</a></li>
                                                    <li><a href="../forget-password.html"
                                                            class="">Forget Password</a></li>
                                                    <li><a href="../creat-password.html"
                                                            class="">Creat Password</a></li>
                                                    <li><a href="../maintenance.html"
                                                            class="">Maintenance</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col mega-box">
                                        <div class="link-section">
                                            <div class="submenu-title">
                                                <h5>Coming Soon</h5>
                                            </div>
                                            <div class="submenu-content opensubmegamenu">
                                                <ul>
                                                    <li><a href="../comingsoon.html" class="">Coming
                                                            Simple</a></li>
                                                    <li><a href="../comingsoon-bg-video.html"
                                                            class="">Coming with Bg video</a></li>
                                                    <li><a href="../comingsoon-bg-img.html"
                                                            class="">Coming with Bg Image</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col mega-box">
                                        <div class="link-section">
                                            <div class="submenu-title">
                                                <h5>Email templates</h5>
                                            </div>
                                            <div class="submenu-content opensubmegamenu">
                                                <ul>
                                                    <li><a href="../basic-template.html"
                                                            class="">Basic Email</a></li>
                                                    <li><a href="../email-header.html"
                                                            class="">Basic With Header</a></li>
                                                    <li><a href="../template-email.html"
                                                            class="">Ecomerce Template</a></li>
                                                    <li><a href="../template-email-2.html"
                                                            class="">Email Template 2</a></li>
                                                    <li><a href="../ecommerce-templates.html"
                                                            class="">Ecommerce Email</a></li>
                                                    <li><a href="../email-order-success.html"
                                                            class="">Order Success </a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Miscellaneous</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i
                                data-feather="image"></i><span>Gallery</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="../gallery.html" class="">Gallery Grid</a></li>
                            <li><a href="../gallery/gallery-with-description.html" class="">Gallery
                                    Grid Desc</a></li>
                            <li><a href="../gallery/gallery-masonry.html" class="">Masonry
                                    Gallery</a></li>
                            <li><a href="../gallery/masonry-gallery-with-disc.html" class="">Masonry
                                    with Desc</a></li>
                            <li><a href="../gallery/gallery-hover.html" class="">Hover Effects</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i
                                data-feather="edit"></i><span>Blog</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="../blog.html" class="">Blog Details</a></li>
                            <li><a href="../blog/blog-single.html" class="">Blog Single</a></li>
                            <li><a href="../blog/add-post.html" class="">Add Post</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="nav-link menu-title link-nav " href="../faq.html"><i
                                data-feather="help-circle"></i><span>FAQ</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i
                                data-feather="user-check"></i><span>Job Search</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="../job-search/job-cards-view.html" class="">Cards view</a>
                            </li>
                            <li><a href="../job-search/job-list-view.html" class="">List View</a>
                            </li>
                            <li><a href="../job-search/job-details.html" class="">Job Details</a>
                            </li>
                            <li><a href="../job-search/job-apply.html" class="">Apply</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i
                                data-feather="layers"></i><span>Learning</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="../learning/learning-list-view.html" class="">Learning
                                    List</a></li>
                            <li><a href="../learning/learning-detailed.html" class="">Detailed
                                    Course</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i
                                data-feather="map"></i><span>Maps</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="../maps/map-js.html" class="">Maps JS</a></li>
                            <li><a href="../maps/vector-map.html" class="">Vector Maps</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i
                                data-feather="git-pull-request"></i><span>Editors</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="../editors/summernote.html" class="">Summer Note</a></li>
                            <li><a href="../editors/ckeditor.html" class="">CK editor</a></li>
                            <li><a href="../editors/simple-MDE.html" class="">MDE editor</a></li>
                            <li><a href="../editors/ace-code-editor.html" class="">ACE code
                                    editor</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="nav-link menu-title link-nav " href="../knowledgebase.html"><i
                                data-feather="database"></i><span>Knowledgebase</span></a>
                    </li> --}}
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>
<!--==============================
    Sidemenu
============================== -->
<div class="sidemenu-wrapper sidemenu-info ">
    <div class="sidemenu-content">
        <button class="closeButton sideMenuCls"><i class="fas fa-times"></i></button>
        <div class="widget  ">
            <div class="th-widget-about">
                <div class="about-logo">
                    <a href="index.html"><img src="{{URL::to('/')}}/templates/landing-page/assets/img/logo.svg" alt="Laun"></a>
                </div>
                <p class="about-text">We provide specialized winterization services to safeguard your pool during
                    the off-season, and when spring arrives, we handle the thorough opening process.</p>
                <div class="social-links">
                    <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.twitter.com/"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                    <a href="https://www.whatsapp.com/"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </div>
        <div class="side-info mb-30">
            <div class="contact-list mb-20">
                <h4>Office Address</h4>
                <p>1212, Lav Vegas, The Veg Street, USA</p>
            </div>
            <div class="contact-list mb-20">
                <h4>Phone Number</h4>
                <p class="mb-0">+880 123 45 67 89</p>
                <p>+880 765 86 43 85</p>
            </div>
            <div class="contact-list mb-20">
                <h4>Email Address</h4>
                <p class="mb-0">yourmail@gmail.com</p>
                <p>example.mail@hum.com</p>
            </div>
        </div>
    </div>
</div>

<!--==============================
    Mobile Menu
    ============================== -->
<div class="mobile-menu-wrapper">
    <div class="mobile-menu-area">
        <div class="mobile-logo">
            <a href="index.html"><img src="{{URL::to('/')}}/templates/landing-page/assets/img/logo.svg" alt="Bizmaster"></a>
            <button class="menu-toggle"><i class="fa fa-times"></i></button>
        </div>
        <div class="mobile-menu">
            <ul>
                <li>
                    <a href="{{route('landing-page.home.index')}}">Home</a>
                </li>
                <li>
                    <a href="{{route('landing-page.home.index')}}">Daftar Buku</a>
                </li>
                <li>
                    <a href="{{route('landing-page.home.index')}}">Daftar Antrian</a>
                </li>
                <li>
                    <a href="{{route('landing-page.contacts.index')}}">Hubungi Kami</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!--==============================
	Header Area
    ==============================-->
<header class="nav-header header-layout1">
    <div class="sticky-wrapper">
        <!-- Main Menu Area -->
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto">
                    <div class="header-logo">
                        <a href="index.html"><img src="{{URL::to('/')}}/templates/landing-page/assets/img/logo.svg" alt="logo"></a>
                    </div>
                </div>
                <div class="col-auto ms-xl-auto">
                    <nav class="main-menu d-none d-lg-inline-block">
                        <ul>
                            <li>
                                <a href="{{route('landing-page.home.index')}}">Home</a>
                            </li>
                            <li>
                                <a href="{{route('landing-page.home.index')}}">Daftar Buku</a>
                            </li>
                            <li>
                                <a href="{{route('landing-page.home.index')}}">Daftar Antrian</a>
                            </li>
                            <li>
                                <a href="{{route('landing-page.contacts.index')}}">Hubungi Kami</a>
                            </li>
                        </ul>
                    </nav>
                    <div class="navbar-right d-inline-flex d-lg-none">
                        <button type="button" class="menu-toggle icon-btn"><i class="fas fa-bars"></i></button>
                    </div>
                </div>
                <div class="col-auto ms-xxl-4 d-xl-block d-none">
                    <div class="header-wrapper">
                        <div class="header-button">
                            <a href="#" class="simple-icon sideMenuToggler d-none d-lg-block"> <img src="{{URL::to('/')}}/templates/landing-page/assets/img/icon/bars.svg" alt=""> </a>
                        </div>
                        <div class="social-links">
                            <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                            <a href="https://www.linkedin.com/"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
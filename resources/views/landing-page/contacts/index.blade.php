@extends("landing-page.templates.main")

@section("title","Hubungi Kami")

@section("css")
@endsection("css")

@section("content")
<div class="breadcumb-wrapper">
    <!-- bg animated image/ -->
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="breadcumb-content text-center">
                    <h1 class="breadcumb-title">Hubungi Kami</h1>
                    <ul class="breadcumb-menu">
                        <li><a href="{{route('landing-page.home.index')}}">Home</a></li>
                        <li class="active">Hubungi Kami</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="space-bottom mt-5">
    <div class="container">
        <div class="row gy-40 justify-content-between">
            <div class="col-lg-4">
                <div class="title-area mb-0">
                    <span class="sub-title"><img src="{{URL::to('/')}}/templates/landing-page/assets/img/icon/title_left.svg" alt="shape">Contact Us</span>
                    <h2 class="sec-title style2">Get In Touch</h2>
                    <p class="mb-40">Design is this a broad category encompasses various technological solutions </p>
                    <div class="social-btn style4">
                        <a href="https://facebook.com/" tabindex="-1"><i class="fab fa-youtube"></i></a>
                        <a href="https://www.instagram.com/" tabindex="-1"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-8">
                <form method="post" id="frmStore" onsubmit="return confirm('Apakah anda yakin ingin mengirim data ini?')" action="{{route('landing-page.contacts.store')}}" class="contact-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="text" placeholder="Nama Lengkap" name="name" class="form-control style-border" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <input type="text" placeholder="No. HP" name="phone" class="form-control style-border" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <input type="email" placeholder="Email" name="email" class="form-control style-border" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <input type="text" placeholder="Subjek" name="subject" class="form-control style-border" required>
                        </div>
                        <div class="col-12 form-group">
                            <textarea placeholder="Pesan" class="form-control style-border" name="message" required></textarea>
                        </div>
                        <div class="col-12 form-group mb-0">
                            <button class="global-btn w-100">Kirim Pesan<img src="{{URL::to('/')}}/templates/landing-page/assets/img/icon/right-icon.svg" alt=""></button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection("content")

@section("script")
@endsection("script")
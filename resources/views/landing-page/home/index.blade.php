@extends("landing-page.templates.main")

@section("title","Home")

@section("css")
@endsection("css")

@section("content")
<!--==============================
    Hero Area
    ==============================-->
<div class="hero-wrapper bg-smoke hero-1" id="hero" style="background-image: url(assets/img/hero/hero_bg_1_1.png);">
    <div class="container">
        <div class="row align-items-end">

            <div class="col-xl-6">
                <div class="hero-style1">
                    <span class="sub-title"><img src="{{URL::to('/')}}/templates/landing-page/assets/img/icon/title_left.svg" alt="shape">Growth Accel
                        erato</span>
                    <h1 class="hero-title">Transform Your Business Into Profession</h1>
                    <p class="hero-text">A business consultant is a professional who provides expert advice and
                        guidance to businesses on various aspects such</p>

                    <div class="btn-group">
                        <a href="about.html" class="global-btn">Daftar Buku</a>
                        <a href="service.html" class="global-btn style-border">Daftar Antrian</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="hero-image-wrapp">
                    <div class="hero-thumb text-center">
                        <img src="{{URL::to('/')}}/templates/landing-page/assets/img/hero/hero_thumb_1_1.png" alt="img">
                    </div>
                    <div class="hero-shape1"></div>
                    <div class="hero-shape2"></div>
                    <div class="hero-shape3"></div>
                    <div class="hero-shape4"></div>
                    <div class="hero-shape5 spin"></div>
                </div>

            </div>
        </div>
    </div>
</div>
<!--======== / Hero Section ========-->

<!--==============================
    About Area  
    ==============================-->
<div class="about-area-1 position-relative space-top mt-5">
    <div class="about1-shape-img1">
        <img class="about1-shape-img-1" src="{{URL::to('/')}}/templates/landing-page/assets/img/normal/about_shape1-1.jpg" alt="img">
    </div>
    <div class="about1-shape-img2">
        <img class="about1-shape-img-2" src="{{URL::to('/')}}/templates/landing-page/assets/img/normal/about_shape1-2.png" alt="img">
    </div>
    <div class="container">
        <div class="row gx-60 align-items-center">
            <div class="col-xl-6">
                <div class="about-content-wrap">
                    <div class="title-area me-xl-5 mb-20">
                        <span class="sub-title"><img src="{{URL::to('/')}}/templates/landing-page/assets/img/icon/title_left.svg" alt="shape">About
                            Us</span>
                        <h2 class="sec-title">Achieve Your a of Business </h2>
                        <p class="sec-text mb-35">Use receiving aco growin number of currencies and get paid like
                            design receiving aco grow</p>
                    </div>
                    <div class="achive-about">
                        <div class="achive-about_content">
                            <div class="achive-about_icon">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="media-body">
                                <h3 class="box-title">Strategic Solutions Pro</h3>
                                <p class="achive-about_text">There are many variati of passages of engineer's
                                    available. The majority have suffered alteration in engineer's available.</p>
                            </div>
                        </div>
                    </div>
                    <div class="achive-about">
                        <div class="achive-about_content">
                            <div class="achive-about_icon">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="media-body">
                                <h3 class="box-title">Performance Enhancement Partners</h3>
                                <p class="achive-about_text">There are many variati of passages of engineer's
                                    available. The majority have suffered alteration in engineer's available.</p>
                            </div>
                        </div>
                    </div>
                    <div class="btn-wrap mt-20">
                        <a href="about.html" class="global-btn mt-xl-0 mt-20">Read More <i class="fas fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="goal-area space-top mt-5 mb-5">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-lg-6">
                <div class="title-area">
                    <span class="sub-title"><img src="{{URL::to('/')}}/templates/landing-page/assets/img/icon/title_left.svg" alt="shape">Our Goal</span>
                    <h2 class="sec-title style2">Partnering Business for Success</h2>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="goal-title-area">
                    <p class="">There are many variati of passages of engineer's available. have suffered alteration
                        in engineer's available</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="goal-tabs-wrapper">
                <div class="nav nav-tabs goal-tabs-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link" id="nav-step1-tab" data-bs-toggle="tab" data-bs-target="#nav-step1" type="button">Biography</button>
                    <button class="nav-link" id="nav-step2-tab" data-bs-toggle="tab" data-bs-target="#nav-step2" type="button">Education</button>
                    <button class="nav-link active" id="nav-step3-tab" data-bs-toggle="tab" data-bs-target="#nav-step3" type="button">Experience</button>
                    <button class="nav-link" id="nav-step4-tab" data-bs-toggle="tab" data-bs-target="#nav-step1" type="button">Biography</button>
                </div>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade" id="nav-step1" role="tabpanel">
                        <div class="goal-list_wrapper">
                            <div class="goal-content_wrapp">
                                <img src="{{URL::to('/')}}/templates/landing-page/assets/img/icon/angles-left.svg" alt="">
                                <div class="goal-content">
                                    <h4 class="box-title">Performance
                                        Enhancement Partners</h4>
                                    <p>Strategic Solutions Pro</p>
                                    <div class="checklist">
                                        <ul>
                                            <li><i class="fas fa-check"></i>Success Accelerators</li>
                                            <li><i class="fas fa-check"></i>Started politician Club</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="goal-content_wrapp">
                                <img src="{{URL::to('/')}}/templates/landing-page/assets/img/icon/angles-left.svg" alt="">
                                <div class="goal-content">
                                    <h4 class="box-title">Management Mastery Consultan</h4>
                                    <p>Profitability Maximizers</p>
                                    <div class="checklist">
                                        <ul>
                                            <li><i class="fas fa-check"></i>Success Accelerators</li>
                                            <li><i class="fas fa-check"></i>Started politician Club</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="goal-content_wrapp">
                                <img src="{{URL::to('/')}}/templates/landing-page/assets/img/icon/angles-left.svg" alt="">
                                <div class="goal-content">
                                    <h4 class="box-title">Operational Excellence Solutions</h4>
                                    <p>Framer Designer & Developer</p>
                                    <div class="checklist">
                                        <ul>
                                            <li><i class="fas fa-check"></i>Success Accelerators</li>
                                            <li><i class="fas fa-check"></i>Started politician Club</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="goal-content_wrapp">
                                <img src="{{URL::to('/')}}/templates/landing-page/assets/img/icon/angles-left.svg" alt="">
                                <div class="goal-content">
                                    <h4 class="box-title">Transformational Strategy</h4>
                                    <p>Efficiency Experts</p>
                                    <div class="checklist">
                                        <ul>
                                            <li><i class="fas fa-check"></i>Success Accelerators</li>
                                            <li><i class="fas fa-check"></i>Started politician Club</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-step2" role="tabpanel">
                        <div class="goal-list_wrapper">
                            <div class="goal-content_wrapp">
                                <img src="{{URL::to('/')}}/templates/landing-page/assets/img/icon/angles-left.svg" alt="">
                                <div class="goal-content">
                                    <h4 class="box-title">Performance
                                        Enhancement Partners</h4>
                                    <p>Strategic Solutions Pro</p>
                                    <div class="checklist">
                                        <ul>
                                            <li><i class="fas fa-check"></i>Success Accelerators</li>
                                            <li><i class="fas fa-check"></i>Started politician Club</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="goal-content_wrapp">
                                <img src="{{URL::to('/')}}/templates/landing-page/assets/img/icon/angles-left.svg" alt="">
                                <div class="goal-content">
                                    <h4 class="box-title">Management Mastery Consultan</h4>
                                    <p>Profitability Maximizers</p>
                                    <div class="checklist">
                                        <ul>
                                            <li><i class="fas fa-check"></i>Success Accelerators</li>
                                            <li><i class="fas fa-check"></i>Started politician Club</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="goal-content_wrapp">
                                <img src="{{URL::to('/')}}/templates/landing-page/assets/img/icon/angles-left.svg" alt="">
                                <div class="goal-content">
                                    <h4 class="box-title">Operational Excellence Solutions</h4>
                                    <p>Framer Designer & Developer</p>
                                    <div class="checklist">
                                        <ul>
                                            <li><i class="fas fa-check"></i>Success Accelerators</li>
                                            <li><i class="fas fa-check"></i>Started politician Club</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="goal-content_wrapp">
                                <img src="{{URL::to('/')}}/templates/landing-page/assets/img/icon/angles-left.svg" alt="">
                                <div class="goal-content">
                                    <h4 class="box-title">Transformational Strategy</h4>
                                    <p>Efficiency Experts</p>
                                    <div class="checklist">
                                        <ul>
                                            <li><i class="fas fa-check"></i>Success Accelerators</li>
                                            <li><i class="fas fa-check"></i>Started politician Club</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade active show" id="nav-step3" role="tabpanel">
                        <div class="goal-list_wrapper">
                            <div class="goal-content_wrapp">
                                <img src="{{URL::to('/')}}/templates/landing-page/assets/img/icon/angles-left.svg" alt="">
                                <div class="goal-content">
                                    <h4 class="box-title">Performance
                                        Enhancement Partners</h4>
                                    <p>Strategic Solutions Pro</p>
                                    <div class="checklist">
                                        <ul>
                                            <li><i class="fas fa-check"></i>Success Accelerators</li>
                                            <li><i class="fas fa-check"></i>Started politician Club</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="goal-content_wrapp">
                                <img src="{{URL::to('/')}}/templates/landing-page/assets/img/icon/angles-left.svg" alt="">
                                <div class="goal-content">
                                    <h4 class="box-title">Management Mastery Consultan</h4>
                                    <p>Profitability Maximizers</p>
                                    <div class="checklist">
                                        <ul>
                                            <li><i class="fas fa-check"></i>Success Accelerators</li>
                                            <li><i class="fas fa-check"></i>Started politician Club</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="goal-content_wrapp">
                                <img src="{{URL::to('/')}}/templates/landing-page/assets/img/icon/angles-left.svg" alt="">
                                <div class="goal-content">
                                    <h4 class="box-title">Operational Excellence Solutions</h4>
                                    <p>Framer Designer & Developer</p>
                                    <div class="checklist">
                                        <ul>
                                            <li><i class="fas fa-check"></i>Success Accelerators</li>
                                            <li><i class="fas fa-check"></i>Started politician Club</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="goal-content_wrapp">
                                <img src="{{URL::to('/')}}/templates/landing-page/assets/img/icon/angles-left.svg" alt="">
                                <div class="goal-content">
                                    <h4 class="box-title">Transformational Strategy</h4>
                                    <p>Efficiency Experts</p>
                                    <div class="checklist">
                                        <ul>
                                            <li><i class="fas fa-check"></i>Success Accelerators</li>
                                            <li><i class="fas fa-check"></i>Started politician Club</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-step4" role="tabpanel">
                        <div class="goal-list_wrapper">
                            <div class="goal-content_wrapp">
                                <img src="{{URL::to('/')}}/templates/landing-page/assets/img/icon/angles-left.svg" alt="">
                                <div class="goal-content">
                                    <h4 class="box-title">Performance
                                        Enhancement Partners</h4>
                                    <p>Strategic Solutions Pro</p>
                                    <div class="checklist">
                                        <ul>
                                            <li><i class="fas fa-check"></i>Success Accelerators</li>
                                            <li><i class="fas fa-check"></i>Started politician Club</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="goal-content_wrapp">
                                <img src="{{URL::to('/')}}/templates/landing-page/assets/img/icon/angles-left.svg" alt="">
                                <div class="goal-content">
                                    <h4 class="box-title">Management Mastery Consultan</h4>
                                    <p>Profitability Maximizers</p>
                                    <div class="checklist">
                                        <ul>
                                            <li><i class="fas fa-check"></i>Success Accelerators</li>
                                            <li><i class="fas fa-check"></i>Started politician Club</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="goal-content_wrapp">
                                <img src="{{URL::to('/')}}/templates/landing-page/assets/img/icon/angles-left.svg" alt="">
                                <div class="goal-content">
                                    <h4 class="box-title">Operational Excellence Solutions</h4>
                                    <p>Framer Designer & Developer</p>
                                    <div class="checklist">
                                        <ul>
                                            <li><i class="fas fa-check"></i>Success Accelerators</li>
                                            <li><i class="fas fa-check"></i>Started politician Club</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="goal-content_wrapp">
                                <img src="{{URL::to('/')}}/templates/landing-page/assets/img/icon/angles-left.svg" alt="">
                                <div class="goal-content">
                                    <h4 class="box-title">Transformational Strategy</h4>
                                    <p>Efficiency Experts</p>
                                    <div class="checklist">
                                        <ul>
                                            <li><i class="fas fa-check"></i>Success Accelerators</li>
                                            <li><i class="fas fa-check"></i>Started politician Club</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection("content")

@section("script")
@endsection("script")
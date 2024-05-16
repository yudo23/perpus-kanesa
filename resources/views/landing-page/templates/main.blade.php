<!doctype html>
<html class="no-js" lang="zxx">

<head>
    @include("landing-page.templates.head")
</head>

<body>

    @include('sweetalert::alert')

    <div class="preloader ">
        <div class="preloader-inner">
            <span class="loader"></span>
        </div>
    </div>

    @include("landing-page.templates.topbar")

    @yield("content")

    @include("landing-page.templates.footer")

    <div class="scroll-top">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;">
            </path>
        </svg>
    </div>

    @include("landing-page.templates.script")
</body>

</html>
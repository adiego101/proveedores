<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />


    <title>SIPLIC</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- Styles -->
    <style>
        .et_pb_fullwidth_header_0.et_pb_module {
            margin-left: auto !important;
            margin-right: auto !important;
        }

        .et_pb_fullwidth_header.et_pb_fullwidth_header_0,
        .et_pb_fullwidth_header.et_pb_fullwidth_header_0:hover {
            background-image: linear-gradient(180deg, rgb(23, 162, 184) 0%, rgba(33, 163, 192, 0.75) 100%), url(https://jefatura.santacruz.gob.ar/wp-content/uploads/2020/07/tumblr_ob2viybHy81qabbyto1_500.gif);
            /* background-image: linear-gradient(180deg,rgba(24,174,209,0.95) 0%,rgba(24,174,209,0.95) 100%),url(https://jefatura.santacruz.gob.ar/wp-content/uploads/2020/07/30b8174c6f1a07e0af9bcf41fec3a5f5.gif);*/
            background-color: #18aed1;
        }

        .et_pb_module.et_pb_text_align_center {
            text-align: center;
        }

        .et_pb_fullwidth_header_0 {
            min-height: 1000px;
            max-height: 1000px;
            padding-top: 0px;
            padding-bottom: 0px;

            width: 100% !important;
            max-width: 100% !important;
            position: static !important;
            top: 0px;
            right: auto;
            bottom: auto;
            left: 0px;
        }

        .et_pb_fullscreen {
            padding: 0;
            padding-top: 0px;
            padding-bottom: 0px;
        }

        .et_pb_fullwidth_header {
            padding: 100px 0;
            position: relative;
            background-position: 50%;
            background-size: cover;
        }

        .et_pb_module {
            -webkit-animation-timing-function: linear;
            animation-timing-function: linear;
            -webkit-animation-duration: .2s;
            animation-duration: .2s;
        }

        .et_pb_all_tabs,
        .et_pb_module,
        .et_pb_posts_nav a,
        .et_pb_tab,
        .et_pb_with_background {
            background-size: cover;
            background-position: 50%;
            background-repeat: no-repeat;
        }

        .et_pb_bg_layout_dark,
        .et_pb_bg_layout_dark h1,
        .et_pb_bg_layout_dark h2,
        .et_pb_bg_layout_dark h3,
        .et_pb_bg_layout_dark h4,
        .et_pb_bg_layout_dark h5,
        .et_pb_bg_layout_dark h6 {
            color: #fff !important;
        }

        article,
        aside,
        footer,
        header,
        hgroup,
        nav,
        section {
            display: block;
        }

        * {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;


        }

        html {
            overflow: hidden;
        }

    </style>

    <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}

        body {

            font-family: 'Nunito', sans-serif;

            overflow-x: hidden;
        }

    </style>
</head>

<body class="antialiased">
    <section
        class=" container et_pb_module et_pb_fullwidth_header et_pb_fullwidth_header_0 et_pb_section_parallax_hover et_pb_text_align_center et_pb_bg_layout_dark et_pb_fullscreen">

        <div class="  float-left fixed top-0 left-0 px-6 py-4 sm:block">
            <h1>SIPLIC</h1>
        </div>

        @if (Route::has('login'))

            <div class="  float-right fixed top-0 right-0 px-6 py-4 sm:block">

                @auth
                    <a class="btn btn-outline-light" href="{{ url('/home') }}"
                        class="text-sm text-gray-700 underline">Inicio</a>
                @else
                    <a class="btn btn-outline-light " href="{{ route('login') }}"
                        class="text-sm text-gray-700 underline">Iniciar Sesion</a>

                    {{-- @if (Route::has('register'))
                        <a class="btn btn-outline-light" href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Registrarse</a>
                    @endif --}}
                @endauth
            </div>
        @endif



        </div>

        <div class="et_pb_fullwidth_header_container center">
            <div class="header-content-container center">
                <div class="header-content">
                    <img  loading="lazy"
                        src="mefieescudi.png"
                        title="" alt=""
                        srcset="mefieescudi.png 622w, mefieescudi.png 188w"
                        sizes="(max-width: 622px) 100vw, 622px" class="header-logo wp-image-322"
                        height="380">



                </div>

            </div>
            <div class="et_pb_fullwidth_header_overlay"></div>
            <div class="et_pb_fullwidth_header_scroll"></div>
            <br>
            <br>
            <br>

            <footer class=" font-small bg-transparent">
                <!-- Copyright -->
                <div class="footer-copyright text-center py-3">© 2022 - Desarrollado por
                  <a href="#">Dir. de Proyectos de Innovación - Secretaría de Estado de Modernización e Innovación Tecnológica </a>.
                </div>
            </footer>
    </section>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>

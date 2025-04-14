<head>
    @yield('title')
    <meta name="description"
        content="Template admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
    <meta name="keywords"
        content="Template, bootstrap, bootstrap 5, Angular 11, VueJs, React, Laravel, admin themes, web design, figma, web development, ree admin themes, bootstrap admin, bootstrap dashboard" />
    <link rel="canonical" href="Https://preview.keenthemes.com/metronic8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="{{ url('template/demo1/assets/media/logos/favicon.ico') }}" />

    <!-- Preload an example WOFF2 font -->
    <link rel="preload" href="{{ url('template/demo1/assets/plugins/global/fonts/templatefont/cairo/Inter-Regular.woff') }}" as="font" type="font/woff" crossorigin>
    <link rel="preload" href="{{ url('template/demo1/assets/plugins/global/fonts/templatefont/cairo/Inter-Regular.woff2') }}" as="font" type="font/woff2" crossorigin>
    @include('partials._stylesheet')
    @yield('stylesheet')
</head>

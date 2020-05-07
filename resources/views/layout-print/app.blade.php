<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <script src="{{ asset('js/app.js') }}"></script>
        <title>Print Barcode</title>
    </head>
    <style>
        @page {
        size: @php $pageWidth; @endphp mm @php $pageHeight+ 0.4; @endphp mm; 
        margin:0; margin-header:0; 
        margin-footer:0;
    }
    
    
    
    @media print {
        .page-break { 
            page-break-after: always; 
            page-break-before: always; 
        }
    }
    
    div{
        text-align: center;
    }
    
    body {
        margin: 0;
        padding: 0;
    }
    
    img {
        max-width: 100%;
        max-height: 80%;
        margin-top: 3 !important;
        width: 100%; 
        image-resolution: 600dpi;
    }
    
    .text {
        margin-top: 0 !important;
        margin-bottom: 0 !important;
    
    }
    
    
    .main-label:not(:nth-last-child(1)) {
        margin: 0;
        padding: 0;
    
    }
    </style>

<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div id="app">

            @yield('content')

    </div>
</body>

<footer>

</footer>
</html>

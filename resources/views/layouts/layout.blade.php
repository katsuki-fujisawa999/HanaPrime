
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>１行日記サイト&nbsp;-&nbsp;@yield('title')</title>

        <!-- Fonts -->
        <link href="/js/jquery-ui.min.css" rel="stylesheet" />
        
        <!-- Script -->
        <script src="/js/jquery-3.6.3.min.js"></script>
        <script src="/js/jquery-ui.min.js"></script>
        <script src="/js/common.js?{{date("YmdHis")}}"></script>

    </head>
    <body>
        <div id="header">
            <header class="pageHeader">
                <div class="headerInner">
                    <div class="headerLogo" style="float:left;">
                        <a href="/">１行日記サイト</a>
                    </div>
                    
                </div>
            </header>
        </div>
        <br>
        <div id="menuObj" style="clear: both;"></div>
        <div class="content" style="clear: both;">
        @yield('content')
        </div>
    </body>
    <!-- マスク -->
    <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>
</html>
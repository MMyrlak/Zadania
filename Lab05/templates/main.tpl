<html>
    <head>
            <title>{$page_header|default:"Default Title"}</title>
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
            <link rel="stylesheet" href="{$conf->app_url}/assets/css/main.css" />
            <noscript><link rel="stylesheet" href="{$conf->app_url}/assets/css/noscript.css" /></noscript>
    </head>
<body class="landing is-preload">
<!-- Page Wrapper -->
	<div id="page-wrapper">
            <section id="banner">
                <div class="inner">
                    <h2>{$page_title|default:"Default Title"}</h2>
                    <p><i>{$page_descripton|default:"Default descripton"}</i></p>
                    <a href="http://html5up.net">HTML5 UP</a>
		</div>
                    <a href="#calc" class="more scrolly">Policz</a>
            </section>
                <!-- Kalkulator -->
                <section id="calc" class="wrapper style1 special">
                    <div class="inner">
                    {block name=content} Default page content{/block}
                    </div>
                </section>
	<!-- Footer -->
		<footer id="footer">
			<ul class="copyright">
				<li>&copy; MM</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
			</ul>
		</footer>
	</div>
	<!-- Scripts -->
	<script src="{$conf->app_url}/assets/js/jquery.min.js"></script>
	<script src="{$conf->app_url}/assets/js/jquery.scrollex.min.js"></script>
	<script src="{$conf->app_url}/assets/js/jquery.scrolly.min.js"></script>
	<script src="{$conf->app_url}/assets/js/browser.min.js"></script>
	<script src="{$conf->app_url}/assets/js/breakpoints.min.js"></script>
	<script src="{$conf->app_url}/assets/js/util.js"></script>
	<script src="{$conf->app_url}/assets/js/main.js"></script>
</body>
</html>
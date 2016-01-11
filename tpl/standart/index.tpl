<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>[_title]</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
	<meta name="keywords" content="[_keywords]" />
	<meta name="description" content="[_description]" />
	<link rel="stylesheet" href="[_tpl_path]css/style.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="[_tpl_path]css/nprogress.css" />
	<script src='[_tpl_path]js/jquery.js'></script>
	<script src='[_tpl_path]js/nprogress.js'></script> 
</head>
<body>
<script>
    NProgress.configure({ ease: 'ease', speed: 40, trickle: true, howSpinner: true, showSpinner: false});
    NProgress.start();
	NProgress.done();
</script>
<section id="wrap">
	<header id="header">
		<h1 class="logotype">
			<a href="/"></a>
		</h1>
		<div class="clr"></div>
	</header>
	<section id="middle_top">
	<!--МЕНЮ-->
		[_menu]
	<!--МЕНЮ-->	
	</section>
	<section id="middle">
		<div class="mainside">
			<div class="content">
				<!--ПОКАЗ СООБЩЕНИЙ-->
				[_msg]
				<!--ПОКАЗ СООБЩЕНИЙ-->
				<!--ТЕКСТ-->
				[_content]
				<!--ТЕКСТ-->
			</div>
			<div style="text-align:center; clear: both;">
				<div class="navi">
					<!--ПОСТРАНИЧНЫЙ ВЫВОД-->
					[_paginat]
					<!--ПОСТРАНИЧНЫЙ ВЫВОД-->
				</div>
			</div>
			<div class="clr"></div>
		</div>
	</section>
	<footer id="footer">
		<div class="copy">
			Copyright ZIM555 (2016)<a href="/"></a></br>
		</div>
	</footer>
</section>
</body>
</html>
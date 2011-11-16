<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Panel de administracion de Bravo</title>

<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="/css/custom-theme/jquery-ui-1.8.16.custom.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/css/fileuploader.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/admin_style.css" type="text/css" media="screen" />


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js" type="text/javascript"></script>

<script src="http://www.erichynds.com/examples/jquery-ui-multiselect-widget/src/jquery.multiselect.js" type="text/javascript"></script>
<script src="http://www.erichynds.com/examples/jquery-ui-multiselect-widget/src/jquery.multiselect.filter.js" type="text/javascript"></script>


<script type="text/javascript" src="/js/jquery.showLoading.js"></script>
<script type="text/javascript" src="http://valums.com/files/2009/ajax-upload/ajaxupload.3.6.js"></script>


<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.9.0/build/assets/skins/sam/skin.css">
<!-- Utility Dependencies -->
<script src="http://yui.yahooapis.com/2.9.0/build/yahoo-dom-event/yahoo-dom-event.js"></script> 
<script src="http://yui.yahooapis.com/2.9.0/build/element/element-min.js"></script> 
<!-- Needed for Menus, Buttons and Overlays used in the Toolbar -->
<script src="http://yui.yahooapis.com/2.9.0/build/container/container_core-min.js"></script>
<!-- Source file for Rich Text Editor-->
<script src="http://yui.yahooapis.com/2.9.0/build/editor/simpleeditor-min.js"></script>


</head>
<body class="yui-skin-sam">
<div id="header">
	<div class="column">
		<div class="primary-nav">
			<a class="logo-link" href="/index.php/admin">
			<div class="logo">
				Home
			</div> 
			</a>
			
			<a class="main-nav-link toppish <?=$sel_secciones?>" href="/index.php/admin/secciones">Secciones</a>
			<a class="main-nav-link toppish <?=$sel_sliders?>" href="/index.php/admin/sliders">Sliders</a>
			<a class="main-nav-link toppish <?=$sel_logos?>" href="/index.php/admin/logos">Logos</a>
			<a class="main-nav-link toppish <?=$sel_config?>" href="/index.php/admin/config">Configuracion</a>


		</div>
		<div class="secondary-nav toppish">
			<a href="/index.php/admin/logout" class="login">Logout</a>
		</div>
	</div>
</div>
<div id="content">
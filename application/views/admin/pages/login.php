<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Panel de administracion</title>
<link rel="stylesheet" href="<?=base_url()?>admin_style.css" type="text/css" media="screen" />
</head>
<body>
	

	<?php if($post): ?>
		<div class="red"><?=$message?></div>
	<?php elseif(isset($_GET['s'])): ?>
		<div class="green">Sesi&oacute;n cerrada con &eacute;xito</div>
	<?php else: ?>
		
	<?php endif; ?>	
	
     <form action="" method="post" enctype="application/x-www-form-urlencoded">
         
          <div class="box">
			<img src="<?=base_url()?>img/admin.jpg" />
			<label>
               <span>Email</span>
               <input type="text" class="input_text" name="email" id="email"/>
            </label>
             <label>
               <span>Clave</span>
               <input type="password" class="input_text" name="password" id="password"/>
            </label>
            <label>
                 <input type="submit" class="button" name="gologin" value="LOGIN" />
            </label>
        </div>
    </form>
</body>
</html>
<?php header('Content-type: text/html; charset=utf-8'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>miPague</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF8" />

	<!--  styles -->
	<link rel="stylesheet" type="text/css" href="../web/css/login.css" />
	
	<!--  scripts -->
	<script type="text/javascript" src="../web/lib/jquery/jquery.js"></script>
	<script type="text/javascript" src="../web/lib/jquery/jquery.validate.js"></script>
	<script type="text/javascript" src="../web/lib/jquery/jquery.watermark.js"></script>
	<script type="text/javascript" src="../web/lib/jquery/overrides/validate.js"></script>
	<script type="text/javascript" src="../web/js/login.js"></script>	
</head>
<body>
	<div class="application">
		<!-- begin section header -->
		<div class="wrapper header">
			<div class="section">
				<div class="content">
					<h1 class="logo">
						<a title="miPague" href="#">miPague</a>
					</h1>
					<ul class="menu">
						<li><a id="register" class="white-button" href="#" title="Cadastre-se">CADASTRE-SE</a></li>
					</ul>
				</div>	
			</div>
		</div>
		<!-- end section header -->
		
		<!-- begin section body -->
		<div class="wrapper body">
			<div class="section">
				<div class="content">
					<div class="sign-box">
						<form id="loginForm">
							<h2>Login</h2>
							<div class="username-p">
								<input class="mipague-textfield" type="text" name="username" id="username" />
							</div>
							<div class="pass-p">
								<input class="mipague-textfield" type="password" name="password" id="password" />
							</div>
							<input class="mipague-button login-button" type="submit" value="Login" id="login" />
							<label class="keep-connected">
								<input type="checkbox" name="keepConnected" /><span>Continuar conectado</span>
							</label>
							<a class="forgot-password">Esqueceu sua senha?</a>
						</form>
					</div>
					
					<div class="info">
						<ul class="features">
							<li>
								<img src="../web/img/info-auto.png"></img>
								<h3>Automático</h3>
								<p>Dispense as planilhas que exigem muita manutenção</p>
							</li>
							<li>
								<img src="../web/img/info-available.png"></img>
								<h3>Disponível</h3>
								<p>Mantenha as informações importantes acessíveis a qualquer hora pela internet</p>
							</li>
							<li>
								<img src="../web/img/info-coop.png"></img>
								<h3>Colaborativo</h3>
								<p>Divida com seus amigos a tarefa de cadastrar as contas</p>
							</li>
						</ul>
					</div>
				</div>
				
				<div class="operation">
					<h4>Como funciona</h4>
					
					<div class="border-top-wrapper orange-border">
						<span class="border"></span>
					</div>
					
					<ul class="operation-steps">
						<li class="no-border">
							<img src="../web/img/operation-step-one.png"></img>
							<span>crie um grupo</span>
						</li>
						<li>
							<img src="../web/img/operation-step-two.png"></img>
							<span>adicione as pessoas que fazem parte do seu grupo</span>
						</li>
						<li>
							<img src="../web/img/operation-step-three.png"></img>
							<span>todo mundo adiciona suas contas e despesas</span>
						</li>
						<li>
							<img src="../web/img/operation-step-four.png" />
							<span>miPague resolve quem deve pagar a quem e quanto!</span>
						</li>					
					</ul>
					
					<div class="border-bottom-wrapper">
						<span class="border"></span>
					</div>
					
				</div>
				
				<div class="big-button-ct">
					<a class="blue-button" href="#">
						<span class="highlight">Cadastre-se!</span>
						<span>É GRATIS</span>
					</a>
				</div>
			</div>
		</div>
		<!-- end section body -->
		
		<!-- begin section footer -->
		<div class="wrapper footer">
			<div class="section">
				<div class="content">
					<p class="copyright">2012 &copy; miPague</p>
				</div>	
			</div>
		</div>
		<!-- end section footer -->	
	</div>
</body>
</html>

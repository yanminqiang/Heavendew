<?php

header("Content-Type:text/html; charset=utf-8");

echo <<<HEAD

<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>HeavenDew InfoCollector</title>

<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">丹露网</a>
			</div>

			<div id="navbar" class="navbar-collapse collapse">
				<div class="collapse navbar-collapse"
					id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><a href="#">商品信息查询</a></li>
						<li><a href="#">用户信息查询</a></li>
					</ul>

					<form class="navbar-form navbar-right" role="form">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="用户名">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" placeholder="密码">
						</div>
						<button type="submit" class="btn btn-default">登陆</button>
					</form>
				</div>
			</div>
		</div>
	</nav>

HEAD;

?>

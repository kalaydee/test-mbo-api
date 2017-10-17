<?php
	$logout = '../login-example/logout.php';
?>
<body>
	<nav class="navbar navbar-default navbar-static-top">
		<div class="container">	
			<div class="row">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#siteNavbar">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					<a href="welcome.php" class="navbar-brand">Test MBO API</a>
				</div>

				<div class="collapse navbar-collapse" id="siteNavbar">
					<ul class="nav navbar-nav navbar-right">
						<li class="active"><a href="welcome.php">HOME</a></li>
						<li><a href="#">PRODUCTS</a></li>
						<li><a href="#">CART</a></li>
						<li><a href="<?= $logout; ?>">Logout</a></li>
					</ul>
				</div>
			</div>
		</div>
	</nav>
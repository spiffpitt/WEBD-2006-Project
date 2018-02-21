<?php
$links[0] = '<a class="nav-link" href="/browse">Browse</a>';
$links[1] = '<a class="nav-link" href="/about">About</a>';
session_start();
if ($_SESSION)
{
	$links[2] =
'<li class="nav-item dropdown">
	<a class="nav-link dropdown-toggle" href="#" id="navbarAccountDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		'.$_SESSION['fname'].'\'s Account
	</a>
	<div class="dropdown-menu" aria-labelledby="navbarAccountDropdown">
		<a class="dropdown-item" href="/profile">View Profile</a>
		<a class="dropdown-item" href="/profile?edit">Edit Profile</a>
		<a class="dropdown-item text-danger" href="/snippet/signOut.php">Sign Out</a>
	</div>
</li>';
	$form =
	'<form class="form-inline my-2 my-lg-0 hidden-sm-down" action="/search" method="get">
		 <input class="form-control mr-sm-2" type="text" placeholder="Search">
		 <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
	 </form>';
}
else
{
	$links[2] = '<a class="nav-link" href="/register">Register</a>';
	$links[3] = '<a class="nav-link" href="/login">Log In</a>';
	$form =
	'<form class="form-inline hidden-sm-down" action="/login" method="post">
	<div class="input-group">
		<input type="email" class="form-control" name="email" placeholder="Email">
		<input type="password" class="form-control" name="password" placeholder="Password">
		<button type="submit" class="btn btn-dark">Log in</button>
	</div>
	</form>';
}
?>
<nav class="navbar navbar-expand-lg bg-primary navbar-dark">
	<a class="navbar-brand" href="/">r8mydog</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
	<div class="collapse navbar-collapse" id="navbarToggle">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
			<?php foreach ($links as $key => $value) : ?>
				<li class="nav-item">
					<?= $value ?>
				</li>
			<?php endforeach; ?>
		</ul>
		<?= $form ?>
	</div>
</nav>

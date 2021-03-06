<?php
function GetNavLinks($loggedin, $admin)
{
	if($loggedin)
	{
		$links[0] =
							'<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarPostDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Posts</a>
								<div class="dropdown-menu" aria-labelledby="navbarPostDropdown">
									<a class="dropdown-item" href="/post">Browse</a>
									<a class="dropdown-item" href="/post/search">Search</a>
									<a class="dropdown-item" href="/post/new">New</a>
								</div>
							</li>';
		$links[2] =
							'<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									'.$_SESSION['fname'].'\'s Account
								</a>
								<div class="dropdown-menu" aria-labelledby="navbarProfileDropdown">
									<a class="dropdown-item" href="/post?userid='.$_SESSION["userid"].'">Your Posts</a>
									<a class="dropdown-item" href="/profile?details">View Profile</a>
									<a class="dropdown-item" href="/profile?edit">Edit Profile</a>
									<a class="dropdown-item text-danger" href="/snippet/signOut.php">Sign Out</a>
								</div>
							</li>';
		if ($_SESSION['admin'])
		{
			$links[3] = '<li class="nav-item"><a class="nav-link" href="/admin">Admin</a></li>';
		}
	}
	else
	{
		$links[0] =
						'<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarPostDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Posts</a>
							<div class="dropdown-menu" aria-labelledby="navbarPostDropdown">
								<a class="dropdown-item" href="/post">Browse</a>
							</div>
						</li>';
		/*
		<form class="form-inline d-none d-lg-block" action="/login" method="post">
			<div class="input-group">
				<input type="email" class="form-control" name="email" placeholder="Email">
				<input type="password" class="form-control" name="password" placeholder="Password">
				<input type="hidden" name="src" value="nav">
				<button type="submit" class="btn btn-dark">Log in</button>
			</div>
		</form>
		*/
	}
	/*
	<form class="form-inline d-none d-lg-block" action="/search" method="get">
		<div class="input-group btn-group">
			<input type="text" class="form-control" name="search" placeholder="Search">
			<button type="submit" class="btn btn-dark">Search</button>
		</div>
	</form>
	*/
	$links[4] = '<li class="nav-item"><a class="nav-link" href="/about">About</a></li>';
	ksort($links);//sorts the links by key, so they display in correct order
	return $links;
}

function LoggedIn()
{
	if ($_SESSION)
	{
		if ($_SESSION['userid'] == "")
		{
			//if empty delete
			unset($_SESSION);
			session_destroy();
		}
		else
		{
			return true;
		}
	}
	else
	{
		/* the cookies are fucked
		// if(isset($_COOKIE['userid']) && !isset($_SESSION))
		// {
		// 	//cookies are set, log them in
		// 	$_SESSION['userid'] = $_COOKIE['userid'];
		// 	$_SESSION['fname'] = $_COOKIE['fname'];
		// 	$_SESSION['lname'] = $_COOKIE['lname'];
		// 	$_SESSION['email'] = $_COOKIE['email'];
		// 	$_SESSION['admin'] = $_COOKIE['admin'];
		// 	$loggedin = true;
	 */
	}
	return false;
}
function TimeAgo($time)
{
	date_default_timezone_set('America/Winnipeg');
	$diff = (new DateTime())->diff(new DateTime("@$time"));

	if ($diff->y == 0)
	{
		if ($diff->m == 0)
		{
			if ($diff->d == 0)
			{
				if ($diff->h == 0)
				{
					if ($diff->i == 0)
					{
						return $diff->s.' second'.($diff->s == 1 ? '' : 's').' ago';
					}
					else
					{
						return $diff->i.' minute'.($diff->i <= 1 ? '' : 's').' ago';
					}
				}
				else
				{
					return $diff->h.' hour'.($diff->h <= 1 ? '' : 's').' ago';
				}
			}
			else
			{
				if ($diff->d < 7)
				{
					return $diff->d.' day'.($diff->d <= 1 ? '' : 's').' ago';
				}
				else
				{
					return floor($diff->d / 7) .' week'.(floor($diff->d / 7) <= 1 ? '' : 's').' ago';
				}
			}
		}
		else
		{
			return $diff->m.' month'.($diff->m <= 1 ? '' : 's').' ago';
		}
	}
	else
	{
		return $diff->y.' year'.($diff->y <= 1 ? '' : 's').' ago';
	}
}
function GetUserName($userid)
{
	require 'connect.php';
	$query = "SELECT fname, lname FROM users WHERE userid=:userid;";
	$statement = $db->prepare($query);
	$statement->bindValue(':userid', $userid);
	$statement->execute();
	return $statement->fetch();
}
?>

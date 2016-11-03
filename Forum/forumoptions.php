
<!doctype html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="jquery/jquery.mobile-1.4.5.css">
<script src="jquery/jquery-1.12.4.js"></script>
<script src="jquery/jquery.mobile-1.4.5.js"></script>
</head>
<body>
<div data-role="page">

<?php


if(isset($_GET['username']))
{
$user = $_GET['username'];
$userID= $_GET['userID'];
}

session_start();
include 'index.php';
//open androidlogin database
$connect=mysql_connect("localhost","book_admin","r2ux4dwnE4GTfRUn") or die("Couldn't connect!");
	mysql_select_db("androidlogin") or die("Couldn't connect to db");

		
		
		
		$query1=mysql_query("INSERT into users VALUES('','$userID','$user','0')");
		$query2=mysql_query("SELECT * from users WHERE parse_id='$userID'");
		$numrows=mysql_num_rows($query2);

	if($numrows!=0)
		{ 
		while($row=mysql_fetch_assoc($query2))
			{
			$dbuserlevel=$row['user_level'];
			$dbuserid=$row['user_id'];
			}
		}

$_SESSION['user_id'] = $dbuserid;
$_SESSION['user_name'] = $user; 	
$_SESSION['user_level']= $dbuserlevel;

?>


<ul data-role="listview">
  <li><a href="forum.php"><img src="photos/posts1.png">Forums</a></li>
  <li><a href="create_cat.php"><img src="photos/category1.png">Create a new Category</a></li>
  <li><a href="create_topic.php"><img src="photos/topic1.png">Start a new discussion in category </a></li>
</ul>

</div>
</body>
</html>





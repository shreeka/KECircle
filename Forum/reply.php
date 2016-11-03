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
session_start();

$connect=mysql_connect("localhost","book_admin","r2ux4dwnE4GTfRUn") or die("Couldn't connect!");
	mysql_select_db("androidlogin") or die("Couldn't connect to db");

$comment_id=$_GET['user_id'];
$query=mysql_query("SELECT * from loginusers WHERE id='$comment_id'");
$numrows=mysql_num_rows($query);

	if($numrows!=0)
		{ 
		while($row=mysql_fetch_assoc($query))
			{
			$comment_name=$row['username'];
			}
		}

echo '<div data-role="main" class="ui-content">
	<h3> Reply:</h3>
	<form method="post" action="">
    <textarea name="reply-content" placeholder="Reply to'.$comment_name.'">@'.$comment_name.'</textarea>
    <input type="submit" name="submitreply" value="Submit reply" />
	</form>
	</div>
';

if(isset($_POST['submitreply']))
{
	$sql = "INSERT INTO 
                    posts(post_content,
                          post_date,
                          post_topic,
                          post_by) 
                VALUES ('" . $_POST['reply-content'] . "',
                        NOW(),
                        " . mysql_real_escape_string($_GET['id']) . ",
                        " . $_SESSION['user_id'] . ")";
						
 $result = mysql_query($sql);
                         
        if(!$result)
        {
            echo 'Your reply has not been saved, please try again later.';
        }
        else
        {
            echo 'Your reply has been saved, check out <a href="topic.php?id=' . htmlentities($_GET['id']) . '">the topic</a>.';
        }
    
}
 
?>

</div>
</body>
</html>
	

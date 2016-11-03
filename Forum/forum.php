<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1; maximum-scale=1 minimum-scale=1; user-scalable=no"/>
<link rel="stylesheet" href="jquery/jquery.mobile-1.4.5.css">		
<script src="jquery/jquery-1.12.4.js"></script>
<script src="jquery/jquery.mobile-1.4.5.js"></script>

</head>

<body>

<?php
session_start();

$connect=mysql_connect("localhost","book_admin","r2ux4dwnE4GTfRUn") or die("Couldn't connect!");
		mysql_select_db("androidlogin") or die("Couldn't connect to db");	


$sql = "SELECT
            *
        FROM
            categories";
 
$result = mysql_query($sql);
 if(!$result)
{
    echo 'The categories could not be displayed, please try again later.';
}
else
{
    if(mysql_num_rows($result) == 0)
    {
        echo 'No categories defined yet.';
    }
    else
    {
        //prepare the table
        echo '<div data-role="page" id="pageone">
		
				<div data-role="main" class="ui-content">
    				<h2> Categories </h2>
					<ul data-role="listview" data-inset="true">
					'; 
             
        while($row = mysql_fetch_assoc($result))
        {               
            	
                echo '<li><a href="category.php?id=' . $row['cat_id'] . '">' . $row[                     'cat_name'] . '<p>' . $row['cat_description'].'
					<br>'; 
					
				$cat_id=$row['cat_id'];
				$query="SELECT * from topics WHERE topic_cat='$cat_id' ORDER BY topic_date DESC LIMIT 1";
				$result1=mysql_query($query);
				if(!$result1)
				{
					echo 'Last topic could not be displayed.';
				}
				else
					if(mysql_num_rows($result1)==0)
					{
						echo 'No recent topic discussion in this category.';
					}
					else
					{
						while($row=mysql_fetch_assoc($result1))
						{	
							echo'<b><br>Last topic: '.$row['topic_subject'].' on '.$row['topic_date'].'</b>
									</p></a></li>';
						}
					}
        }
		echo '
 				 </div>
				 </div>';
    }
}
 
?>
</body>
</html>
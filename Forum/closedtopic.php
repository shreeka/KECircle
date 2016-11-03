<!doctype html>
<html>

<head>
<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1 minimum-scale=1; user-scalable=no"/>

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
	
$sql = "SELECT
            *
        FROM
           topics
        WHERE
            topic_id = " . mysql_real_escape_string($_GET['id']);
 
 $result = mysql_query($sql);

if(!$result)
{
    echo 'The topic could not be displayed, please try again later.' . mysql_error();
}
else
{
    if(mysql_num_rows($result) == 0)
    {
        echo 'This topic does not exist.';
    }
    else
    {
        //display category data
        while($row = mysql_fetch_assoc($result))
        {
            $topic_subject=$row['topic_subject'] ;
        }
		
 $sql = "SELECT
				posts.post_topic,
				posts.post_content,
				posts.post_date,
				posts.post_by,
				users.user_id,
				users.user_name
			FROM
				posts
			LEFT JOIN
				users
			ON
				posts.post_by = users.user_id
			WHERE
				posts.post_topic = " . mysql_real_escape_string($_GET['id']);
				
$result = mysql_query($sql);
         
        if(!$result)
        {
            echo 'The posts could not be displayed, please try again later.';
        }
        else
        {
            if(mysql_num_rows($result) == 0)
            {
                echo 'There are no posts in this topic yet.';
            }
            else
            {
				 echo ' 
 					 <div data-role="header">
   					 <h2>About: '.$topic_subject.'(Closed)</h2> 
  					</div>
					<div>
			 <ul data-role="listview" data-inset="true">'; 
				         
                //prepare the table
				while($row = mysql_fetch_assoc($result))
                {      
               		
					echo '<li data-role="list-divider">'.$topic_subject.'</li>';
					 echo '<li> <p><font size="+1">   '.$row['post_content'].'</font></p>';
					  echo '  <br> <h4> Posted by: '.$row['user_name']. '<br><br>on: '.$row['post_date'].'</h4>
					   </li>' ;
		        }
				
						
			
            }
        } 
    
	
	}
	
}


        
         

?>

</div>
</body>
</html>
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

//first select the category based on $_GET['cat_id']
$sql = "SELECT
            *
        FROM
            categories
        WHERE
            cat_id = " . mysql_real_escape_string($_GET['id']);
 
$result = mysql_query($sql);

if(!$result)
{
    echo 'The category could not be displayed, please try again later.' . mysql_error();
}
else
{
    if(mysql_num_rows($result) == 0)
    {
        echo 'This category does not exist.';
    }
    else
    {
        //display category data
        while($row = mysql_fetch_assoc($result))
        {
            echo '<h2>Discussions in ′' . $row['cat_name'] . '′ category</h2>';
        }
//do a query for the topics
        $sql = "SELECT  
                    *
                FROM
                    topics
                WHERE
                    topic_cat = " . mysql_real_escape_string($_GET['id']);
         
        $result = mysql_query($sql);
         
        if(!$result)
        {
            echo 'The discussions could not be displayed, please try again later.';
        }
        else
        {
            if(mysql_num_rows($result) == 0)
            {
                echo 'There are no discussions in this category yet.';
            }
            else
            {
                //prepare the table
                echo '
                        <h3>Discussions</h3>
						<ul data-role="listview" data-inset="true">';
                        
                   
                while($row = mysql_fetch_assoc($result))
                {               
						if($row['close']=='yes')
						{
							$msg='(closed)';
						}else $msg='';
                        echo '<li><a href="topic.php?id=' . $row['topic_id'] . '"> <img src="photos/Forum Icon.png"><h2>			                                  ' . $row['topic_subject'] . $msg . '</h2> 
						<p>  Created on: '.date('d-m-Y', strtotime($row['topic_date'])).'                                   </p></a></li>';
                        
                           
                }
            }
        }
    }
}

?>

</div>
</body>
</html>
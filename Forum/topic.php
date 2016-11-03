
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
$user_name=$_SESSION['user_name'];
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
			$close=$row['close'];
			$topic_id=$row['topic_id'];
			$topic_by=$row['topic_by'];
			$report=$row['report'];
        }
		if($close=='yes')
		{
			header("Location: closedtopic.php?id=$topic_id");
		}
		else
		{
		
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
   					 <h2>About: '.$topic_subject.'</h2> 
  					</div>
					 <a href="#myPopup" data-rel="popup" class="ui-btn ui-btn-inline ui-corner-all">Close the discussion			</a>
			
					<div data-role="popup" id="myPopup">
					<form method="post" action="">
					 <p> Do you really want to close the discussion? </p>
					  <input type="submit" name="submityes" value="Yes" />
					</form>
					
					 </div>';
					  if(isset($_POST['submityes']))
					 {
						 if($user_name==$topic_by){
						 mysql_query("UPDATE topics SET close='yes' WHERE topic_by=$topic_by ");
						 header("Location: closedtopic.php?id=$topic_id");}
						 else
						 echo 'You are not the author of this discussion.';
					  }
					  
					echo'<a href="#myPopup1" data-transition="slidedown" data-rel="popup" class="ui-btn ui-corner-all ui-shadow ui-btn-inline">Report			</a>
					<div data-role="popup" id="myPopup1" data-overlay-theme="a">
					<form method="post" action="">
					<fieldset data-role="controlgroup">
					
					<input type="radio" name="radio-choice-v-2" id="radio-choice-v-2a" value="on" checked="checked">
					<label for="radio-choice-v-2a">Inappropriate content </label>
					<input type="radio" name="radio-choice-v-2" id="radio-choice-v-2b" value="off">
					<label for="radio-choice-v-2b">Redundant queries</label>
					<input type="radio" name="radio-choice-v-2" id="radio-choice-v-2c" value="other">
					<label for="radio-choice-v-2c">Spam</label>
					<input type="radio" name="radio-choice-v-2" id="radio-choice-v-2d" value="other">
					<label for="radio-choice-v-2d">Prank post</label>
				</fieldset>
				<input type="submit" name="reportbutton" value="Okay" />';
				if(isset($_POST['reportbutton']))
					 {
						 echo 'Reported.';
						 $intreport=intval($report);
						 $intreport++;
						 
	
						 mysql_query("UPDATE topics SET report=$intreport WHERE topic_id=$topic_id ");
						 if($intreport==5)
						 {
							 mysql_query("DELETE FROM topics WHERE topic_id=$topic_id;");
					      }
						  else
						  header("Location: topic.php?id=$topic_id");
						 
					  }
			echo '</form>';
			
			
			
						echo '</div>
						';
					 
					
			
			 
			 
			 echo '<div>
			 <ul data-role="listview" data-inset="true">'; 
				         
                //prepare the table
				while($row = mysql_fetch_assoc($result))
                {      
               		
					echo '<li data-role="list-divider">'.$topic_subject.'</li>';
					 echo '<li> <p><font size="+1">   '.$row['post_content'].'</font></p>';
					  echo '  <br> <h4> Posted by: '.$row['user_name']. '<br><br>on: '.$row['post_date'].'</h4>' ;
                        echo '<a href="reply.php?user_id='.$row['user_id'].'&id='.$row['post_topic'].'"> Reply 								                         </a>
						</li>';
                
					
					
                }
				echo '</div> <br><br>';
				
				echo '<div class="ui-content">
	<h3> Comment:</h3>
	<form method="post" action="">
    <textarea name="comment-content" placeholder="Comment your thoughts.."></textarea>
    <input type="submit" name="submitcomment" value="Submit" />
	</form>
	</div>
';

if(isset($_POST['submitcomment']))
{
	$sql = "INSERT INTO 
                    posts(post_content,
                          post_date,
                          post_topic,
                          post_by) 
                VALUES ('" . $_POST['comment-content'] . "',
                        NOW(),
                        " . mysql_real_escape_string($_GET['id']) . ",
                        " . $_SESSION['user_id'] . ")";
						
 $result = mysql_query($sql);
                         
        if(!$result)
        {
            echo 'Your comment has not been saved, please try again later.';
        }
        else
        {
            header("Location: topic.php?id=$topic_id");
        }
    
}

				
				
			
            }
        } 
		}
	
	}
	
}


        
         

?>

</div>
</body>
</html>
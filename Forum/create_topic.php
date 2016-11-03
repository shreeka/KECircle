
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


echo '<h2>Create a new discussion</h2>';
if(isset($_SESSION['user_name']))
{
    //the user is signed in
    if($_SERVER['REQUEST_METHOD'] != 'POST')
    {   
        //the form hasn't been posted yet, display it
        //retrieve the categories from the database for use in the dropdown
        $sql = "SELECT *  FROM  categories";
         
        $result = mysql_query($sql);
		if(!$result)
        {
            //the query failed, uh-oh :-(
            echo 'Error while selecting from database. Please try again later.';
        }
        else
        {
            if(mysql_num_rows($result) == 0)
            {
                //there are no categories, so a topic can't be posted
                if($_SESSION['user_level'] == 1)
                {
                    echo 'You have not created categories yet.';
                }
                else
                {
                    echo 'Before you can post a discussion, you must wait for an admin to create some categories.';
                }
            }
			else
            {
         
                echo '<div class="ui-field-contain">
				<form method="post" action="">
                    <label for="subject">Subject:</label>
					 <input type="text" name="topic_subject" data-clear-btn="true" />
                   <label for="category"> Category:</label>'; 
                 
                echo '<select name="topic_cat">';
                    while($row = mysql_fetch_assoc($result))
                    {
                        echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
                    }
                echo '</select>'; 
                     
                echo '<label for= "message">Message:</label>
				 <textarea name="post_content" placeholder="Post your message"></textarea>
                    <input type="submit" value="Create discussion" />
                 </form>';
            }
        }
    }
	
	 else
    {
        //start the transaction
        $query  = "BEGIN WORK;";
        $result = mysql_query($query);
         
        if(!$result)
        {
            //Damn! the query failed, quit
            echo 'An error occured while creating your topic. Please try again later.';
        }
        else
        {
     
            //the form has been posted, so save it
            //insert the topic into the topics table first, then we'll save the post into the posts table
            $sql = "INSERT INTO 
                        topics(topic_subject,
                               topic_date,
                               topic_cat,
                               topic_by,
							   close,
							   report)
                   VALUES('" . mysql_real_escape_string($_POST['topic_subject']) . "',
                               NOW(),
                               '" . mysql_real_escape_string($_POST['topic_cat']) . "',
                               '" . $_SESSION['user_id'] . "',
							   'no',
							   '0'
                               )";
                      
            $result = mysql_query($sql);
            if(!$result)
            {
                //something went wrong, display the error
                echo 'An error occured while inserting your data. Please try again later.' . mysql_error();
                $sql = "ROLLBACK;";
                $result = mysql_query($sql);
            }
            else
            {
                //the first query worked, now start the second, posts query
                //retrieve the id of the freshly created topic for usage in the posts query
                $topicid = mysql_insert_id();
                 
                $sql = "INSERT INTO
                            posts(post_content,
                                  post_date,
                                  post_topic,
                                  post_by)
                        VALUES
                            ('" . mysql_real_escape_string($_POST['post_content']) . "',
                                  NOW(),
                                  " . $topicid . ",
                                  " . $_SESSION['user_id'] . "
                            )";
                $result = mysql_query($sql);
                 
                if(!$result)
                {
                    //something went wrong, display the error
                    echo 'An error occured while inserting your post. Please try again later.' . mysql_error();
                    $sql = "ROLLBACK;";
                    $result = mysql_query($sql);
                }
                else
                {
                    $sql = "COMMIT;";
                    $result = mysql_query($sql);
                     
                    //after a lot of work, the query succeeded!
                    echo 'You have successfully created <a href="topic.php?id='. $topicid . '">a new discussion.</a>.';
                }
            }
        }
    }
}
 
	

?>

</div>
</body>
</html>
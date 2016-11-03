
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
  <div data-role="main" class="ui-content">
 <h3> Categories allow you to organise your discussions.</h3>
    <form method="post" action="create_cat.php">
      <div class="ui-field-contain">
       <label for="cat_name">Category name </label>
        <input type="text" name="cat_name" id="cat_name" data-clear-btn="true">
        <label for="cat_desc">Category description</label>
        <textarea name="cat_desc" id="cat_desc" data-clear-btn="true" placeholder="Describe the category..."> </textarea>
      </div>
      
      <input type="submit" name="submit1" data-inline="true" value="Add a category"> <br>
      <?php
	  session_start();
include 'index.php';

if(isset($_POST['submit1']))
{
	if($_SESSION['user_level']=='1')
	{
	$cat_name=$_POST['cat_name'];
	$cat_desc=$_POST['cat_desc'];
	
		if($cat_name&&$cat_desc){
		$connect=mysql_connect("localhost","book_admin","r2ux4dwnE4GTfRUn") or die("Couldn't connect!");
				mysql_select_db("androidlogin") or die("Couldn't connect to db");	
		
		$sql = "INSERT INTO categories VALUES('','$cat_name','$cat_desc')";
			$result = mysql_query($sql);
			if(!$result)
			{
				//something went wrong, display the error
				echo 'Error' . mysql_error();
			}
			else
			{
				$query=mysql_query("SELECT * from categories WHERE cat_name=$cat_name");
				if(!$query){
				echo "Category added!!<br>";
				}
				else
				echo "This category is already created.";
			}
		}else
		echo "Please fill in all the required fields. ";
	}
	else 
	echo "Only admins are allowed to create categories.";
}

?>    


    </form>
   </div>
</div>
</body>
</html>
    


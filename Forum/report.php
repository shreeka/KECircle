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

$topic_id=$_GET['topic_id'];
$report=$_GET['report'];
echo'
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
						
						 $intreport=intval($report);
						 $intreport++;
						  echo 'Reported.';
	
						 mysql_query("UPDATE topics SET report=$intreport WHERE topic_id=$topic_id ");
						 if($intreport==5)
						 {
							 mysql_query("DELETE FROM topics WHERE topic_id=$topic_id;");
					      }
						  //else
						  //header("Location: topic.php?id=$topic_id");
						 
					  }
			echo '</form>';
			
			
			
						echo '</div>';
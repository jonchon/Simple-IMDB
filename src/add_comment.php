<html>
<head>

<title> Add Review! </title>
<style>
  body {
  font: normal normal 13px Arial, Tahoma, Helvetica, FreeSans, sans-serif;
  color: white;
  }
  h1 {
  font: normal normal Arial, Tahoma, Helvetica, FreeSans, sans-serif;
  color: white;
  }
  .div1 {
  background-color: #1D1D1D;
  width: 100%;
  height: 100%;
  border: 2px solid black;
  }
  .div2 {
  background-color: #1A1B1D;
  width: 100%;
  height: 50px;
  border: 2px solid black;
  }
      .div3 {
      background-color:#0F0F0F;
      margin: auto;
      width: 50%;
      text-align: center;
      }
      table{
      width: 90%;
      }
  input[type=text] {
  width: 50%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing:border-box;
  }

  .hub {
  display: block;
  font-family: sans-serif;
  font-weight: bold;
  font-size: 40px;

}
.hub span:nth-child(2) {
  background: #FF9900;
  color: #000000;
  border-radius: 150px;
  padding: 0 15px 0 15px;
  display: inline-block;
}

.hub_links span:nth-child(n) {
  background-color: #1A1B1D;
  width: 150px;
  border: 2px solid black;
  display: block;
  padding: 70px 0;
  text-align: center;
  font-family: sans-serif;
  font-weight: bold;
  font-size: 13px;
  background: #FF9900;
  color: #000000;
  border-radius: 150px;
  padding: 0 15px 0 15px;
  display: inline-block;
}
  .hub_links span:nth-child(n):hover {
  background-color: pink;
  }
  a:link {
  color: white;
  }
  a:visited {
  color: white;
  }
  
  </style>
</head>
<body style="background-color:black;">
  <div class="div2">
    <font color="white">
      <div class="hub">
        <a href='http://localhost:1438/~cs143/mainpage.php' style="text-decoration:none;">
        <font color="white"><span>Movie</span></font>
        <span>Hub</span><br><br>
          </a>
      </div>
         <div class="hub_links">
         <a href='http://localhost:1438/~cs143/actor.php' style="text-decoration:none;">
          <span><br>Actor<br><br></span><br><br></a>
          <a href='http://localhost:1438/~cs143/movie.php' style="text-decoration:none;">
          <span><br>Movies<br><br></span><br><br></a>
          <a href='http://localhost:1438/~cs143/add_person.php' style="text-decoration:none;">
          <span><br>Add Person<br><br></span><br><br></a>
          <a href='http://localhost:1438/~cs143/add_movie.php' style="text-decoration:none;">
          <span><br>Add Movie<br><br></span><br><br></a>
          <a href='http://localhost:1438/~cs143/add_actor.php' style="text-decoration:none;">
          <span><br>Add Actor to Movie<br><br></span><br><br></a>
          <a href='http://localhost:1438/~cs143/add_director.php' style="text-decoration:none;">
          <span><br>Add Director to Movie<br><br></span><br><br></a>
	  <a href='http://localhost:1438/~cs143/search.php' style="text-decoration:none;">
	  <span><br>Search<br><br></span></a>
          </p>
          </div>
    </font>
  </div>

<div class="div1">
  <center><h1>Add Comment</h1></center>
<center>
<FORM METHOD = "GET" >
Username:<br> <input type="text" name="reviewer" placeholder="Username" required> <br><br>
Rating (Out of 10): <br> <input type="TEXT" NAME="rating" placeholder="Rating" size=20 required><br><br>
Comment: <br><TEXTAREA NAME="comment" ROWS=4 COLS=30 required></TEXTAREA><br>

<input type='hidden' name='id' value='<?php $id=$_GET["id"]; echo "$id";?>'/> 

<INPUT TYPE="submit" VALUE="Query!~~">
</FORM>
</center>

<?php 

$reviewer= $_GET["reviewer"];
$rating= $_GET["rating"];
$comment = $_GET["comment"];
$id=$_GET["id"];
$error=$_GET["error"];
if($error==1)
{
  echo "<center>Please no special characters in username<br>";
}
else if($error==2)
{
  echo "<center>Only whole numbers 0-10 and no special characters in rating. <br>";
}
if($reviewer) 
{
  
  $weirdChars="/[\'^£$%&*()}{@#~?><>,.|=_+¬-]/";
  $goodNums="/^(0*(?:[1-9]|10|0))$/";
  if(preg_match($weirdChars,$reviewer))
  {
    header("Location: http://localhost:1438/~cs143/add_comment.php?id=$id&error=1");
  }
  if(!preg_match($goodNums,$rating))
  {
    header("Location: http://localhost:1438/~cs143/add_comment.php?id=$id&error=2");
  }

   $db = mysqli_connect('localhost', 'cs143', '', 'CS143');
   if($db->connect_errno > 0)
   { 
     die('Unable to connect to database [' . $db->connect_error . ']');
   }
   
   $stmt = $db->prepare("INSERT INTO Review (name, mid, rating,comment) VALUES (?, ?, ?,?)");
   $stmt->bind_param("siis", $reviewer, $id, $rating,$comment);
   $stmt->execute();
   echo "<center>Review successfully created!<br>";
   echo "<a href='http://localhost:1438/~cs143/movie_info.php?id=$id'>Back to movie!</a></center>";
   $stmt->close();
   
  
  $db->close();
  
}
?>

</center>
</div>
</body>
</html>

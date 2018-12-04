<html>
<head>

<title> Add Actor/Director </title>
<style>
  body {
  font: normal normal 13px Arial, Tahoma, Helvetica, FreeSans, sans-serif;
  color: white;
  }
  h1 {
  font: normal normal Arial, Tahoma, Helvetica, FreeSans, sans-serif;
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
  input[type=text] {
  width: 50%;
  padding: 12px 20px;
  margin: 8px 0;
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

<center>
<div class="div1">
<font color="white">
<h1> Add A New Actor/Director </h1>
<form method = "GET">
      <input type="radio" name="job" value="Actor" checked> Actor
      <input type="radio" name="job" value="Director"> Director <br><br>

      <b>First Name</b><br>
      <input type="text" name="first" placeholder="First Name" required><br><br>
      <b>Last Name</b><br>
      <input type="text" name="last" placeholder="Last Name" required><br><br>
      
      <input type="radio" name="gender" value="male" checked> Male <br>
      <input type="radio" name="gender" value="female"> Female <br>
      <input type="radio" name="gender" value="other"> Other <br><br>

      <b>Date of Birth</b><br>
      <input type="date" name="birth" required><br><br>

      <b>Date of Death</b><br>
      <input type="date" name="death"><br>
      <i>leave blank if still alive</i><br><br>

      <input type="submit" value="ADD!">
</form>
</font>

<?php

$job=$_GET["job"];
$first=$_GET["first"];
$last=$_GET["last"];
$gender=$_GET["gender"];
$birth=$_GET["birth"];
$death=$_GET["death"];

if($job)
{
  $weirdChars="/[\^£$%&*()} {@#~?><>,.|=_+¬-]/";
  $numPattern="/[0-9]/";
  if(preg_match($weirdChars,$first))
  {
    echo "<center>Please no special characters in first name<br>";
    return;
  }
  else if (preg_match($weirdChars,$last))
  {
    echo "<p>Please no special characters in last name</p>";
    return;
  }
  else if(preg_match($numPattern,$first)or preg_match($numPattern,$last))
  {
    echo "<p>I don't think a name can have numbers</p>";
    return;
  }
  else if ($death<$birth and $death!='')
  {
    echo "<p>Date of death cannot be before date of birth</p>";
    return;
  }
  $db = mysqli_connect('localhost', 'cs143', '', 'CS143');
  if($db->connect_errno > 0)
  { 
    die('Unable to connect to database [' . $db->connect_error . ']');
  }
  
    $query="select * from MaxPersonID;";
    $result =  mysqli_query($db,$query);
    $row = $result->fetch_assoc();
    $id=$row['id'];
    $id=$id+1;
    $updateQuery="update MaxPersonID
set id= (id+1);";
    mysqli_query($db,$updateQuery);  
   
  if($job=='Actor')
  {
    if($death=='')
    {
      $stmt = $db->prepare("INSERT INTO Actor(id, last, first,sex,dob) VALUES (?, ?, ?,?,?);");
      $stmt->bind_param("issss", $id, $last, $first,$gender,$birth);
    }
    else
    {
      $stmt = $db->prepare("INSERT INTO Actor(id, last, first,sex,dob,dod) VALUES (?, ?, ?,?,?,?);");
      $stmt->bind_param("isssss", $id, $last, $first,$gender,$birth,$death);
    }
  }
  else if ($job=='Director')
  {
    if($death=='')
    {
      $stmt = $db->prepare("INSERT INTO Director(id, last, first,dob) VALUES (?, ?, ?,?);");
      $stmt->bind_param("isss", $id, $last, $first,$birth);
    }
    else
    {
      $stmt = $db->prepare("INSERT INTO Director(id, last, first,dob,dod) VALUES (?, ?, ?,?,?);");
      $stmt->bind_param("issss", $id, $last, $first,$birth,$death);
    }
  }
  $stmt->execute();
  echo "You've successfully created life!";
  
}


?>
</div>
</center>
</body>
</html>

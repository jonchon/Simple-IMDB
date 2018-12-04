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
  width: 500px;
  border: 2px black;
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
          <a href='http://localhost:1438/~cs143/search.php' style=“text-decoration:none;”>
          <span><br>Search<br><br></span></a>
          </p>
          </div>
    </font>
  </div>

<div class="div1">
  <font color="white">
    <center>
<h1> Add A New Movie</h1>
<form method = "GET">
      <b>Title</b><br>
      <input type="text" name="title" placeholder="Enter the Title of the Movie" required><br><br>
      <b>Company</b><br>
      <input type="text" name="company" placeholder="Enter the Company" required><br><br>

      <b>Year</b><br>
      <input type="text" name="year" placeholder="Enter the Year it was released" required><br><br>

      <b>MPAA Rating</b><br>
      <select name="rating">
	<option value="G">G</option>
	<option value="PG">PG</option>
	<option value="PG13">PG-13</option>
	<option value="R">R</option>
	<option value="NC17">NC-17</option>
      </select><br><br>

      <b>Genre</b><br>
      <div class="div3">
      <input type="checkbox" name="genre[]" id="genre" value="action">Action
      <input type="checkbox" name="genre[]" id="genre" value="adult">Adult
      <input type="checkbox" name="genre[]" id="genre" value="adventure">Adventure 
      <input type="checkbox" name="genre[]" id="genre" value="comedy">Comedy 
      <input type="checkbox" name="genre[]" id="genre" value="crime">Crime 
      <input type="checkbox" name="genre[]" id="genre" value="documentary">Documentary<br>
      <input type="checkbox" name="genre[]" id="genre" value="drama">Drama
      <input type="checkbox" name="genre[]" id="genre" value="family">Family
      <input type="checkbox" name="genre[]" id="genre" value="fantasy">Fantasy
      <input type="checkbox" name="genre[]" id="genre" value="horror">Horror
      <input type="checkbox" name="genre[]" id="genre" value="musical">Musical
      <input type="checkbox" name="genre[]" id="genre" value="mystery">Mystery
      <input type="checkbox" name="genre[]" id="genre" value="romance">Romance
      <input type="checkbox" name="genre[]" id="genre" value="scifi">Sci-Fi
      <input type="checkbox" name="genre[]" id="genre" value="short">Short
      <input type="checkbox" name="genre[]" id="genre" value="thriller">Thriller
      <input type="checkbox" name="genre[]" id="genre" value="war">War
      <input type="checkbox" name="genre[]" id="genre" value="western">Western<br><br>
      <input type="submit" value="ADD!">
      </div>
</form>
</font>
</center>




<?php

$title=$_GET["title"];
$company=$_GET["company"];
$year=$_GET["year"];
$rating=$_GET["rating"];
$genres=$_GET['genre'];

if($title)
{
  echo "<center>$title $company $year $rating ";
  foreach($genres as $genre)
  {
    echo "$genre ";
  }
  echo "</center>";
  
  $yearPattern="/^[0-9]+$/";
  if(!preg_match($yearPattern,$year))
  {
    echo "<center>Enter a proper year with no special characters</center>";
    return;
  }
  
  $db = mysqli_connect('localhost', 'cs143', '', 'CS143');
  if($db->connect_errno > 0)
  { 
    die('Unable to connect to database [' . $db->connect_error . ']');
  }
  
  $query="select * from MaxMovieID;";
    $result =  mysqli_query($db,$query);
    $row = $result->fetch_assoc();
    $id=$row['id'];
    $id=$id+1;
    $updateQuery="update MaxMovieID
set id= (id+1);";
    mysqli_query($db,$updateQuery);  
    
    $stmt = $db->prepare("INSERT INTO Movie(id, title, year,rating,company) VALUES (?, ?, ?,?,?);");
    $stmt->bind_param("isiss", $id, $title, $year,$rating,$company);
    $stmt->execute();
    
    foreach($genres as $genre)
    {
      $stmt = $db->prepare("INSERT INTO MovieGenre(mid, genre) VALUES (?, ?);");
      $stmt->bind_param("is", $id, $genre);
      $stmt->execute();
    }
    echo "<center>Successfully Added!</center>";
  
}

?>
</div>
</body>
</html>

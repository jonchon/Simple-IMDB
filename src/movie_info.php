<html>
<head>

<title> Movie Information </title>
<basefont color="white">
<style>
  body {
  font: normal normal 13px Arial, Tahoma, Helvetica, FreeSans, sans-serif;
  color: white;
  }
  h1 {
  font: normal normal Arial, Tahoma, Helvetica, FreeSans, sans-serif;
  }
  a:link {
  color: white;
  }
  a:visited {
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

  </style>
</head>
<body style="background-color:black;">
  <div class="div2">
    <font color="white">
      <div class="hub">
        <a href='http://localhost:1438/~cs143/mainpage.php' style="text-decoration:none;">
        <font color="white"><span>Movie</span></font>
        <span>Hub</span></a>
	  <br><br>
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
</form>
<div class = "div1">
  <center>
    <br>
    <font color="white"><h1>Movie Information Page</h1><br><br>
  </center>

<div class="div3"><br>

<?php 

$id = $_GET["id"];
if($id) {
  $db = mysqli_connect('localhost', 'cs143', '', 'CS143');
   if($db->connect_errno > 0){ 
   die('Unable to connect to database [' . $db->connect_error . ']');
   }
   
   $genreQuery="select genre from MovieGenre where mid=$id";
   $genreResult =  mysqli_query($db,$genreQuery);
   $genreString="<td><center>";
   while($row = $genreResult->fetch_assoc())
   {
     $genreString.=$row['genre'];
     $genreString.=", ";
   }
   $genreString=substr($genreString, 0, -2);
   $genreString.= "</center></td>";
   
   
  $query="select distinct m.Title,m.company as Producer, Rating, concat(d.first, ' ',d.last) as Director
from (Movie as m
     left join MovieActor as ma
     on ma.mid=m.id
     left join Actor as a
     on ma.aid=a.id
     left join MovieDirector as md
     on m.id=md.mid
     left join Director as d
     on md.did=d.id)
where m.id=$id;";
  
  $result =  mysqli_query($db,$query);
  
  $numFields = mysqli_num_fields($result);
  $fields=array();
  for($i=0;$i<$numFields;$i++)
  {   
    array_push($fields, mysqli_fetch_field_direct($result,$i)->name);
  }
  echo "<center><table border=1 cellspacing=1 cellpadding=2><tr></center>";
  foreach($fields as $element)
  {
    echo "<center><th><font color=\"white\"><center>$element</center></font></th></center>";
  }
    echo "<th><font color=\"white\"><center>Genre</center></font></th>";
    echo "</tr>";
    
    while($row = $result->fetch_assoc()) {
    echo "<tr>";
    
    foreach($fields as $element)
    {
      $item=$row[$element];
      if($item=='')
      {
          $item="N/A";
      }
      echo "<td><font color=\"white\"><center>$item</center></font></td>";
    }
    echo "<center>$genreString</center>";
    echo "</tr>";
    }
  echo "</table><br/>";
  
  
  $query2="select a.id as aid,concat(first, ' ', last) as 'Actor/Actress'
from (Movie as m
     left join MovieActor as ma
     on ma.mid=m.id
     left join Actor as a
     on ma.aid=a.id) 
where m.id=$id;";

  $result =  mysqli_query($db,$query2);
  
  $numFields = mysqli_num_fields($result);
  $fields=array();
  for($i=0;$i<$numFields;$i++)
  {   
    array_push($fields, mysqli_fetch_field_direct($result,$i)->name);
  }
  echo "<table border=1 cellspacing=1 cellpadding=2><tr>";
  foreach($fields as $element)
  {
    if($element!='aid'){
        echo "<th><font color=\"white\"><center>$element</center></font></th>";
    }
  }
    echo "</tr>";
    
    while($row = $result->fetch_assoc()) {
    echo "<tr>";
    
    foreach($fields as $element)
    {
      if($element=='aid')
      {
        $aid=$row[$element];
      }
      else
      {
        $item=$row[$element];
        $href="<td><a href=\"http://localhost:1438/~cs143/actor_info.php?id=$aid\">$item</a></td>";
        echo $href;
      }
    }
    echo "</tr>";
    }
  echo "</table><br/>";
  
  
  
  $query3="select avg(r.rating) as 'Average Rating'
from (Movie as m
      left join Review as r
      on m.id=r.mid)
where m.id=$id;";
  $result =  mysqli_query($db,$query3);
  $fields=array();
  array_push($fields, mysqli_fetch_field_direct($result,0)->name);
  $item=$fields[0];
  echo "<table border=1 cellspacing=1 cellpadding=2><tr><th><font color=\"white\">$item</font></th></tr><tr>";
  $row = $result->fetch_assoc();
  $item=$row[$fields[0]];
  if($item=='')
  {
    $item="No ratings yet for this movie!! :(";
  }
  echo "<td><font color=\"white\"><center>$item</center></font></td></tr></table><br/>";
  
  
  
  $query4="select name as Reviewer, r.Rating, Comment
from (Movie as m
      left join Review as r
      on m.id=r.mid)
where m.id=$id;";
  $result=mysqli_query($db,$query4);
  $fields=array();
  $numFields = mysqli_num_fields($result);

  for($i=0;$i<$numFields;$i++)
  {   
    array_push($fields, mysqli_fetch_field_direct($result,$i)->name);
  }
  echo "<table border=1 cellspacing=1 cellpadding=2><tr>";
  foreach($fields as $element)
  {
        echo "<th><font color=\"white\">$element</font></th>";
  }
    echo "</tr>";
    
    while($row = $result->fetch_assoc()) {
    echo "<tr>";
    
    foreach($fields as $element)
    {
        $item=$row[$element];
        if($item=='')
        {
          echo "<td colspan=\"$numFields\"><font color=\"white\"><center>No reviews have been left for this movie yet.</center></font></td>";
          break;
        }
        else
        {
          echo "<td>$item</a></td>";
        }
    }
    echo "</tr>";
    }
  echo "</table><br/>";
  
  echo "<a href=\"http://localhost:1438/~cs143/add_comment.php?id=$id\" style=\"text-decorations:none!important;\"><span>Add a review by clicking here!</span></a>";
  
  $db->close();
  
  }
?>
<br><br>
</div>
</div>
</body>
</html>

<html>
<head>

  <title> Movie Info </title>
  <style>
    body {
    font: normal normal 13px Arial, Tahoma, Helvetica, FreeSans, sans-serif;
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
  	  <a href='http://localhost:1438/~cs143/search.php' style=“text-decoration:none;”>
	  <span><br>Search<br><br></span></a>
          </p>
          </div>
    </font>
  </div>

<FORM METHOD = "GET" >
  <div class="div1">
  <center><br>
<font color="white"><h1>Movie Information Page</h1><br><br> Put movie title here: <br></font>
<input type="TEXT" NAME="title" placeholder="Enter a movie" size=20><br/>

<INPUT TYPE="submit" VALUE="Query!~~"><br><br>

<div class="div3">
<?php 

$title = $_GET["title"];
if($title) {
  $db = mysqli_connect('localhost', 'cs143', '', 'CS143');
   if($db->connect_errno > 0){ 
   die('Unable to connect to database [' . $db->connect_error . ']');
   }
   $titleArr = explode(" ",$title);
   $arrSize=count($titleArr);

  $query="Select id as movie_id, title as 'Movie Title', year as Year from Movie where ";
  for($i=0;$i<$arrSize;$i++)
  {
    $item=$titleArr[$i];
    $query.="(INSTR(title,'$item')>0)";
    if($i!=($arrSize-1))
    {
      $query.=" and ";
    }
  }
  
  $result =  mysqli_query($db,$query);
  
  $numFields = mysqli_num_fields($result);
  $fields=array();
  for($i=0;$i<$numFields;$i++)
  {   
    array_push($fields, mysqli_fetch_field_direct($result,$i)->name);
	       }
  echo "<br><center><font color=\"#FFFFFF\">Matching Movies Are</font></center><br>";
  echo "<center><table border=1 cellspacing=1 cellpadding=2><tr></center>";
  foreach($fields as $element)
  {
    if($element!='movie_id'){
        echo "<th><font color=\"#FFFFFF\">$element</font></th>";
    }
  }
 
    echo "</tr>";

    while($row = $result->fetch_assoc()) {
    echo "<tr>";
    
    foreach($fields as $element)
    {
      if($element=='movie_id')
      {
        $movie_id=$row[$element];
      }
      else
      {
        $item=$row[$element];
        if($element=='Movie Title')
        {
          $href="<td><center><a href=\"http://localhost:1438/~cs143/movie_info.php?id=$movie_id\">$item</a></center></td>";
          echo $href;
        }
        else{
          echo "<td><center><font color=\"#FFFFFF\">$item</font></center></td>";
        }
      }
    }
    echo "</tr>";
    }
echo "</table><br/>";
  
  $db->close();
  
  }
?>
</center>
  </div>
  </div>
</FORM>

</body>
</html>

<html>
<head>

<title> Add Actor->Movie Relation! </title>

<style>
  input {display: block;}
  h1{
  font: normal normal Arial, Tahoma, Helvetica, FreeSans, sans-serif;
  color: white;
  }
  body{
  font: normal normal 13px Arial, Tahoma, Helvetica, FreeSans, sans-serif;
  color: white;
  }
  select {
  background-color: #1A1B1D;
  color: white;
  display: inline;
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
  <center><h1>Add Actor To Movie</h1></center>
<?php

   $db = mysqli_connect('localhost', 'cs143', '', 'CS143');
   if($db->connect_errno > 0)
   { 
     die('Unable to connect to database [' . $db->connect_error . ']');
   }
   $query="Select concat(first, ' ', last) as Name from Actor order by last asc;";
   $result =  mysqli_query($db,$query);
    echo '<form method = "GET"><center>';
    echo "<select name='name' size=20 required>";
    echo "<option selected disabled>Actor's Name</option>";
    while ($row = $result->fetch_assoc()) {
      unset($id, $name);
      $id = $row['Name'];          
      echo '<option value="'.$id.'">'.$id.'</option>';
    }
    echo "</select>";

    $query2="Select Title from Movie order by title asc;";
       $result =  mysqli_query($db,$query2);
    echo "<html><body><select name='title' size=20 required>";
    echo "<option selected disabled>Movie Title</option>";
    while ($row = $result->fetch_assoc()) {
      unset($title, $title);
      $title = $row['Title'];          
      echo '<option value="'.$title.'">'.$title.'</option>';
	  }
	  
    echo '<input type="text" name="role" placeholder="Role"<br><br>';
    echo '<INPUT TYPE="submit" VALUE="Query!~~">';
    echo '</center></form>';
    
    $actor=$_GET['name'];
    $movie=$_GET['title'];
    $role=$_GET['role'];
    if($actor)
    {
      $name=explode(" ",$actor);
      $last=$name[1];
      $first=$name[0];

      $query="select id from Actor where first='$first' and last='$last';";
      $result =  mysqli_query($db,$query);
      $row = $result->fetch_assoc();
      $aid=$row['id'];
      
      $query="select id from Movie where title='$movie';";
      $result =  mysqli_query($db,$query);
      $row = $result->fetch_assoc();
      $mid=$row['id'];
    
      if($role=='')
      {
        $stmt = $db->prepare("INSERT INTO MovieActor(mid, aid) VALUES (?, ?);");
        $stmt->bind_param("is", $mid, $aid);
      }
      else
      {
        $stmt = $db->prepare("INSERT INTO MovieActor(mid, aid,role) VALUES (?, ?,?);");
        $stmt->bind_param("iss", $mid, $aid,$role);
      }
        $stmt->execute();
        echo "<center>Successfully added relation!</center>";
    }
	?>
</div>
</div>
</body>
</html>

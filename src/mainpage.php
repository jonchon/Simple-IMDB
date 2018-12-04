<html>
<head>

  <title> Actor Search </title>
  <style>
    @keyframes blink {
    0% {
        opacity: 1;
    }
    50% {
        opacity: 1;
    }
    75% {
    opacity: 0;
    }
    100% {
        opacity: 1;
    }
}
img {
    animation: blink 3s;
    animation-iteration-count: infinite;
}
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
  <center><font color="white"><h1>Hello! Welcome to MovieHub!</h1>
      <br><br>
  <h3>
  MovieHub is a database that holds all of your favorite Movies, Actors, and Directors!<br>
  Check out your favorite movie stars and learn all about them<br>
  </h3>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <a href='http://localhost:1438/~cs143/secretpage.php'>
  <img src="http://localhost:1438/~cs143/ad.jpg" width=70% height = 200px></a>
  </div>
  </font></center>
  
</body>
</html>

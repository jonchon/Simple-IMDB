/*set Movie ID as the primary key
Year cannot be less than 0
Make sure rating is valid*/
CREATE TABLE Movie(
       id INT NOT NULL, 
       title VARCHAR(100) NOT NULL,
       year INT NOT NULL,
       rating VARCHAR(10),
       company VARCHAR(50),
       PRIMARY KEY(id),
       CHECK(rating='G' OR rating='PG' OR rating='PG-13' OR rating='R' OR rating='NC-17' OR rating='UNRATED'),
       CHECK(year > 0))
       ENGINE = INNODB;

/*set Actor ID as the primary key
checks to make sure that sex is valid
checks to make sure that dob is less than dod*/
CREATE TABLE Actor(
       id INT NOT NULL,
       last VARCHAR(20) NOT NULL,
       first VARCHAR(20) NOT NULL,
       sex VARCHAR(6) NOT NULL,
       dob DATE NOT NULL,
       dod DATE,
       PRIMARY KEY(id),
       CHECK(sex='male' OR sex='female' OR sex='other'),
       CHECK(dob < dod))
       ENGINE = INNODB;

/*set Director ID as the primary key
checks to make sure that dob is less than dod*/
CREATE TABLE Director(
       id INT NOT NULL,
       last VARCHAR(20) NOT NULL,
       first VARCHAR(20) NOT NULL,
       dob DATE NOT NULL,
       dod DATE,
       PRIMARY KEY (id),
       CHECK(dob < dod))
       ENGINE = INNODB;

/*set Movie ID as the primary key
Movie ID is Movie's primary key*/
CREATE TABLE MovieGenre(
       mid INT NOT NULL,
       genre VARCHAR(20) NOT NULL,
       PRIMARY KEY(mid,genre),
       FOREIGN KEY(mid) REFERENCES Movie(id))
       ENGINE = INNODB;

/*Movie ID and Director ID used together is the primary key
Movie ID is Movie's primary key
Director ID is Director's primary key*/
CREATE TABLE MovieDirector(
       mid INT,
       did INT,
       PRIMARY KEY(mid,did),
       FOREIGN KEY(mid) REFERENCES Movie(id),
       FOREIGN KEY(did) REFERENCES Director(id))
       ENGINE = INNODB;

/*Movie ID and Actor ID used together is the primary key
Movie ID is Movie's primary key
Actor ID is Actor's primary key*/
CREATE TABLE MovieActor(
       mid Int NOT NULL,
       aid Int NOT NULL,
       role VARCHAR(50) ,
       PRIMARY KEY(mid, aid),
       FOREIGN KEY(mid) REFERENCES Movie(id),
       FOREIGN KEY(aid) REFERENCES Actor(id))
       ENGINE = INNODB;

/*Name, time, and Movie ID used together is the primary key
Movie ID is Movie's primary key*/
CREATE TABLE Review(
       name VARCHAR(20) NOT NULL,
       time TIMESTAMP NOT NULL,
       mid INT NOT NULL,
       rating INT NOT NULL,
       comment VARCHAR(500) NOT NULL,
       PRIMARY KEY(name,time,mid),
       FOREIGN KEY(mid) REFERENCES Movie(id))
       ENGINE = INNODB;
  
CREATE TABLE MaxPersonID(
       id INT NOT NULL);
  
CREATE TABLE MaxMovieID(
       id INT NOT NULL);

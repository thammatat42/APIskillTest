#For API Demo

How to install this demo
1. Create DB on MySQL server (uf8_general_ci)
2. Create Table on command below
  CREATE TABLE `tb_user` (
  `ID` int(11) NOT NULL,
  `FNAME` varchar(50) NOT NULL,
  `LNAME` varchar(50) NOT NULL,
  `CONTACT` varchar(10) NOT NULL,
  `IMG` varchar(120) NOT NULL,
  `EMAIL` varchar(120) NOT NULL,
  `GENDER` varchar(10) NOT NULL,
  `ADDRESS` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


  3.Clone this project on server

  4.Use Postman for test API CRUD
  Link for testing (Port server depend on you setting.)
  - Read: http://localhost:84/RestfulAPI/users/read.php (GET)
  - Read on Parameters: http://localhost:84/RestfulAPI/users/read.php?id=1 (GET)
  - Create: http://localhost:84/RestfulAPI/users/create.php (POST)
  - Update: http://localhost:84/RestfulAPI/users/update.php?id=1 (PUT)
  - Delete: http://localhost:84/RestfulAPI/users/delete.php?id=1 (DELETE)

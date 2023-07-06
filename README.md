<a name="readme-top"></a>


<!-- PROJECT LOGO -->
<br />
<div align="center">

  <h3 align="center">BlackVault File Sharing Website</h3>

  <p align="center">
    A simple file sharing website made with PHP!
    <br />
    <a href="https://github.com/AstoundingBF/BlackVault---Anoynmous-File-Sharing-Website"><strong>Explore the docs »</strong></a>
    <br />
    <br />
    ·
    <a href="https://github.com/AstoundingBF/BlackVault---Anoynmous-File-Sharing-Website/issues">Report Bug</a>
  </p>
</div>



<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
  </ol>
</details>




<p align="right">(<a href="#readme-top">back to top</a>)</p>



### Built With
* [![JQuery][JQuery.com]][JQuery-url]

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- GETTING STARTED -->
## Getting Started

To get started follow the read me

### Prerequisites

Prerequisites to run the website
* Upgrade Server
  ```sh
  sudo apt-get update && apt-get ugprade
  ```
* Install MariaDB
  ```sh
  sudo apt install mariadb-server
  ```
* Go into MySQL to create a database
  ```sh
  mysql 
  ```
* Create Database
  ```sh
  CREATE DATABASE your_database_name;
  ```
* Create a new Database user
  ```sh
  CREATE USER 'your_username'@'localhost' IDENTIFIED BY 'your_password';
  ```
* Grant Privilages to the user
  ```sh
  GRANT ALL PRIVILEGES ON your_database_name.* TO 'your_username'@'localhost';
  ```
* Flush privilages and exit
  ```sh
  FLUSH PRIVILEGES;
  EXIT;
  ```

### Installation

_Below is an example of how you can instruct your audience on installing and setting up your app. This template doesn't rely on any external dependencies or services._

1 Go into MySQL to create a database
  ```sh
  mysql 
  ```
2 Create Database
  ```sh
  CREATE DATABASE your_database_name;
  ```
3 Create a new Database user
  ```sh
  CREATE USER 'your_username'@'localhost' IDENTIFIED BY 'your_password';
  ```
4 Grant Privilages to the user
  ```sh
  GRANT ALL PRIVILEGES ON your_database_name.* TO 'your_username'@'localhost';
  ```
5 Flush privilages and exit
  ```sh
  FLUSH PRIVILEGES;
  EXIT;
  ```
6 Installing Apache2
  ```sh
  sudo apt install apache2
  ```
7 Installing PHP
  ```sh
  sudo apt install php
  ```
7 Installing php-mysql
  ```sh
  sudo apt-get install php-mysql
  ```
8 Adding tables to database
  ```sh
  CREATE TABLE `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash` (`hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

  To add tables go into mysql using mysql in cli then USE your_database_name; then paste the tables
  ```
7 Installing files(Clone into your webserver root folder or virtual host folder
  ```sh
  git clone https://github.com/AstoundingBF/BlackVault---Anoynmous-File-Sharing-Website.git
  ```
8 Making the uploads folder in uploader root folder. 
  ```sh
  mkdir uploads
  chmod 0777 uploads/
  ```
9 Restarting apache2 server
  ```sh
  systemctl restart apache2
  ```
<p align="right">(<a href="#readme-top">back to top</a>)</p>









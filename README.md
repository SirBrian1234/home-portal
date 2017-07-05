# home-portal
The Home Portal Project is a peer based social network with a web front-end built for decentralized and peer communication.

For more information about the project please view the project's article from the following url.

https://kostiskag.wordpress.com/2015/12/24/home-portal-a-social-network-of-peers/

## News
The Home Portal projet will be moved from sourceforge to here for the reason that it is very demanding to keep an executable installer up to date as the project has many build in executables in windows such as modifying registry for the install, uninstall and applying plug and play. For this reason it is decided fot the user to receive the installation instructions through this page.

## Requirements
The project runs on php 5.3, 5.4

## Install on Linux
Under Dev

## Install on Windows
The user is suggested to install the xampp bundle and modify it accordingly to install Home Portal over it.

Download xampp 1.8.0 version which supports php 5.4 from the following url:
https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/1.8.0/

Install Apache and mysql,
As soon as the instalation is done go to:
http://127.0.0.1/phpmyadmin/

create a new database called home_portal
import the file **home_portal.sql** from the **sql** directory

go to htdocs,
Either create a new folder for home portal
or delete the index file
paste the **www** contend on the desired folder

acces the page from:
http://127.0.0.1/
or
http://127.0.0.1/your-folder

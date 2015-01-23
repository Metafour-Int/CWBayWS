# CWBayWS
Back-end for CWBay Android app

### How to install
* Install WAMP/XAMP.
* Open a DOS command line and issue the command: **php --version**, if it cannot find **php** command, set **PATH** variable to point to php bin location.
* Now to create the database do the following:
    * Open a DOS prompt and go to CWBayWS/ directory.
        * **php app/console doctrine:database:create**
        * **php app/console doctrine:schema:update --force**
    * Now go to phpMyAdmin and open the database 'CWBay' and run the following SQL:
        * **insert into users(email, password,is_active) values('app', 'pass', 1);**
* Now run the server using the following command:
    * **php app/console server:run 192.168.1.176:8000**  
*Note: set your IP in the above command.*
* Now your CWBay web service is ready :)

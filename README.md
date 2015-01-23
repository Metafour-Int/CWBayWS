# CWBayWS
Back-end for CWBay Android app

# How to install
1. Install WAMP/XAMP.
2. Open a DOS command line and issue the command: "php --version", if it cannot find 'php' command, set PATH variable to point to php bin location.
3. Now to create the database do the following:
    3.1 Open a DOS prompt and go to CWBayWS/ directory.
    3.2 **php app/console doctrine:database:create**
    3.3 **php app/console doctrine:schema:update --force**
    3.4 Now go to phpMyAdmin and open the database 'CWBay' and run the following SQL:
            **insert into users(email, password,is_active) values('app', 'pass', 1);**
4. Now run the server using the following command:
            **php app/console server:run 192.168.1.176:8000**
   Note: set your IP in the above command.
5. Now your CWBay web service is ready :)

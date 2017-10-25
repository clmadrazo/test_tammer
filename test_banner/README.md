Apigility
http://test-tammer.com/docs/apigility/public/apigility/ui#/

$ cd path/to/install
$ php -S 127.0.1.11:8080 -t public/ public/index.php
# OR use the composer alias:
$ composer run --timeout 0 serve

This will start the cli-server on port 8080, and bind it to all network interfaces. You can then visit the site at http://localhost:8080/

    which will bring up Zend Framework welcome page.

Note: The built-in CLI server is for development only.

Web server setup
Apache setup

To setup apache, setup a virtual host to point to the public/ directory of the project and you should be ready to go! It should look something like below:

<VirtualHost 127.0.0.11:80>
   ServerAdmin madrazoreyescarloslazaro@gmail.com
   ServerName test-tammer.com
   ServerAlias test-tammer.com
   DocumentRoot "C:\wamp64\www\test_banner"
   SetEnv APPLICATION_ENV "local"
   <Directory C:\wamp64\www\test_banner_fe>
     AllowOverride All
     Order allow,deny
     Allow from all
   </Directory>
   Alias /ws "C:\wamp64\www\test_banner\public"
   <Directory "C:\wamp64\www\test_banner\public>
     DirectoryIndex index.php
     AllowOverride All
     Order allow,deny
     Allow from all
   </Directory>
</VirtualHost>

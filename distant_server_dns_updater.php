<?php

/* 
 * This will allow you to change dynamically your tartegeted IP on this domain.
 * The Ip given into parameters will be put in an .htaccess file to redirect requests to the current ip.
 */

/**
 * get the ip given into parameter
 */
$currentIp=$_GET["ip"];
/**
 * password set into tje local_server_ip_sender.php.
 * Must be strictly the same
 */
$authenticatePassword="mypass";
if($_GET["password"]==$authenticatePassword){
    /*
     * delete the current .htaccess file and write a new with the current ip. 
     */
    $file = '.htaccess';
    if (file_exists($file)) {
        unlink($file);
    }
    $myfile = fopen($file, "w") or die("Unable to open file!");
    //
    $txt="Options +FollowSymLinks\nRewriteEngine On\nRewriteCond %{REQUEST_URI} !^/distant_server_dns_updater.php\nRewriteRule ^(.*)$ http://".$currentIp."/$1 [R=301,L]\n";
    fwrite($myfile, $txt);
    fclose($myfile);
    echo "write : <br>".$txt;
}

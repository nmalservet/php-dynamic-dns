<?php

/* 
 * This script will send your  external IP to your distant server to update your DNS with this new IP.
 * To programatically do it, you need to add a cron task on your local server.
 * To do it use : crontab -e
 * then add a line like this : 
 *   * * * * * /.../local_server_ip_sender.php &> /dev/null
 */

$URL_UPDATER_PAGE="http://myserver.eu/distant_server_dns_updater.php";
$PASSWORD="mypass";

$externalContent = file_get_contents('http://checkip.dyndns.com/');
preg_match('/Current IP Address: ([\[\]:.[0-9a-fA-F]+)</', $externalContent, $m);
$externalIp = $m[1];
echo $externalIp;

$payload = file_get_contents(URL_UPDATER_PAGE.'?ip='.$externalIp."&password=".$PASSWORD);


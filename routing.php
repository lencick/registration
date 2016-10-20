<?php

class Routing
{ 
      function request_url()
      {
        $result = ''; 
        $default_port = 80; 
       
        if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS']=='on')) {
          $result .= 'https://';
          $default_port = 443;
        } else {
          $result .= 'http://';
        }
        $result .= $_SERVER['SERVER_NAME'];

        if ($_SERVER['SERVER_PORT'] != $default_port) {
          $result .= ':'.$_SERVER['SERVER_PORT'];
        }
        $result .= $_SERVER['REQUEST_URI'];

        return $result;
      }
}
?>
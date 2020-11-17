
<?php
function defender_xss($arr){
    $filter = array("<", ">","="," (",")",";","/");
     foreach($arr as $num=>$xss){
        $arr[$num]=str_replace ($filter, "|", $xss);
     }
       return $arr;
}

$_REQUEST=defender_xss($_REQUEST);

Options +FollowSymLinks
RewriteEngine On
RewriteCond %{QUERY_STRING} (\<|%3C).*script.*(\>|%3E) [NC,OR]
RewriteCond %{QUERY_STRING} GLOBALS(=|\[|\%[0-9A-Z]{0,2}) [OR]
RewriteCond %{QUERY_STRING} _REQUEST(=|\[|\%[0-9A-Z]{0,2})
RewriteRule ^(.*)$ index.php [F,L]
?>

<?php
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','root');
define('DB_NAME','message');

$db = @mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
if (!$db){
    echo '数据库连接错误';
}

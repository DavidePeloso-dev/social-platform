<?php
define("DB_SERVERNAME", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "root");
define("DB_NAME", "db_social");

$connection = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($connection && $connection->connect_error) {
    echo "connection faild: " . $connection->connect_error;
}

$sql =
    "SELECT `posts`.`id` AS `post_id`,`posts`.`title` AS `post_title`, COUNT(`likes`.`post_id`) AS `post_likes`
FROM `posts`
LEFT JOIN `likes`
ON `likes`.`post_id` = `posts`.`id`
GROUP BY `posts`.`id`  
ORDER BY `post_likes`  ASC";

$result = $connection->query($sql);
var_dump($result);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        var_dump($row);
    };
} elseif ($result) {
    echo "0 result";
} else {
    echo "query error";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


</body>

</html>
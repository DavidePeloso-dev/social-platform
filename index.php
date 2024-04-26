<?php

require_once __DIR__ . "/models/post.php";
require_once __DIR__ . "/models/media.php";

define("DB_SERVERNAME", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "root");
define("DB_NAME", "db_social");

$connection = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($connection && $connection->connect_error) {
    echo "connection faild: " . $connection->connect_error;
}

$sql =
    "SELECT DISTINCT `posts`.`id`,`posts`.`title`, `posts`.`tags`,JSON_ARRAYAGG(`medias`.`path`) AS `medias`, COUNT(`medias`.`path`) as media_count 
    FROM `posts` 
    LEFT JOIN `likes` 
    ON `likes`.`post_id` = `posts`.`id` 
    JOIN `media_post` 
    ON `media_post`.`post_id` = `posts`.`id` 
    JOIN `medias` 
    ON `medias`.`id` = `media_post`.`media_id` 
    WHERE `likes`.`post_id` IS NULL 
    GROUP BY `posts`.`id`";

$result = $connection->query($sql);
/* var_dump($result->fetch_assoc());
var_dump($result->fetch_assoc());
var_dump($result->fetch_assoc());
var_dump($result->fetch_assoc());
var_dump($result->fetch_assoc());
var_dump($result->fetch_assoc());
var_dump($result->fetch_assoc());
var_dump($result->fetch_assoc());
var_dump($result->fetch_assoc());
var_dump($result->fetch_assoc());
var_dump($result->fetch_assoc());
var_dump($result->fetch_assoc());
var_dump($result->fetch_assoc()); */

$posts = [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN' crossorigin='anonymous'>
</head>

<body>
    <div class="container">
        <h1>Less liked posts</h1>
        <div class="row row-cols-3">
            <?php if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $tags = json_decode($row['tags']);
                    $medias = json_decode($row['medias']);
                    $post = new post($row['id'], $row['title'], $tags, $medias);
                    array_push($posts, $post);
                }
            } elseif ($result) {
                echo "0 result";
            } else {
                echo "query error";
            };
            foreach ($posts as $post) : ?>
                <div class="col p-3">
                    <div class="card">
                        <div id="carouselExampleAutoplaying<?= $post->id ?>" class="carousel slide card-img-top" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php foreach ($post->medias as $i => $media) : ?>
                                    <div class="carousel-item <?php if ($i == 0) echo 'active' ?>">
                                        <img style="width: 100%; aspect-ratio: 1;" src="./<?= $media ?>" class="d-block w-100 card-img-top" alt="<?= $post->title ?>">
                                    </div>
                                <?php endforeach ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying<?= $post->id ?>" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying<?= $post->id ?>" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <div class="card-body position-relative">
                            <h5 class="card-title"><?= $post->title ?></h5>
                            <div class="card-text mb-5">
                                <span class="mb-0">Tags:</span>
                                <?php foreach ($post->tags as $tag) : ?>
                                    <div class="badge text-bg-secondary"><?= $tag ?></div>
                                <?php endforeach ?>
                            </div>
                            <a href="#" class="btn btn-primary position-absolute bottom-0 end-0 mb-3 me-3">Read More</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>

    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js' integrity='sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL' crossorigin='anonymous'></script>
</body>

</html>
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
    "SELECT DISTINCT `posts`.`title`, `posts`.`tags`
    FROM `posts`
    LEFT JOIN `likes`
    ON `likes`.`post_id` = `posts`.`id`
    JOIN `media_post`
    ON `media_post`.`post_id` = `posts`.`id`
    JOIN `medias`
    ON `medias`.`id` = `media_post`.`media_id`
    WHERE `likes`.`post_id` IS NULL";

$result = $connection->query($sql);
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
                while ($row = $result->fetch_assoc()) :
                    $title = $row['title'];
                    $tags = json_decode($row['tags']); ?>

                    <div class="col p-3">
                        <div class="card">
                            <img src="https://picsum.photos/400?random=1" class="card-img-top" alt="...">
                            <div class="card-body position-relative">
                                <h5 class="card-title"><?= $title ?></h5>
                                <div class="card-text mb-5">
                                    <span class="mb-0">Tags:</span>
                                    <?php foreach ($tags as $tag) : ?>
                                        <div class="badge text-bg-secondary <?= $tag ?>"><?= $tag ?></div>
                                    <?php endforeach ?>
                                </div>
                                <a href="#" class="btn btn-primary position-absolute bottom-0 end-0 mb-3 me-3">Read More</a>
                            </div>
                        </div>
                    </div>

            <?php endwhile;
            } elseif ($result) {
                echo "0 result";
            } else {
                echo "query error";
            }; ?>

        </div>
    </div>

    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js' integrity='sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL' crossorigin='anonymous'></script>
</body>

</html>
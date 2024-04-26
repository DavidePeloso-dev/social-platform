<?php

require_once __DIR__ . "/models/post.php";
require_once __DIR__ . "/models/media.php";

$media1 = new media('https://picsum.photos/400?random=1', 'photo');
$media2 = new media('https://picsum.photos/500?random=1', 'photo');

$medias = [$media1, $media2];

$post1 = new post(1, "ciao mondo", ['saluto', 'felice', 'spensierato'], $medias);
$post2 = new post(2, "bella fioi", ['saluto', 'amici', 'incontro'], $medias);

$posts = [$post1, $post2];

?>

<!doctype html>
<html lang='en'>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Document</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN' crossorigin='anonymous'>
</head>

<body>
    <div class="container">
        <div class="row row-cols-3">
            <?php foreach ($posts as $post) : ?>
                <div class="col p-3">
                    <div class="card">
                        <div id="carouselExampleAutoplaying<?= $post->id ?>" class="carousel slide card-img-top" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php foreach ($post->medias as $i => $media) : ?>
                                    <div class="carousel-item <?php if ($i == 0) echo 'active' ?>">
                                        <img src="<?= $media->path ?>" class="d-block w-100" alt="...">
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
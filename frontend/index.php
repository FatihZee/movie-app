<?php
if (isset($_GET['title'])) {
    $title = urlencode($_GET['title']);
    $apiUrl = "http://localhost:5000/api/movie?title=$title";
    
    $response = file_get_contents($apiUrl);
    $data = json_decode($response, true);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Search</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Movie Search</h1>
        <form method="GET" action="index.php" class="mb-3">
            <input type="text" name="title" class="form-control" placeholder="Enter movie title...">
            <button type="submit" class="btn btn-primary mt-2">Search</button>
        </form>
        <div id="movieDetails" class="mt-3">
            <?php if (isset($data)) : ?>
            <?php if ($data['Response'] === "False") : ?>
            <p class="text-danger">Movie not found!</p>
            <?php else : ?>
            <div class="movie-card">
                <h2><?= htmlspecialchars($data['Title']) ?> (<?= htmlspecialchars($data['Year']) ?>)</h2>
                <p><strong>Rated:</strong> <?= htmlspecialchars($data['Rated']) ?></p>
                <p><strong>Released:</strong> <?= htmlspecialchars($data['Released']) ?></p>
                <p><strong>Runtime:</strong> <?= htmlspecialchars($data['Runtime']) ?></p>
                <p><strong>Genre:</strong> <?= htmlspecialchars($data['Genre']) ?></p>
                <p><strong>Director:</strong> <?= htmlspecialchars($data['Director']) ?></p>
                <p><strong>Writer:</strong> <?= htmlspecialchars($data['Writer']) ?></p>
                <p><strong>Actors:</strong> <?= htmlspecialchars($data['Actors']) ?></p>
                <p><strong>Plot:</strong> <?= htmlspecialchars($data['Plot']) ?></p>
                <p><strong>Language:</strong> <?= htmlspecialchars($data['Language']) ?></p>
                <p><strong>Country:</strong> <?= htmlspecialchars($data['Country']) ?></p>
                <p><strong>Awards:</strong> <?= htmlspecialchars($data['Awards']) ?></p>
                <img src="<?= htmlspecialchars($data['Poster']) ?>" class="img-fluid my-3" alt="Movie Poster">
                <p><strong>IMDB Rating:</strong> <?= htmlspecialchars($data['imdbRating']) ?>
                    (<?= htmlspecialchars($data['imdbVotes']) ?> votes)</p>
                <p><strong>Metascore:</strong> <?= htmlspecialchars($data['Metascore']) ?></p>
                <p><strong>Box Office:</strong> <?= htmlspecialchars($data['BoxOffice']) ?></p>
                <p><strong>Production:</strong> <?= htmlspecialchars($data['Production']) ?></p>
                <h4>Ratings:</h4>
                <ul>
                    <?php foreach ($data['Ratings'] as $rating) : ?>
                    <li><strong><?= htmlspecialchars($rating['Source']) ?>:</strong>
                        <?= htmlspecialchars($rating['Value']) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>
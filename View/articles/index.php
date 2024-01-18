<?php require 'View/includes/header.php'?>

<?php // Use any data loaded in the controller here ?>

<section>
    <h1>Articles</h1>
    <ul>
        <?php foreach ($articles as $article) : ?>
            <h2><?= $article->getTitle(); ?></h2>
            <p>Summary: <?= $article->getDescription(); ?></p>
            <span>Date published: <?= $article->getDate(); ?></span>
        <?php endforeach; ?>
    </ul>
</section>

<?php require 'View/includes/footer.php'?>
<?php require 'View/includes/header.php'?>

<?php // Use any data loaded in the controller here ?>

<?php //TODO: change date to required format ?>

<section>
    <h1>Articles</h1>
    <ul>
        <?php foreach ($articles as $article) : ?>
            <h2><?= $article->getTitle(); ?></h2>
            <p>Summary: <?= $article->getDescription(); ?></p>
            <span>Date published: <?= $article->formatPublishDate(); ?></span>
        <?php endforeach; ?>
    </ul>
</section>

<?php require 'View/includes/footer.php'?>
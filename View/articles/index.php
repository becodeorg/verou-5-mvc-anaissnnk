<?php require 'View/includes/header.php'?>

<?php // Use any data loaded in the controller here 
//<p>Summary: <?= $article->getDescription();</p> ;
//<p><a href="index.php?page=articles-show&id=<?= $article->getId();
//>Read More</a></p>?>

<section>
    <h1>Articles</h1>
    <ul>
        <?php foreach ($articles as $article) : ?>
            <h2><?= $article->getTitle(); ?></h2>
            <span>Date published: <?= $article->formatPublishDate(); ?></span>
            <p><a href="index.php?page=articles-show&id=<?= $article->getId(); ?>">Read More</a></p>


            
        <?php endforeach; ?>
    </ul>
</section>

<?php require 'View/includes/footer.php'?>


<?php

declare(strict_types = 1);

class ArticleController
{
    private DatabaseManager $databaseManager;

    public function __construct(DatabaseManager $databaseManager) {
        $this->databaseManager = $databaseManager;
    }

    public function index()
    {
        // Load all required data
        $articles = $this->getArticles();

        // Load the view
        require 'View/articles/index.php';
    }

    // Note: this function can also be used in a repository - the choice is yours
    private function getArticles()
    {
        // TODO: prepare the database connection
        // Note: you might want to use a re-usable databaseManager class - the choice is yours

        // TODO: fetch all articles as $rawArticles (as a simple array)
        try {
            $query = "SELECT * FROM articles;";

            $statement = $this->databaseManager->connection->prepare($query);
            $statement->execute();
            $rawArticles = $statement->fetchAll();

            $articles = [];
            foreach ($rawArticles as $rawArticle) {
                // We are converting an article from a "dumb" array to a much more flexible class
                $articles[] = new Article($rawArticle['title'], $rawArticle['description'], $rawArticle['publish_date']);
            }

            return $articles;

        } catch (PDOException $e) {
            echo("Select query failed" . $e->getMessage());
        }
    }


    public function show()
    {
        // TODO: this can be used for a detail page
        $articles = $this->getArticles();
        require 'View/articles/show.php';

    }
}
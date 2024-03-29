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
                $articles[] = new Article($rawArticle['id'], $rawArticle['title'], $rawArticle['description'], $rawArticle['publish_date']);
            }

            return $articles;

        } catch (PDOException $e) {
            echo("Select query failed" . $e->getMessage());
        }
    }

    public function show()
    {
        if (isset($_GET['id'])) {
            $articleId = (int)$_GET['id'];
            $article = $this->searchByID($articleId);
    
            if ($article) {
                require 'View/articles/show.php';
                return;
            }
        }
        
        header("Location: index.php?page=error");
        exit();
    }
    


    public function searchByID($id)
    {
        try {
            $query = "SELECT * FROM articles WHERE id = :id ;";
    
            $statement = $this->databaseManager->connection->prepare($query);
            $statement->bindParam(":id", $id);
            
            $statement->execute();
            $rawArticle = $statement->fetch();
    
            if ($rawArticle) {
                return new Article($rawArticle['id'], $rawArticle['title'], $rawArticle['description'], $rawArticle['publish_date']);
            } else {
                return null;  // Article not found
            }
    
        } catch (PDOException $e) {
            echo("Get Article by ID query failed" . $e->getMessage());
            return null;  // Handle the error appropriately
        }
    }
    
}
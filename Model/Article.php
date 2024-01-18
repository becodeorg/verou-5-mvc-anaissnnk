<?php

declare(strict_types=1);

class Article
{
    public string $title;
    public ?string $description;
    public ?string $publishDate;

    public function __construct(string $title, ?string $description, ?string $publishDate)
    {
        $this->title = $title;
        $this->description = $description;
        $this->publishDate = $publishDate;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getDate() {
        return $this->publishDate;
    }

    public function formatPublishDate($format = 'D-M-Y')
    {
        // TODO: return the date in the required format
        $dateToConvert = $this->publishDate;;
        if ($dateToConvert !== null) {
            $formattedDate = date($format, strtotime($dateToConvert));
            return $formattedDate;
        }
    }
}
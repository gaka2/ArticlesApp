<?php

declare(strict_types=1);

namespace ArticlesApp\Model;

/**
 * @author Karol Gancarczyk
 */
class Article {

    private $title;
    private $description;
    private $link;
    private $pubDate;
    private $creator;

    public function getTitle(): string {
        return $this->title;
    }

    public function setTitle(string $title){
        $this->title = $title;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $description){
        $this->description = $description;
    }

    public function getLink(): string {
        return $this->link;
    }

    public function setLink(string $link){
        $this->link = $link;
    }

    public function getPubDate(): \DateTime {
        return $this->pubDate;
    }

    public function setPubDate(\DateTime $pubDate){
        $this->pubDate = $pubDate;
    }

    public function getCreator(): string {
        return $this->creator;
    }

    public function setCreator(string $creator){
        $this->creator = $creator;
    }
}
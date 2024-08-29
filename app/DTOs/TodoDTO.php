<?php
namespace App\DTOs;

class TodoDTO
{
    public $title;
    public $content;
    public $isFavorite;
    public $color;

    public function __construct($title, $content, $isFavorite = false, $color = '#FFF')
    {
        $this->title = $title;
        $this->content = $content;
        $this->isFavorite = $isFavorite;
        $this->color = $color;
    }
}

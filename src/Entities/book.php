<?php
class Book {
    public $id;
    public $title;
    public $author;
    public $isbn;
    public $status;

    public function __construct($title, $author, $isbn, $status = "Disponible") {
        $this->title = $title;
        $this->author = $author;
        $this->isbn = $isbn;
        $this->status = $status;
    }
}
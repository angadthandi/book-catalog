<?php

class Book {

    public const FICTION = 0;
    public const SCI_FI = 1;
    public const MYSTERY = 2;

    private Int $id;
    private String $name;
    private String $author;
    private String $publisher;
    private Int $publishYear;
    private Int $category;
    private Float $price;
    private Int $copiesSold;

    private static Int $idIncrementor = 0;

    public function __construct(
        String $name,
        String $author,
        String $publisher,
        Int $publishYear,
        Int $category,
        Float $price,
        Int $copiesSold
    ) {
        static::$idIncrementor++;

        $this->id = static::$idIncrementor;
        $this->name = $name;
        $this->author = $author;
        $this->publisher = $publisher;
        $this->publishYear = $publishYear;
        $this->category = $category;
        $this->price = $price;
        $this->copiesSold = $copiesSold;
    }

    public function GetID(): Int {
        return $this->id;
    }

    public function GetName(): String {
        return $this->name;
    }

    public function GetAuthor(): String {
        return $this->author;
    }

    public function GetPublisher(): String {
        return $this->publisher;
    }

    public function GetCategory(): Int {
        return $this->category;
    }

    public function GetCopiesSold(): Int {
        return $this->copiesSold;
    }

}
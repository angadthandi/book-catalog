<?php

require_once __DIR__ . "/../book/book.php";

class Catalog {

    private array $books; // Book[]
    private array $mapAuthorBooks; // {AuthorName: MaxHeap[ count, bookID, book ]}
    private array $mapCategoryBooks; // {Category: MaxHeap[ count, bookID, book ]}

    // max heap

    public function __construct() {
        $this->books = [];
        $this->mapAuthorBooks = [];
        $this->mapCategoryBooks = [];
    }

    public function PrintLine(String $oper): void {
        $total = 40;
        $s = '';
        for ($i=0; $i<$total; $i++) {
            if ($i == ($total / 2)) {
                $s .= $oper;
            } else {
                $s .= '-';
            }
        }
        error_log($s);
    }

    public function GetMapAuthorBooks(): Array {
        return $this->mapAuthorBooks;
    }

    public function GetMapCategoryBooks(): Array {
        return $this->mapCategoryBooks;
    }

    public function addBook(Book $book): void {
        $this->books[] = $book;

        $author = $book->GetAuthor();
        if (!array_key_exists($author, $this->mapAuthorBooks)) {
            $this->mapAuthorBooks[ $author ] = new MaxHeap();
        }
        $this->mapAuthorBooks[ $author ]->insert(
            [$book->GetCopiesSold(), $book->GetID(), $book]
        );

        $category = $book->GetCategory();
        if (!array_key_exists($category, $this->mapCategoryBooks)) {
            $this->mapCategoryBooks[ $category ] = new MaxHeap();
        }
        $this->mapCategoryBooks[ $category ]->insert(
            [$book->GetCopiesSold(), $book->GetID(), $book]
        );
    }

    // Book[]
    public function searchByName(String $prefix): array {
        $ret = [];
        foreach($this->books as $book) {
            $bookPrefix = substr($book->GetName(), 0, strlen($prefix));

            if ($bookPrefix == $prefix) {
                $ret[] = $book;
            }
        }
        return $ret;
    }

    // Book[]
    public function searchByAuthor(String $author): array {
        $ret = [];
        $authorBooksMaxHeap = $this->mapAuthorBooks[$author];
        foreach($authorBooksMaxHeap as $bookData) {
            $ret[] = $bookData[2];
        }
        return $ret;
    }

    // Book[]
    public function getMostBooksSoldByAuthor(
        String $author,
        Int $limit,
    ): array {
        $tmpLimit = $limit; //to put back same no. of books in heap
        $ret = [];
        $authorBooksMaxHeap = $this->mapAuthorBooks[$author];
        foreach($authorBooksMaxHeap as $bookData) {
            if ($tmpLimit==0) break;

            $ret[] = $bookData[2];

            $tmpLimit -= 1;
        }

        // the above foreach pops from heap
        // 
        // push back to heap
        foreach($ret as $book) {
            $this->mapAuthorBooks[ $author ]->insert(
                [$book->GetCopiesSold(), $book->GetID(), $book]
            );

            $tmpLimit += 1;
            if ($tmpLimit==$limit) break;
        }

        return $ret;
    }

    // Book[]
    public function getMostBooksSoldByCategory(
        Int $category,
        Int $limit,
    ): array {
        $tmpLimit = $limit; //to put back same no. of books in heap
        $ret = [];
        $categoryBooksMaxHeap = $this->mapCategoryBooks[$category];
        foreach($categoryBooksMaxHeap as $bookData) {
            if ($tmpLimit==0) break;

            $ret[] = $bookData[2];

            $tmpLimit -= 1;
        }

        // the above foreach pops from heap
        // 
        // push back to heap
        foreach($ret as $book) {
            $this->mapCategoryBooks[ $category ]->insert(
                [$book->GetCopiesSold(), $book->GetID(), $book]
            );

            $tmpLimit += 1;
            if ($tmpLimit==$limit) break;
        }

        return $ret;
    }

}
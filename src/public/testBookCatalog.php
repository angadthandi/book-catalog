<?php

require_once __DIR__ . "/../app/book/book.php";
require_once __DIR__ . "/../app/catalog/catalog.php";
require_once __DIR__ . "/../app/maxheap/maxheap.php";

error_log("Test Book Catalog!");

// error_log(Book::SCI_FI);

// $maxHeap = new MaxHeap();
// $maxHeap->insert( 4 );
// $maxHeap->insert( 8 );
// $maxHeap->insert( 1 );
// $maxHeap->insert( 0 );

// error_log(print_r($maxHeap,true));

// $arr=[];
// $k = 3;
// foreach($maxHeap as $num) {
//     $arr[]=$num;
//     $k -= 1;
//     if ($k==0) break;
// }
// error_log(print_r($arr,true));

// error_log('maxHeapWithArrElem');
// $maxHeapWithArrElem = new MaxHeap();
// $maxHeapWithArrElem->insert( [4, 1, []] );
// $maxHeapWithArrElem->insert( [8, 2, []] );
// $maxHeapWithArrElem->insert( [0, 3, []] );
// $maxHeapWithArrElem->insert( [0, 4, []] );

// error_log(print_r($maxHeapWithArrElem,true));

// $arrWithArrElem=[];
// $k = 3;
// foreach($maxHeapWithArrElem as $arrElem) {
//     $arrWithArrElem[]=$arrElem;
//     $k -= 1;
//     if ($k==0) break;
// }
// error_log(print_r($arrWithArrElem,true));

// -------------------------------------------------------------

$book1 = new Book(
    'HP & Book 1', 'JK Author 1', 'Pub 1',
    1997, Book::FICTION, 200, 80
);
$book2 = new Book(
    'HP & Book 2', 'JK Author 1', 'Pub 1',
    1998, Book::FICTION, 1000, 100
);
$book3 = new Book(
    'HP & Book 3', 'JK Author 1', 'Pub 1',
    1999, Book::FICTION, 2000, 500
);
$book4 = new Book(
    'HP & Book 4', 'JK Author 1', 'Pub 1',
    2005, Book::FICTION, 3000, 700
);
$book5 = new Book(
    'The Book 5', 'Mystery Author 2', 'Mystery Pub 2',
    2010, Book::MYSTERY, 1500, 600
);
$book6 = new Book(
    'The Book 6', 'Mystery Author 2', 'Mystery Pub 2',
    2011, Book::MYSTERY, 2500, 400
);
$book7 = new Book(
    'The Book 7', 'Mystery Author 2', 'Mystery Pub 2',
    2013, Book::MYSTERY, 3500, 200
);
$book8 = new Book(
    'SCI_FI Book 8', 'SCI_FI Author 3', 'SCI_FI Pub 3',
    1968, Book::SCI_FI, 30, 20
);

$catalog = new Catalog;
$catalog->addBook($book1);
$catalog->addBook($book2);
$catalog->addBook($book3);
$catalog->addBook($book4);
$catalog->addBook($book5);
$catalog->addBook($book6);
$catalog->addBook($book7);
$catalog->addBook($book8);

$mystAuthBooks = $catalog->getMostBooksSoldByAuthor('Mystery Author 2', 5);
$catalog->PrintLine('getMostBooksSoldByAuthor');
error_log(print_r($mystAuthBooks, true));

$ficCatBooks = $catalog->getMostBooksSoldByCategory(Book::FICTION, 2);
$catalog->PrintLine('ficCatBooks');
error_log(print_r($ficCatBooks, true));

$allMystAuthBooks = $catalog->searchByAuthor('Mystery Author 2');
$catalog->PrintLine('allMystAuthBooks');
error_log(print_r($allMystAuthBooks, true));

// error_log(print_r($catalog->GetMapAuthorBooks(), true));
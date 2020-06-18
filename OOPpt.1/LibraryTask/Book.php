<?php

abstract class Book
{
    abstract function getContent(): string;
}

class Ebook extends Book
{
    private string $name;
    private string $content;

    public function getContent(): string
    {
        return "-——You're reading e-book——-" . "\n" . $this->content;
    }

    function __construct(string $name, string $content)
    {
        $this->name = $name;
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}

class OldBook extends Book
{
    private string $name;
    private string $content;

    public function getContent(): string
    {
        return "——Oh you can really dance——" . "\n" . $this->content;
    }

    function __construct(string $name, string $content)
    {
        $this->name = $name;
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}


class Library
{
    public array $books = [];

    public function addBook(Book $book): void
    {
        $this->books[] = $book;
    }

    public function getBook(string $title, string $type): Book
    {
        foreach ($this->getBooks() as $index => $book) {
            if ($type === "PaperBook" && $book instanceof OldBook && $title === $book->getName()) {
                $tempBook = $book;
                unset($this->books[$index]);
                return $tempBook;
            } else if ($type === "E-Book" && $book instanceof EBook && $title === $book->getName()) {
                return $book;
            }
        }
    }

    /**
     * @return array
     */
    public function getBooks(): array
    {
        return $this->books;
    }
}

$library = new Library();
$ebook = new Ebook('Marmon', 'Scorseze');
$pbook = new OldBook('Marmon', 'Scorseze');
$library->addBook($ebook);
$library->addBook($pbook);
$book1 = $library->getBook('Marmon', 'PaperBook');
$book2 = $library->getBook('Marmon', 'E-Book');
echo $book1->getContent() . "\n";
echo $book2->getContent();



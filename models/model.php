<?php

/**
 * Fonction pour se connecter à la base de données MySQL.
 * @return PDO L'objet PDO pour interagir avec la base de données.
 */
function mysqlConnect()
{
    try {
        $db = new PDO('mysql:host=localhost;dbname=bookshelf;charset=utf8', 'root', 'IHaveBigSe..x...password :p');
        return $db;
    } catch (Exception $e) {
        displayViews("500");
        die();
    }
}

/**
 * Fonction pour récupérer tous les livres de la base de données.
 * @return array Un tableau contenant tous les livres.
 */
function getBooks()
{
    $database = mysqlConnect();
    $statement = $database->query(
        "SELECT * FROM books"
    );
    $books = [];
    while (($row = $statement->fetch())) {
        $book = [
            'id' => $row['id'],
            'name' => $row['name'],
            'author' => $row['author'],
            'summary' => $row['summary'],
            'year' => $row['year']
        ];

        $books[] = $book;
    }

    return $books;
}

/**
 * Fonction pour créer un livre dans la base de données.
 * @param string $name Le nom du livre.
 * @param string $author L'auteur du livre.
 * @param string $year L'année de publication du livre.
 * @param string $summary Le résumé du livre.
 */
function createBook($name, $author, $year, $summary)
{
    $database = mysqlConnect();
    $statement = $database->prepare("INSERT INTO books (name,author,year,summary) VALUES (:name,:author,:year,:summary)");
    $statement->bindValue(':name', $name, PDO::PARAM_STR);
    $statement->bindValue(':author', $author, PDO::PARAM_STR);
    $statement->bindValue(':year', $year, PDO::PARAM_STR);
    $statement->bindValue(':summary', $summary, PDO::PARAM_STR);

    if (!$statement->execute()) {
        $errorInfo = $statement->errorInfo();
        throw new Exception("Error creating book: " . $errorInfo[2]);
    }
}

/**
 * Fonction pour supprimer un livre de la base de données.
 * @param int $book_id L'identifiant du livre à supprimer.
 */
function deleteBook($book_id)
{
    $database = mysqlConnect();
    $statement = $database->prepare("DELETE FROM books WHERE id = :id;");
    $statement->bindValue(':id', $book_id, PDO::PARAM_STR);
    $statement->execute();
}

/**
 * Fonction pour éditer un livre dans la base de données.
 * @param int $book_id L'identifiant du livre à éditer.
 * @param string $name Le nouveau nom du livre.
 * @param string $author Le nouvel auteur du livre.
 * @param string $year La nouvelle année de publication du livre.
 * @param string $summary Le nouveau résumé du livre.
 */
function editBook($book_id, $name, $author, $year, $summary)
{

    $database = mysqlConnect();
    $statement = $database->prepare("UPDATE books SET name=:name, author=:author, year=:year, summary=:summary WHERE id=:id;");
    $statement->bindValue(':name', $name, PDO::PARAM_STR);
    $statement->bindValue(':author', $author, PDO::PARAM_STR);
    $statement->bindValue(':year', $year, PDO::PARAM_STR);
    $statement->bindValue(':summary', $summary, PDO::PARAM_STR);
    $statement->bindValue(':id', $book_id, PDO::PARAM_STR);
    $statement->execute();
}
/**
 * Fonction pour chercher un livre dans la base de données.
 * @param string $name Le nom du livre / auteur.
 */
function searchBook($name)
{
    $database = mysqlConnect();
    $statement = $database->prepare("SELECT * FROM books WHERE name LIKE :name OR author LIKE :name");
    $statement->bindValue(':name', '%' . $name . '%', PDO::PARAM_STR);
    $statement->execute();
    $books = [];
    while (($row = $statement->fetch())) {
        $book = [
            'id' => $row['id'],
            'name' => $row['name'],
            'author' => $row['author'],
            'summary' => $row['summary'],
            'year' => $row['year']
        ];

        $books[] = $book;
    }

    return $books;
}

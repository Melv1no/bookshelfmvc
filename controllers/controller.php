<?php

require("models/model.php");

/**
 * Afficher la vue demandée en incluant l'en-tête et le pied de page
 *
 * @param string $view La vue à afficher
 * @return void
 */
function displayViews($view)
{
    require_once("views/static/header.php");

    switch($view){

        case "books":
            $books = getBooks();
            include("views/$view.php");
            break;
        case "home":
            include("views/$view.php");
            break;
        case "bookshelf":
            $books = getBooks();
            include("views/$view.php");
            break;
        case "500":
            include("views/static/error/500.php");
        default: 
            include("views/static/error/404.php");
            break;
    }
    require_once("views/static/footer.php");
}   

/**
 * Effectuer une action en fonction de la requête GET et POST
 *
 * @return void
 */
function actions(){
    
    switch ($_GET['action']){
        case "create":
            $name = $_POST['name'];
            $author = $_POST['author'];
            $year = $_POST['year'];
            $summary = $_POST['summary'];

            createBook($name,$author,$year,$summary);
            header('Location: index.php?page=bookshelf&msg=created-success');
            break;
        case "edit":
            $book_id = $_POST['id'];
            $name = $_POST['name'];
            $author = $_POST['author'];
            $year = $_POST['year'];
            $summary = $_POST['summary'];
            
            editBook($book_id,$name,$author,$year,$summary);
            header('Location: index.php?page=bookshelf&msg=edited-success');
            break;
        case "delete":
            $book_id = $_POST['id'];
            deleteBook($book_id);
            header('Location: index.php?page=bookshelf&msg=deleted-success');
            break;
        case "search":
            $book_id = $_POST['book'];
            require_once("views/static/header.php");
            $books = searchBook($book_id);
            include("views/books.php");
            break;
            require_once("views/static/footer.php");
    } 
    
}
<?php

namespace App\Controller;

use App\Session;
use App\View;
use App\Models\Book;

class LibraryController
{
    public function index(){
        $books = new Book();

        //$message = $_SESSION['message'] ?? "";
        //unset($_SESSION['message']);

        return View::make('index',[
            'data' => $books->all(),
            'messages' => Session::getMessages()
            ]);
        /*
        return View::make('index',[
            'data' => (new Book())->all()
        ]);
        */
    }

    public function create(){
        return View::make('create');
    }

    public function store(){
        if (count($_POST) != 6){
            //todo error message
            return View::make('create');
        }

        $newBook = [
            'stock_number' => $_POST['stock_number'],
            'title' => $_POST['title'],
            'author' => $_POST['author'],
            'published_at' => $_POST['published_at'],
            'language' => $_POST['language'],
            'isbn' => $_POST['isbn']
        ];

        if((new Book())->insert($newBook)){
            //sikerült a létrehozás
            //$_SESSION['message'] = "Sikeres létrehozás!";
            Session::addMessage('Sikeres létrehozás', 'success');
            header('Location: /');
            exit();
        }else{
            //sikertelen létrehozás
            //todo error message
            return View::make('create');
        }
    }

    public function show(){
        if (!isset($_GET["id"])){   // Ha nincs id, akkor átirányítás a főoldalra
            header('Location: /');
            exit(); // die();
        }

        $id = $_GET['id'];
        $result = (new Book())->find($id);

        if (!$result){ // $result == false // Ha nincs adott id-val könyv, akkor átirányítás a főoldalra
            header('Location: /');
            exit(); // die();
        }
        return View::make('show',[
            'book' => $result
        ]);
    }

    public function delete(){
        if (!isset($_GET["id"])){   // Ha nincs id, akkor átirányítás a főoldalra
            header('Location: /');
            exit(); // die();
        }

        $id = $_GET['id'];

        if( (new Book())->delete($id) ){
            //todo success message
            header('Location: /');
            exit(); // die();
        }

        //todo error message
        header('Location: /details?id=' . $id);
        exit();
    }

    public function edit(){
        if (!isset($_GET["id"])){   // Ha nincs id, akkor átirányítás a főoldalra
            Session::addMessage('Nincs könyv kiválasztva szerkesztésre!', 'danger');
            header('Location: /');
            exit(); // die();
        }

        $id = $_GET["id"];
        $result = (new Book())->find($id);

        if (!$result){ // $result == false // Ha nincs adott id-val könyv, akkor átirányítás a főoldalra
            Session::addMessage('Nem található a megadott könyv!', 'danger');
            header('Location: /');
            exit(); // die();
        }

        //$result << ebben ni van egy könyv

        return View::make('edit',[
            'book' => $result
        ]);
    }

    public function update(){
        //var_dump($_POST);
        if (!isset($_POST['id'])){
            Session::addMessage('A kiválasztott könyv nem szerkezthető', 'danger');
            header('Location: /');
            exit();
        }

        if((new Book())->update($_POST['id'], $_POST)){
            Session::addMessage('A könyv módosításra került!', 'success');
            header('Location: /');
            exit();
        }

        Session::addMessage('Sikertelen módosítás!', 'danger');
        header('Location: /edit?id='.$_POST['id']);
        exit();
    }
}
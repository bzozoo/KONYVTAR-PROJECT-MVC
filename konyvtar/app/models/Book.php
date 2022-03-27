<?php

namespace App\Models;

use App\DB;

class Book
{
    private DB $db;
    private string $table = "books";

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function find(int $id) : false|array {
        $stmt = $this->db->prepare("SELECT * FROM " . $this->table . " WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ( $stmt->rowCount() == 1){
            return $stmt->fetch(); // A lekérdezés elemét vissz adja asszociatív tömb formájában
        }
        return false;
    }

    public function all(): bool|array {
        //$res = $this->db->query("SELECT * FROM " . $this->table);
        $res = $this->db->query("SELECT * FROM " . $this->table . " WHERE deleted_at IS NULL");
        return $res->fetchAll();
        //return $this->db->query("SELECT * FROM ".$this->table)->fetchAll();
    }

    public function insert(array $book): bool {
        /*
         $newBook = [
            'stock_number' => $_POST['stock_number'],
            'title' => $_POST['title'],
            'author' => $_POST['author'],
            'published_at' => $_POST['published_at'],
            'language' => $_POST['language'],
            'isbn' => $_POST['isbn']
        ];
         * */
        $stmt = $this->db->prepare("INSERT INTO " . $this->table .
            " (title, author, isbn, language, published_at, created_at, updated_at, stock_number) VALUE ".
            " (:title, :author, :isbn, :language, :published_at, :created_at, :updated_at, :stock_number) "
        );

        $stmt->bindValue(':title',$book['title']);
        $stmt->bindValue(':author',$book['author']);
        $stmt->bindValue(':isbn',$book['isbn']);
        $stmt->bindValue(':language',$book['language']);
        $stmt->bindValue(':published_at',$book['published_at']);
        $stmt->bindValue(':created_at', date("Y-m-d h:i:s"));
        $stmt->bindValue(':updated_at', date("Y-m-d h:i:s"));
        $stmt->bindValue(':stock_number',$book['stock_number']);

        return $stmt->execute();
    }

    public function delete(int $id): bool{
        //UPDATE books SET deleted_at = "" WHERE id = :id
        $datetime = date("Y-m-d h:i:s");
        //$stmt = $this->db->prepare("UPDATE " . $this->table . " SET deleted_at = :date WHERE id = :id");
        $stmt = $this->db->prepare("UPDATE " . $this->table . " SET deleted_at = \"$datetime\" WHERE id = :id");
        //$stmt->bindValue(':date', $datetime);
        $stmt->bindValue(':id', $id);

        return $stmt->execute();
    }
    public function forceDelete(int $id){
        // DELETE FROM books WHERE id = X
        $stmt = $this->db->prepare("DELETE FROM ".$this->table." WHERE id = :id");
        $stmt->bindValue(':id', $id);

        return $stmt->execute();
    }

    public function update(int $id, array $book) :bool {
        $stmt = $this->db->prepare(
            "UPDATE " . $this->table . " SET title = :title, author = :author, isbn = :isbn, " .
            " language = :language, published_at = :published_at, updated_at = :updated_at ".
            " WHERE id = :id "
        );
        $stmt->bindValue(':title', $book['title']);
        $stmt->bindValue(':author', $book['author']);
        $stmt->bindValue(':isbn', $book['isbn']);
        $stmt->bindValue(':language', $book['language']);
        $stmt->bindValue(':published_at', $book['published_at']);
        $stmt->bindValue(':updated_at', date('Y-m-d h:i:s'));
        $stmt->bindValue(':id', $id);

        return $stmt->execute();
    }
}
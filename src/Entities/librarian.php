<?php
require_once "User.php";

class Librarian extends User {

    public function addBook($conn, $book) {
        $stmt = $conn->prepare("INSERT INTO books (title, author, isbn, status) VALUES (?, ?, ?, ?)");
        $stmt->execute([$book->title, $book->author, $book->isbn, $book->status]);
    }

    public function removeBook($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM books WHERE id=?");
        $stmt->execute([$id]);
    }

    public function updateBookStatus($conn, $id, $status) {
        $stmt = $conn->prepare("UPDATE books SET status=? WHERE id=?");
        $stmt->execute([$status, $id]);
    }

    public function registerMember($conn, $member) {
        $stmt = $conn->prepare("INSERT INTO users (name, email, role) VALUES (?, ?, 'member')");
        $stmt->execute([$member->name, $member->email]);
    }

    public function viewAllBooks($conn) {
        $stmt = $conn->query("SELECT * FROM books");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
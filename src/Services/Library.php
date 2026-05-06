<?php
class Library {

    public function findBookByTitle($conn, $title) {
        $stmt = $conn->prepare("SELECT * FROM books WHERE title LIKE ?");
        $stmt->execute(["%$title%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findBookByAuthor($conn, $author) {
        $stmt = $conn->prepare("SELECT * FROM books WHERE author LIKE ?");
        $stmt->execute(["%$author%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllUsers($conn) {
        $stmt = $conn->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
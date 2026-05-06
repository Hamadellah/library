<?php
require_once "User.php";

class Member extends User {

    public function borrowBook($conn, $book_id) {
        // vérifier disponibilité
        $stmt = $conn->prepare("SELECT status FROM books WHERE id=?");
        $stmt->execute([$book_id]);
        $book = $stmt->fetch();

        if ($book && $book['status'] == "Disponible") {

            // ajouter borrow
            $stmt = $conn->prepare("INSERT INTO borrows (member_id, book_id, borrow_date) VALUES (?, ?, NOW())");
            $stmt->execute([$this->id, $book_id]);

            // update status
            $stmt = $conn->prepare("UPDATE books SET status='Emprunté' WHERE id=?");
            $stmt->execute([$book_id]);

            return true;
        }
        return false;
    }

    public function returnBook($conn, $book_id) {
        // update borrow
        $stmt = $conn->prepare("UPDATE borrows SET return_date=NOW() WHERE book_id=? AND member_id=? AND return_date IS NULL");
        $stmt->execute([$book_id, $this->id]);

        // update status
        $stmt = $conn->prepare("UPDATE books SET status='Disponible' WHERE id=?");
        $stmt->execute([$book_id]);

        return true;
    }

    public function viewBorrowedBooks($conn) {
        $stmt = $conn->prepare("
            SELECT b.title, br.borrow_date 
            FROM borrows br
            JOIN books b ON br.book_id = b.id
            WHERE br.member_id=? AND br.return_date IS NULL
        ");
        $stmt->execute([$this->id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
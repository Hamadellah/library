CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    role VARCHAR(20)
);

CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    author VARCHAR(255),
    isbn VARCHAR(50),
    status VARCHAR(50)
);

CREATE TABLE borrows (
    id INT AUTO_INCREMENT PRIMARY KEY,
    member_id INT,
    book_id INT,
    borrow_date DATETIME,
    return_date DATETIME NULL,
    FOREIGN KEY (member_id) REFERENCES users(id),
    FOREIGN KEY (book_id) REFERENCES books(id)
);
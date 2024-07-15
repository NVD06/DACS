CREATE TABLE tblticket (
    id INT AUTO_INCREMENT PRIMARY KEY,
    movie VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    time TIME NOT NULL,
    seat VARCHAR(255) NOT NULL,
    food VARCHAR(255),
    total_price DECIMAL(10, 2) NOT NULL,
);
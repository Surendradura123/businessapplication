DROP SCHEMA IF EXISTS Hybrid;
CREATE SCHEMA Hybrid;
USE Hybrid;

CREATE TABLE User_Type(
user_type_id INT NOT NULL AUTO_INCREMENT,	
name ENUM('Customer', 'Company', 'Admin') NOT NULL,
PRIMARY KEY (user_type_id)
);

CREATE TABLE Customer(
customer_id INT NOT NULL AUTO_INCREMENT,
first_name VARCHAR(100) NOT NULL,
last_name VARCHAR(100) NOT NULL,
email VARCHAR(100),
phone_home VARCHAR(20), /* Not used for calculation, no need to be LONG*/
phone_mobile VARCHAR(20), /* Not used for calculation, not needed to be LONG*/
user_type_id INT DEFAULT '1',
password VARCHAR(256),
password_hashed BLOB, /*MAKE SURE IT'S TYPE 'BLOB'*/
login DATETIME NOT NULL,
PRIMARY KEY (customer_id),
FOREIGN KEY (user_type_id) REFERENCES User_Type(user_type_id)
);

INSERT INTO Customer(customer_id, first_name, last_name, email, phone_home, phone_mobile, user_type_id, password, password_hashed, login)
VALUES 						('1', 'John', 'Smith', 'email@address.com', '014789632', '0874123698', '1', '123456', NULL, '2018-05-27 16:38:00');

/*----------------------*/

UPDATE Customer SET password_hashed = AES_ENCRYPT(password, 'key') WHERE customer_id="1"; /* 'KEY' is like a code to use when encrypting and decrypting. Any value would work, but they need to be same for encryption and decyption */

SELECT * FROM Customer;

UPDATE Customer SET password = NULL WHERE customer_id="1";

SELECT * FROM Customer;

UPDATE Customer SET password = AES_DECRYPT(password_hashed, 'key') WHERE customer_id="1";

SELECT * FROM Customer;

/*Look at: 
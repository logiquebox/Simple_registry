# Simple user authentication in php
A simple user registration and login using php for beginners. This will help php beginners get started with the language

## Database
Open the db.php file and change the database configurations as per yours

## Table
```sql
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
```

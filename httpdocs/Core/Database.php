<?php
    class Database
    {
        public static function getConnection(){
            return new PDO("mysql:host=".DB_SERVERNAME.";dbname=".DB_NAME,
            DB_USERNAME, DB_PASSWORD);
        }
    }

<?php
function checkValueGreaterZero($value): bool
{
    if (strlen($value) > 0) {
        return true;
    } else {

        return false;
    }
}
function getDbConnection(): PDO
{
    return new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS);
}
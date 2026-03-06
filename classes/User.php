<?php 
class User{
    public int $id;
    public string $email;
    public string $hashed_password;
    public bool $is_admin;
}
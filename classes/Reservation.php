<?php 
class Reservation{
    public int $id;
    public ?User $user = null;
    public ?Product $product = null;
    public ?int $user_id = null;
    public ?int $product_id = null;
}
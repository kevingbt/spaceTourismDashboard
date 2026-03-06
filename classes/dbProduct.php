<?php 

class DbProduct extends AbstractRepository
{
    /**
 * @param PDO $db
 * @return Product[]
 */

public function fetchAllProduct(): array
{
    $stmt = $this->db->prepare('SELECT * FROM product');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_CLASS, Product::class);
}

public function fetchNextProduct(): array
{
    $stmt = $this->db->prepare('SELECT * FROM product ORDER BY departure_date LIMIT 3');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_CLASS, Product::class);
}

public function fetchProductId(int $id): Product
{
    $stmt = $this->db->prepare('SELECT * FROM product WHERE id = :id');
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetchObject(Product::class);
}

public function pushProduct( string $name, string $illustration, string $departure_date, int $max_passengers, int $price)
{
    $stmt = $this->db->prepare('INSERT INTO product (name, illustration, departure_date, max_passengers, price) VALUES (:name, :illustration, :departure_date, :max_passengers, :price)');
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':illustration', $illustration);
    $stmt->bindValue(':departure_date', $departure_date);
    $stmt->bindValue(':max_passengers', $max_passengers);
    $stmt->bindValue(':price', $price);
    $stmt->execute();
}

public function updateProduct(int $id, string $name, string $illustration, string $departure_date, int $max_passengers, int $price)
{
    $stmt = $this->db->prepare('UPDATE product SET name = :name, illustration = :illustration, departure_date = :departure_date, max_passengers = :max_passengers, price = :price WHERE id = :id');
    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':illustration', $illustration);
    $stmt->bindValue(':departure_date', $departure_date);
    $stmt->bindValue(':max_passengers', $max_passengers);
    $stmt->bindValue(':price', $price);
    $stmt->execute();
}

public function deleteProduct(int $id){
    $stmt = $this->db->prepare('DELETE FROM product WHERE id = :id');
    $stmt->bindValue(':id', $id);
    $stmt->execute();
}
}
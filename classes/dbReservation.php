<?php

class DbReservation extends AbstractRepository
{

public function fetchAllReservation(): array
{
    $stmt = $this->db->prepare('SELECT * FROM reservation');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_CLASS, Reservation::class);
}

public function fetchReservationId(int $id): Reservation
{
    $stmt = $this->db->prepare('SELECT * FROM reservation WHERE id = :id');
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetchObject(Reservation::class);
}

/**
 * @param PDO $db
 * @return User[]
 */

public function fetchParticipants(int $id): array
{
    $stmt = $this->db->prepare('SELECT user.id, user.email, user.hashed_password, user.is_admin FROM reservation INNER JOIN user ON reservation.user_id = user.id WHERE product_id = :id');
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_CLASS, User::class);
}

/**
 * @param PDO $db
 * @return Reservation[]
 */

public function fetchVoyage(int $id): array
{
    $stmt = $this->db->prepare('SELECT reservation.id AS r_id, product.id AS p_id, product.name AS p_name, product.illustration AS p_illustration, product.departure_date AS p_departure_date, product.max_passengers AS p_max_passengers, product.price AS p_price, user.id AS u_id, user.email AS u_email, user.hashed_password AS u_hashed_password, user.is_admin AS u_is_admin FROM reservation INNER JOIN product ON reservation.product_id = product.id INNER JOIN user ON reservation.user_id = user.id WHERE user_id = :id');
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $return = [];
    foreach($data as $voyage) {
        $reservation = new Reservation();
        $product = new Product();
        $user = new User();
        $reservation->id = $voyage['r_id'];
        $product->id = $voyage['p_id'];
        $product->name = $voyage['p_name'];
        $product->illustration = $voyage['p_illustration'];
        $product->departure_date = $voyage['p_departure_date'];
        $product->max_passengers = $voyage['p_max_passengers'];
        $product->price = $voyage['p_price'];
        $user->id = $voyage['u_id'];
        $user->email = $voyage['u_email'];
        $user->hashed_password = $voyage['u_hashed_password'];
        $user->is_admin = $voyage['u_is_admin'];
        $reservation->product = $product;
        $reservation->user = $user;
        $return[] = $reservation;
    };
    return $return;
}

public function fetchCountReservation(): int
{
    $stmt = $this->db->prepare('SELECT COUNT(reservation.id) AS count FROM reservation');
    $stmt->execute();
    return $count = $stmt->fetchColumn();
}

public function fetchCountReservationbyId(int $id): int
{
    $stmt = $this->db->prepare('SELECT COUNT(reservation.id) AS count FROM reservation WHERE product_id = :id');
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $count = $stmt->fetchColumn();
}

public function pushReservation(int $user_id, int $product_id)
{
    $stmt = $this->db->prepare('INSERT INTO reservation (user_id, product_id) VALUES (:user_id, :product_id)');
    $stmt->bindValue(':user_id', $user_id);
    $stmt->bindValue(':product_id', $product_id);
    $stmt->execute();
}

public function updateReservation(int $id, int $user_id, int $product_id)
{
    $stmt = $this->db->prepare('UPDATE reservation SET user_id = :user_id, product_id = :product_id WHERE id = :id');
    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':user_id', $user_id);
    $stmt->bindValue(':product_id', $product_id);
    $stmt->execute();
}

public function deleteReservation(int $id)
{
    $stmt = $this->db->prepare('DELETE FROM reservation WHERE id = :id');
    $stmt->bindValue(':id', $id);
    $stmt->execute();
}

}
<?php 

class DbUser extends AbstractRepository
{
/**
 * @param PDO $db
 * @return User[]
 */

public function fetchAllUser(): array
{
    $stmt = $this->db->prepare('SELECT * FROM user');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_CLASS, User::class);
}

public function fetchUserId(int $id): User
{
    $stmt = $this->db->prepare('SELECT * FROM user WHERE id = :id');
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetchObject(User::class);
}

public function fetchCountUser(): int
{
    $stmt = $this->db->prepare('SELECT COUNT(user.id) AS count FROM user');
    $stmt->execute();
    return $count = $stmt->fetchColumn();
}

public function pushUser( string $email, string $hashed_password, bool $is_admin)
{
    $stmt = $this->db->prepare('INSERT INTO user (email, hashed_password, is_admin) VALUES (:email, :hashed_password, :is_admin)');
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':hashed_password', $hashed_password);
    $stmt->bindValue(':is_admin', $is_admin, PDO::PARAM_BOOL);
    $stmt->execute();
}

public function updateUser(int $id, string $email, string $hashed_password, bool $is_admin)
{
    $stmt = $this->db->prepare('UPDATE user SET email = :email, hashed_password = :hashed_password, is_admin = :is_admin WHERE id = :id');
    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':hashed_password', $hashed_password);
    $stmt->bindValue(':is_admin', $is_admin, PDO::PARAM_BOOL);
    $stmt->execute();
}

public function deleteUser( int $id){
    $stmt = $this->db->prepare('DELETE FROM user WHERE id = :id');
    $stmt->bindValue(':id', $id);
    $stmt->execute();
}

}
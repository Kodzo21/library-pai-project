<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/User.php';


class UserRepository extends Repository
{
    public function getUser(string $email): ?User
    {
        $statement = $this->database->connect()->prepare(
            'SELECT u.id,u.email,u.password,ud.name,ud.surname,ud.phone,r.role_name FROM users u 
            LEFT JOIN users_details ud ON u.user_details_id = ud.id 
            left join roles r on r.id=u.role_id
            WHERE email = :email
            '
        );
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return null;
            //throw exception zamiast return null
        }

        return new User($user['id'], $user['role_name'], $user['email'], $user['password'], $user['name'], $user['surname']);
    }

    public function addUser(User $user)
    {
        $statement = $this->database->connect()->prepare('
            Insert into users_details (name,surname,phone)
            values (?,?,?);
        ');
        $statement->execute([
            $user->getName(),
            $user->getSurname(),
            $user->getPhone()
        ]);
        $statement = $this->database->connect()->prepare('
            Insert into users (role_id,email,password,user_details_id)
            values (?,?,?,?);
        ');
        $statement->execute([
             2,
            $user->getEmail(),
            $user->getPassword(),
            $this->getUserDetailsId($user)
        ]);
    }

    public function getUserDetailsId(User $user): int
    {
        $statement = $this->database->connect()->prepare('
            SELECT * FROM public.users_details WHERE name = :name AND surname = :surname AND phone = :phone
        ');

        $name = $user->getName();
        $surname = $user->getSurname();
        $phone = $user->getPhone();

        $statement->bindParam(':name', $name, PDO::PARAM_STR);
        $statement->bindParam(':surname', $surname, PDO::PARAM_STR);
        $statement->bindParam(':phone', $phone, PDO::PARAM_STR);
        $statement->execute();

        $data = $statement->fetch(PDO::FETCH_ASSOC);

        return $data['id'];
    }

    public function getUserBooks($userID){
        $statement = $this->database->connect()->prepare('
            Select b.id, b.title, ub.start_time, ub.end_time from books b 
                left join book_borrows ub on b.id = ub.book_id 
                    where ub.user_id=:id and ub.return_time is null;
        ');
        $statement->bindParam(':id',$userID,PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

}
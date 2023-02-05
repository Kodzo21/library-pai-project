<?php

class SessionRepository extends Repository
{
    public function getSession(string $id): ?Session
    {
        $statement = $this->database->connect()->prepare('
            select * from sessions s where s.id=:id;
        ');
        $statement->bindParam("id",$id,PDO::PARAM_STR);
        $statement->execute();
        $session = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$session){
            return null;
        }
        return new Session($session['id'],$session['user_id']);
    }

    public function addSession(Session $session){
        $statement = $this->database->connect()->prepare(
            'Insert into sessions (id,user_id) values (?,?)'
        );
        $statement->execute([
            $session->getId(),
            $session->getUserId()
        ]);
    }

    public function removeSession(string $id){
        $statement= $this->database->connect()->prepare(
            'Delete from sessions where id=:id'
        );
        $statement->bindParam("id",$id);

        return $statement->execute();

    }
}
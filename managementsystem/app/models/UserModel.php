<?php
class UserModel
{
    private Database $db;

    public function __construct($db = new Database)
    {
        $this->db = $db;
    }

    public function getLoginDetails()
    {
        //selects the date from LoginDetail table
        $this->db->query("SELECT * FROM LoginDetails");

        //returing that resultset
        return $this->db->resultSet();
    }

    public function addUser($post)
    {
        //Inserting the user details into the UserDetails table
        $result = $this->db->query("INSERT INTO UserDetails (Firstname, Infix, Lastname, Age)
                                        VALUES    (:Firstname, :Infix, :Lastname, :Age)");

        //binding the past values to the parameters
        $this->db->bind(':Firstname', $post['firstname']);
        $this->db->bind(':Infix', $post['infix']);
        $this->db->bind(':Lastname', $post['lastname']);
        $this->db->bind(':Age', $post['age'], PDO::PARAM_INT);

        //execute query
        $this->db->execute();

        //getting the last id created from the UserDetails so that we can insert it into LoginDetails.
        $lastUserDetailsId = $this->db->dbHandler->lastInsertId();

        $this->db->query("INSERT INTO LoginDetails (Email, UserPass, UserDetailsId, RollId, IsActive)
                                VALUES     (:Email, :UserPass, :UserDetailsId, '2', 1)");

        //binding the past values to the parameters
        $this->db->bind(':Email', $post['email']);
        $this->db->bind(':UserPass', $post['pass']);
        $this->db->bind(':UserDetailsId', $lastUserDetailsId, PDO::PARAM_INT);

        //execute query
        return $this->db->execute();
    }

    public function activateUser($Id)
    {
        $this->db->query("UPDATE LoginDetails SET IsActive = 1
                            WHERE Id = :Id");
        $this->db->bind(':Id', $Id);

        return $this->db->execute();
    }

    public function checkEmail($email)
    {
        $this->db->query("SELECT * FROM LoginDetails
                            WHERE Email = :Email");
        $this->db->bind(':Email', $email);

        return $this->db->single();
    }

    public function getLoginById($Id)
    {
        $this->db->query("SELECT * FROM LoginDetails
                            WHERE Id = :Id");
        $this->db->bind(':Id', $Id);

        return $this->db->single();
    }

    public function getAllUserDetailsById($Id)
    {

        $this->db->query("SELECT         LoginDetails.*
                                        ,UserDetails.*
                                        ,Roll.*
                          FROM           LoginDetails
                          INNER JOIN     UserDetails
                          ON             UserDetails.Id = LoginDetails.UserDetailsId
                          INNER JOIN     Roll
                          ON             Roll.Id = LoginDetails.RollId
                          WHERE          LoginDetails.Id = :LoginId");

        $this->db->bind(':LoginId', $Id);

        return $this->db->single();
    }

    public function getAllUserDetails()
    {

        $this->db->query("SELECT         LoginDetails.*
                                        ,UserDetails.*
                                        ,Roll.*
                                        ,LoginDetails.Id as loginId
                                        ,UserDetails.Id as userId
                                        ,Roll.Id as rollId
                          FROM           LoginDetails
                          INNER JOIN     UserDetails
                          ON             UserDetails.Id = LoginDetails.UserDetailsId
                          INNER JOIN     Roll
                          ON             Roll.Id = LoginDetails.RollId");

        return $this->db->resultSet();
    }

    public function updateUser($post)
    {
        $this->db->query("UPDATE UserDetails SET    Firstname = :Firstname
                                                    ,Infix = :Infix
                                                    ,Lastname = :Lastname
                                                    ,Age = :Age
                                            WHERE   Id = :userId");
        $this->db->bind(':userId', $post['userId'], PDO::PARAM_INT);
        $this->db->bind(':Firstname', $post['Firstname']);
        $this->db->bind(':Infix', $post['Infix']);
        $this->db->bind(':Lastname', $post['Lastname']);
        $this->db->bind(':Age', $post['Age'], PDO::PARAM_INT);

        $this->db->execute();

        $this->db->query("UPDATE LoginDetails SET   Email = :Email
                                                   ,UserPass = :UserPass
                                                   ,RollId = :RollId
                                                   ,IsActive = :IsActive
                                            WHERE  Id = :loginId");
        $this->db->bind(':loginId', $post['loginId'], PDO::PARAM_INT);
        $this->db->bind(':Email', $post['Email']);
        $this->db->bind(':UserPass', $post['Password']);
        $this->db->bind(':RollId', $post['RollId'], PDO::PARAM_INT);
        $this->db->bind(':IsActive', $post['IsActive'], PDO::PARAM_BOOL);

        return $this->db->execute();
    }
}

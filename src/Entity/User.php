<?php

namespace Entity;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Description of User
 *
 * @author Etudiant
 */
class User implements UserInterface
{

    /**
     * Primary key for User
     * @var integer 
     */
    private $id;

    /**
     * Username of the user
     * @var string 
     */
    private $username;

    /**
     * Password of the user
     * @var string 
     */
    private $password;

    /**
     * Email of the user
     * @var string 
     */
    private $email;

    /**
     * First name of the user
     * @var string 
     */
    private $firstname;

    /**
     * Lastname of the user
     * @var string 
     */
    private $lastname;

    /**
     * list of the user's roles
     * @var array
     */
    private $role;

    /**
     * the salt used to encode the user's password
     * @var type 
     */
    private $salt;

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function eraseCredentials()
    {
        $this->setPassword(NULL); // pour rendre invisible le password.)
    }

    public function getRole()
    {//pour renvoyer une cc par utilisateur
        return $this->role;
    }
    
    public function getRoles()
    {//pour renvoyer un tableau de roles par utilisateur
        return explode('|', $this->role);
    }


    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;
    }
    
}

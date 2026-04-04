<?php

class User
{
    public static $nbInstance = 0;

    /**
     * Summary of __construct
     * 
     * Construct a person
     * 
     * @param int $id
     * @param string $email
     * @param string $password
     * @param string $role
     */
    public function __construct(
        protected int $id = 0,
        protected string $email = '',
        protected string $password = '',
        protected string $role = '',
    ) {
        self::$nbInstance++;
    }


    public function whoAmI()
    {
        echo $this->name;
    }

    /**
     * Summary of getName
     * return the person name
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
    public function getRole(): string
    {
        return $this->role;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string           
    {
        return $this->password;
    }

    public function __destruct()
    {
        self::$nbInstance--;
    }
}
<?php

class StudentRepository extends Repository
{   
    const tableName = 'students'; 
    public function __construct()
    {
        return parent::__construct(self::tableName);
    }

}
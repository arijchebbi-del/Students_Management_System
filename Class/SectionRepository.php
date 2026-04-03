<?php

class SectionRepository extends Repository
{   
    const tableName = 'sections'; 
    public function __construct()
    {
        return parent::__construct(self::tableName);
    }

}
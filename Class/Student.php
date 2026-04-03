<?php

class Student
{
    public static $nbInstance = 0;

    /**
     * Construct a student
     * 
     * @param int $id
     * @param string $image
     * @param string $name
     * @param string $birthday
     * @param int $section_id
     */
    public function __construct(
        protected int $id = 0,
        protected string $image = '',
        protected string $name = '',
        protected string $birthday = '',
        protected int $section_id = 0,
    ) {
        self::$nbInstance++;
    }

    /**
     * Display student info
     */
    public function whoAmI()
    {
        echo "Student: {$this->name}, Section ID: {$this->section_id}";
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBirthday(): string
    {
        return $this->birthday;
    }

    public function getSectionId(): int
    {
        return $this->section_id;
    }

    public function __destruct()
    {
        self::$nbInstance--;
    }
}
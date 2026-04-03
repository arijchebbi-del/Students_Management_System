<?php

class Section
{
    public static $nbInstance = 0;

    /**
     * Construct a section
     * 
     * @param int $id
     * @param string $designation
     * @param string $description
     */
    public function __construct(
        protected int $id = 0,
        protected string $designation = '',
        protected string $description = '',
    ) {
        self::$nbInstance++;
    }

    /**
     * Display section info
     */
    public function whoAmI()
    {
        echo "Section: {$this->designation}, Description: {$this->description}";
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getDesignation(): string
    {
        return $this->designation;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function __destruct()
    {
        self::$nbInstance--;
    }
}
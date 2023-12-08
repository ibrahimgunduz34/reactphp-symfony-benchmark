<?php

namespace App\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Index;
use JetBrains\PhpStorm\ArrayShape;

#[Entity]
#[Index(columns: ["code1"])]
class Product implements \JsonSerializable
{
    #[Id]
    #[Column]
    #[GeneratedValue(strategy: "IDENTITY")]
    private int $id;

    #[Column(length: 10)]
    private string $code;

    #[Column(length: 10)]
    private string $code1;

    #[Column(length: 50)]
    private string $name;

    #[Column(length: 255, nullable: true)]
    private string $description;

    #[Column]
    private int $size;

    #[Column(length: 30)]
    private string $color;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param int $size
     */
    public function setSize(int $size): void
    {
        $this->size = $size;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    /**
     * @return string
     */
    public function getCode1(): string
    {
        return $this->code1;
    }

    /**
     * @param string $code1
     */
    public function setCode1(string $code1): void
    {
        $this->code1 = $code1;
    }

    #[ArrayShape(['code' => "string", 'code1' => "string", 'name' => "string", 'description' => "string", 'color' => "string", 'size' => "int"])]
    public function jsonSerialize(): array
    {
        return [
            'code' => $this->code,
            'code1' => $this->code1,
            'name' => $this->name,
            'description' => $this->description,
            'color' => $this->color,
            'size' => $this->size
        ];
    }
}
<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use DateTime;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     itemOperations={
 *          "get"={"method"="GET", "path"="/sunday/{id}.{_format}"}
 *     },
 *     collectionOperations={
 *       "get"={"method"="GET", "path"="/sundays.{_format}"}
 *     },
 *     attributes={
 *       "normalization_context"={
 *         "groups"={"get"},
 *         "datetime_format" = "Y-m-d"
 *       }
 *     }
 * )
 *
 * Class Sunday
 * @package App\Entity
 */
class Sunday
{
    /**
     * @ApiProperty(identifier=true)
     * @var int
     */
    private $id;


    /**
     * @ApiProperty()
     * @Groups({"get"})
     * @var DateTime
     */
    private $date;

    /**
     * @ApiProperty(identifier=true)
     * @Groups({"get"})
     * @var bool
     */
    private $traded = false;

    public static function fromString(string $date): self
    {
        return new self(new DateTime($date));
    }

    public function __construct(DateTime $date)
    {
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return bool
     */
    public function isTraded(): bool
    {
        return $this->traded;
    }

    /**
     * @param bool $traded
     */
    public function setTraded(bool $traded)
    {
        $this->traded = $traded;
    }
}
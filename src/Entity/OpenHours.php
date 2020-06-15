<?php

namespace App\Entity;

use App\Repository\OpenHoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OpenHoursRepository::class)
 */
class OpenHours
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $day;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $open;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $close;


    public function __construct()
    {
        $this->kontakts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getOpen(): ?string
    {
        return $this->open;
    }

    public function setOpen(string $open): self
    {
        $this->open = $open;

        return $this;
    }

    public function getClose(): ?string
    {
        return $this->close;
    }

    public function setClose(string $close): self
    {
        $this->close = $close;

        return $this;
    }

}

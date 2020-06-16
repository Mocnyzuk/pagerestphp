<?php

namespace App\Entity;

use App\Repository\UslugaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UslugaRepository::class)
 */
class Usluga
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
    private $category;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $priceOnce;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $priceSeries;

    /**
     * @ORM\OneToOne(targetEntity=Zabieg::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $zabieg;

    /**
     * Usluga constructor.
     * @param $category
     * @param $name
     * @param $priceOnce
     * @param $priceSeries
     * @param $zabieg
     * @param int|null $id
     */
    public function __construct($category, $name, $priceOnce, $priceSeries,Zabieg $zabieg = null, $id = null)
    {
        $this->category = $category;
        $this->name = $name;
        $this->priceOnce = $priceOnce;
        $this->priceSeries = $priceSeries;
        $this->zabieg = $zabieg;
        $this->id = $id;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPriceOnce(): ?float
    {
        return $this->priceOnce;
    }

    public function setPriceOnce(?float $priceOnce): self
    {
        $this->priceOnce = $priceOnce;

        return $this;
    }

    public function getPriceSeries(): ?float
    {
        return $this->priceSeries;
    }

    public function setPriceSeries(?float $priceSeries): self
    {
        $this->priceSeries = $priceSeries;

        return $this;
    }

    public function getZabieg(): ?Zabieg
    {
        return $this->zabieg;
    }

    public function setZabieg(Zabieg $zabieg): self
    {
        $this->zabieg = $zabieg;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

}

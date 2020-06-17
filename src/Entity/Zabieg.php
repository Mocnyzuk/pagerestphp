<?php

namespace App\Entity;

use App\Repository\ZabiegRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ZabiegRepository::class)
 */
class Zabieg
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $urlPath;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $priceOnce;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $priceSeries;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duration;

    /**
     * @ORM\OneToOne(targetEntity=Image::class, cascade={"persist", "remove"})
     */
    private $image;

    /**
     * Zabieg constructor.
     * @param $id
     * @param $category
     * @param $urlPath
     * @param $name
     * @param $description
     * @param $priceOnce
     * @param $priceSeries
     * @param $duration
     * @param $image
     */
    public function __construct($id = null, $category = null, $urlPath= null, $name= null, $description= null, $priceOnce= null, $priceSeries= null, $duration= null, $image= null)
    {
        $this->id = $id;
        $this->category = $category;
        $this->urlPath = $urlPath;
        $this->name = $name;
        $this->description = $description;
        $this->priceOnce = $priceOnce;
        $this->priceSeries = $priceSeries;
        $this->duration = $duration;
        $this->image = $image;
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

    public function getUrlPath(): ?string
    {
        return $this->urlPath;
    }

    public function setUrlPath(string $urlPath): self
    {
        $this->urlPath = $urlPath;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPriceOnce(): ?float
    {
        return $this->priceOnce;
    }

    public function setPriceOnce(float $priceOnce): self
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

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): self
    {
        $this->image = $image;

        return $this;
    }
}

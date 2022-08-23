<?php

namespace App\Entity;

use App\Repository\WeatherRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WeatherRepository::class)
 */
class Weather
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $temp;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $tempMax;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $tempMin;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $wind;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $clouds;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createTime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getTemp(): ?string
    {
        return $this->temp;
    }

    public function setTemp(string $temp): self
    {
        $this->temp = $temp;

        return $this;
    }

    public function getTempMax(): ?string
    {
        return $this->tempMax;
    }

    public function setTempMax(string $tempMax): self
    {
        $this->tempMax = $tempMax;

        return $this;
    }

    public function getTempMin(): ?string
    {
        return $this->tempMin;
    }

    public function setTempMin(string $tempMin): self
    {
        $this->tempMin = $tempMin;

        return $this;
    }

    public function getWind(): ?string
    {
        return $this->wind;
    }

    public function setWind(string $wind): self
    {
        $this->wind = $wind;

        return $this;
    }

    public function getClouds(): ?string
    {
        return $this->clouds;
    }

    public function setClouds(string $clouds): self
    {
        $this->clouds = $clouds;

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

    public function getCreateTime(): ?\DateTimeInterface
    {
        return $this->createTime;
    }

    public function setCreateTime(\DateTimeInterface $createTime): self
    {
        $this->createTime = $createTime;

        return $this;
    }
}

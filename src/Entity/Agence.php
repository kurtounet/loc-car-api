<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AgenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgenceRepository::class)]
#[ApiResource()]
class Agence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $adress = null;

    #[ORM\Column]
    private ?int $numAdress = null;

    #[ORM\Column(length: 5)]
    private ?string $zipcode = null;

    #[ORM\Column(length: 5)]
    private ?string $country = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $phoneNumber = null;

    /**
     * @var Collection<int, Vehicl>
     */
    #[ORM\ManyToMany(targetEntity: Vehicl::class, mappedBy: 'Agency')]
    private Collection $vehicls;

    public function __construct()
    {
        $this->vehicls = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): static
    {
        $this->adress = $adress;

        return $this;
    }

    public function getNumAdress(): ?int
    {
        return $this->numAdress;
    }

    public function setNumAdress(int $numAdress): static
    {
        $this->numAdress = $numAdress;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): static
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * @return Collection<int, Vehicl>
     */
    public function getVehicls(): Collection
    {
        return $this->vehicls;
    }

    public function addVehicl(Vehicl $vehicl): static
    {
        if (!$this->vehicls->contains($vehicl)) {
            $this->vehicls->add($vehicl);
            $vehicl->addAgency($this);
        }

        return $this;
    }

    public function removeVehicl(Vehicl $vehicl): static
    {
        if ($this->vehicls->removeElement($vehicl)) {
            $vehicl->removeAgency($this);
        }

        return $this;
    }
}

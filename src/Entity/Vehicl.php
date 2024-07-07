<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\VehiclRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource()]
#[ORM\Entity(repositoryClass: VehiclRepository::class)]
class Vehicl
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $brand = null;

    #[ORM\Column(length: 255)]
    private ?string $model = null;

    #[ORM\Column(length: 4)]
    private ?string $year = null;

    #[ORM\Column(length: 15)]
    private ?string $licenseplate = null;

    #[ORM\Column(type: 'integer')]
    private ?int $mileage = null;

    #[ORM\Column(length: 255)]
    private ?string $fuelType = null;

    #[ORM\Column(length: 50)]
    private ?string $status = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $pricePerDay = null;

    /**
     * @var Collection<int, Rental>
     */
    #[ORM\OneToMany(targetEntity: Rental::class, mappedBy: 'vehicle')]
    private Collection $rentals;

    /**
     * @var Collection<int, Agence>
     */
    #[ORM\ManyToMany(targetEntity: Agence::class, inversedBy: 'vehicls')]
    private Collection $Agency;

    public function __construct()
    {
        $this->rentals = new ArrayCollection();
        $this->Agency = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(string $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getLicenseplate(): ?string
    {
        return $this->licenseplate;
    }

    public function setLicenseplate(string $licenseplate): static
    {
        $this->licenseplate = $licenseplate;

        return $this;
    }

    public function getMileage(): ?int
    {
        return $this->mileage;
    }

    public function setMileage(int $mileage): static
    {
        $this->mileage = $mileage;

        return $this;
    }

    public function getFuelType(): ?string
    {
        return $this->fuelType;
    }

    public function setFuelType(string $fuelType): static
    {
        $this->fuelType = $fuelType;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getPricePerDay(): ?string
    {
        return $this->pricePerDay;
    }

    public function setPricePerDay(string $pricePerDay): static
    {
        $this->pricePerDay = $pricePerDay;

        return $this;
    }

    /**
     * @return Collection<int, Rental>
     */
    public function getRentals(): Collection
    {
        return $this->rentals;
    }

    public function addRental(Rental $rental): static
    {
        if (!$this->rentals->contains($rental)) {
            $this->rentals->add($rental);
            $rental->setVehicle($this);
        }

        return $this;
    }

    public function removeRental(Rental $rental): static
    {
        if ($this->rentals->removeElement($rental)) {
            // set the owning side to null (unless already changed)
            if ($rental->getVehicle() === $this) {
                $rental->setVehicle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Agence>
     */
    public function getAgency(): Collection
    {
        return $this->Agency;
    }

    public function addAgency(Agence $agency): static
    {
        if (!$this->Agency->contains($agency)) {
            $this->Agency->add($agency);
        }

        return $this;
    }

    public function removeAgency(Agence $agency): static
    {
        $this->Agency->removeElement($agency);

        return $this;
    }
}

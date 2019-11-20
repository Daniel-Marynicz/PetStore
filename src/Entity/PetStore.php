<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\PetStoreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PetStoreRepository::class)
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(columns={"name", "surname"})})
 *
 * @UniqueEntity(
 *     fields={"name", "surname"},
 *     message="Pet store with same name and surname already exists."
 * )
 */
class PetStore
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string|null
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string|null
     */
    private $surname;

    /**
     * @ORM\OneToMany(targetEntity=Pet::class, mappedBy="petStore", orphanRemoval=true, cascade={"persist"})
     *
     * @Assert\Valid()
     * @var Collection&Selectable&iterable<Pet>
     * Many PetStore have Many pets
     */
    private $pets;

    public function __construct()
    {
        $this->pets = new ArrayCollection();
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function setId(int $id) : PetStore
    {
        $this->id = $id;

        return $this;
    }

    public function getName() : ?string
    {
        return $this->name;
    }

    public function setName(?string $name) : PetStore
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname() : ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname) : PetStore
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * @return Collection&Selectable&iterable<Pet>
     */
    public function getPets() : Selectable
    {
        return $this->pets;
    }

    /**
     * @param Collection &Selectable&iterable<Pet> $pets
     */
    public function setPets(Selectable $pets) : PetStore
    {
        $this->pets = $pets;

        return $this;
    }

    public function addPet(Pet $pet) : PetStore
    {
        if (! $this->pets->contains($pet)) {
            $this->pets[] = $pet;
            $pet->setPetStore($this);
        }

        return $this;
    }
}

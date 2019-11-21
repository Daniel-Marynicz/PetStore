<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PetRepository")
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(columns={"pet_store_id", "name"})})
 *
 * @UniqueEntity(
 *     fields={"petStore", "name"},
 *     message="Pet with same name already exists."
 * )
 */
class Pet
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
     * @ORM\ManyToOne(targetEntity=PetStore::class, inversedBy="pets")
     * @ORM\JoinColumn(name="pet_store_id", referencedColumnName="id")
     *
     * @var PetStore
     */
    private $petStore;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank()
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank()
     * @var string
     */
    private $species;

    public function getId() : ?int
    {
        return $this->id;
    }

    public function getPetStore() : PetStore
    {
        return $this->petStore;
    }

    public function setPetStore(PetStore $petStore) : Pet
    {
        $this->petStore = $petStore;

        return $this;
    }

    public function getName() : ?string
    {
        return $this->name;
    }

    public function setName(string $name) : self
    {
        $this->name = $name;

        return $this;
    }

    public function getSpecies() : ?string
    {
        return $this->species;
    }

    public function setSpecies(string $species) : self
    {
        $this->species = $species;

        return $this;
    }
}

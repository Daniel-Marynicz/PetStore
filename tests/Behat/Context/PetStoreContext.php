<?php

declare(strict_types=1);

namespace App\Tests\Behat\Context;

use App\Entity\Pet;
use App\Entity\PetStore;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Doctrine\ORM\EntityManagerInterface;

class PetStoreContext implements Context
{
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Given there are following Pet Stores
     */
    public function thereAreFollowingPetStores(TableNode $table) : void
    {
        foreach ($table as $row) {
            $store = new PetStore();
            $store->setName($row['name']);
            $store->setSurname($row['surname']);
            if (! empty($row['pet_name']) && ! empty($row['pet_species'])) {
                $this->addPet($store, $row['pet_name'], $row['pet_species']);
            }
            for ($i=1; $i<10; $i++) {
                if (empty($row['pet_name' . $i]) || empty($row['pet_species' . $i])) {
                    continue;
                }

                $this->addPet($store, $row['pet_name' . $i], $row['pet_species' . $i]);
            }

            $this->entityManager->persist($store);
        }
        $this->entityManager->flush();
    }

    private function addPet(PetStore $petStore, string $name, string $species) : void
    {
        $pet = new Pet();
        $pet->setName($name);
        $pet->setSpecies($species);
        $petStore->addPet($pet);
    }
}

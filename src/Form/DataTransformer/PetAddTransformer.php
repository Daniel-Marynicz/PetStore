<?php

declare(strict_types=1);

namespace App\Form\DataTransformer;

use App\Entity\Pet;
use App\Entity\PetStore;
use Symfony\Component\Form\DataTransformerInterface;
use UnexpectedValueException;
use function sprintf;

class PetAddTransformer implements DataTransformerInterface
{
    /**
     * {@inheritDoc}
     *
     * @param mixed $value
     *
     * @return null
     */
    public function transform($value)
    {
        return null;
    }

    /**
     * {@inheritDoc}
     *
     * @param mixed[] $value
     */
    public function reverseTransform($value) : PetStore
    {
        $petStore = $value['petStore'];
        $pet      = $value['pet'];
        if (! $petStore instanceof PetStore) {
            throw new UnexpectedValueException(sprintf('expected %s instance', PetStore::class));
        }
        if (! $pet instanceof Pet) {
            throw new UnexpectedValueException(sprintf('expected %s instance', Pet::class));
        }
        $petStore->addPet($pet);

        return $petStore;
    }
}

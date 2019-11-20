<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\PetStore;
use App\Form\DataTransformer\PetAddTransformer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PetAddType extends AbstractType
{
    /** @var PetAddTransformer */
    private $transformer;

    public function __construct(PetAddTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * @param mixed[] $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) : void
    {
        $builder
            ->add(
                'petStore',
                EntityType::class,
                [
                    'class' => PetStore::class,
                    'choice_label' => static function (PetStore $store) {
                        return $store->getName() . ' ' . $store->getSurname();
                    },
                    'multiple' => false,
                    'expanded' => false,
                ]
            )
            ->add(
                'pet',
                PetType::class
            )
            ->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver) : void
    {
    }
}

<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\PetStore;
use App\Form\PetAddType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use UnexpectedValueException;
use function count;
use function sprintf;

/**
 * @Route("/pet/add")
 */
class PetAddController extends AbstractController
{
    /**
     * @Route("/", name="pet_add_index", methods={"GET","POST"})
     */
    public function index(Request $request, ValidatorInterface $validator) : Response
    {
        $form = $this->createForm(PetAddType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $petStore = $form->getData();
            if (! $petStore instanceof PetStore) {
                throw new UnexpectedValueException(sprintf('expected %s instance', PetStore::class));
            }

            $errors = $validator->validate($petStore);
            if (count($errors) === 0) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($petStore);
                $entityManager->flush();

                return $this->redirectToRoute('pet_store_index');
            }
        }

        return $this->render('pet_add/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

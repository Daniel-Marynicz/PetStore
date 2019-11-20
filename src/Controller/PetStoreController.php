<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\PetStore;
use App\Form\PetStoreType;
use App\Repository\PetStoreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pet/store")
 */
class PetStoreController extends AbstractController
{
    /**
     * @Route("/", name="pet_store_index", methods={"GET"})
     */
    public function index(PetStoreRepository $petStoreRepository) : Response
    {
        return $this->render('pet_store/index.html.twig', [
            'pet_stores' => $petStoreRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="pet_store_new", methods={"GET","POST"})
     */
    public function new(Request $request) : Response
    {
        $petStore = new PetStore();
        $form     = $this->createForm(PetStoreType::class, $petStore);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($petStore);
            $entityManager->flush();

            return $this->redirectToRoute('pet_store_index');
        }

        return $this->render('pet_store/new.html.twig', [
            'pet_store' => $petStore,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pet_store_show", methods={"GET"})
     */
    public function show(PetStore $petStore) : Response
    {
        return $this->render('pet_store/show.html.twig', ['pet_store' => $petStore]);
    }

    /**
     * @Route("/{id}/edit", name="pet_store_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PetStore $petStore) : Response
    {
        $form = $this->createForm(PetStoreType::class, $petStore);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pet_store_index');
        }

        return $this->render('pet_store/edit.html.twig', [
            'pet_store' => $petStore,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pet_store_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PetStore $petStore) : Response
    {
        if ($this->isCsrfTokenValid('delete' . $petStore->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($petStore);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pet_store_index');
    }
}

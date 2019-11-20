<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\PetStoreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PetReportController extends AbstractController
{
    /**
     * @Route("/pet/report/1", name="pet_report_1", methods={"GET"})
     */
    public function report1(PetStoreRepository $repository) : Response
    {
        $query   = $repository
            ->createQueryBuilder('ps')
            ->select('ps.name as ownerName, p.name petName, p.species petSpecies')
            ->innerJoin('ps.pets', 'p')
            ->orderBy('ps.name')
            ->addOrderBy('ps.surname')
            ->addOrderBy('p.name');
        $results = $query->getQuery()->getResult();

        return $this->render('pet_report/report1.html.twig', ['results' => $results]);
    }

    /**
     * @Route("/pet/report/2", name="pet_report_2", methods={"GET"})
     */
    public function report2(PetStoreRepository $repository) : Response
    {
        $query   = $repository
            ->createQueryBuilder('ps')
            ->select('ps.name as ownerName, count(ps.id)  ownedPets')
            ->innerJoin('ps.pets', 'p')
            ->groupBy('ps.id')
            ->orderBy('ownedPets');
        $results = $query->getQuery()->getResult();

        return $this->render('pet_report/report2.html.twig', ['results' => $results]);
    }
}

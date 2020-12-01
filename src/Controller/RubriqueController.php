<?php

namespace App\Controller;

use App\Entity\Rubriques;
use App\Repository\RubriquesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RubriqueController extends AbstractController
{
    /**
     * @Route("/rubriques", name="rubrique")
     */
    public function index(RubriquesRepository $rubriquesRepository)
    {
        return $this->render('rubrique/index.html.twig', [
            'rubriques' => $rubriquesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/rubrique/{id}", name="rubrique")
     */
    public function rubrique(Rubriques $rubriques)
    {
        return $this->render('rubrique/rubrique.html.twig', [
            'rubriques' => $rubriques,
        ]);
    }
}

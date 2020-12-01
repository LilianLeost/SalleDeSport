<?php

namespace App\Controller;

use App\Repository\RubriquesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilSDSController extends AbstractController
{
    /**
     * @Route("/", name="accueilsds")
     */
    public function index()
    {
        $this->get('twig')->addGlobal("is_test","test");
        return $this->render('accueil_sds/index.html.twig', [
            'controller_name' => 'AccueilSDSController',
        ]);
    }
    /**
     * @Route("/activites", name="activites")
     */

    public function activites()
    {
        return$this->render('accueil_sds/activites.html.twig');
    }
    /**
     * @Route("/abonnements", name="abonnements")
     */
    public function abonnements()
    {
        return$this->render('accueil_sds/abonnements.html.twig');
    }
    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return$this->render('accueil_sds/contact.html.twig');
    }
    /**
     * @Route("/rubriques", name="rubriques")
     */
    public function rubriques(RubriquesRepository $rubriquesRepository): Response
    {
        return $this->render('rubriques/rubriques_user.html.twig', [
            'rubriques' => $rubriquesRepository->findAll(),
        ]);
    }


}

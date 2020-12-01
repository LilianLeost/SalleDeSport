<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class RedactorController extends AbstractController
{
    /**
     * @Route("/redactor", name="redactor")
     */
    public function index()
    {
        return $this->render('rubriques/index.html.twig', [
            'controller_name' => 'RedactorController',
        ]);
    }
}

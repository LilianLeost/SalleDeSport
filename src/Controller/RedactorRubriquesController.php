<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Rubriques;
use App\Form\RubriquesType;
use App\Repository\ArticleRepository;
use App\Repository\RubriquesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/redactor/rubriques")
 * @IsGranted("ROLE_REDACTOR")
 */

class RedactorRubriquesController extends AbstractController
{
    /**
     * @Route("/", name="rubriques_index", methods={"GET"})
     */
    public function index(RubriquesRepository $rubriquesRepository): Response
    {
        return $this->render('rubriques/index.html.twig', [
            'rubriques' => $rubriquesRepository->findAll(),
        ]);
    }
    /**
     * @Route("/new", name="rubriques_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $rubrique = new Rubriques();
        $form = $this->createForm(RubriquesType::class, $rubrique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rubrique);
            $entityManager->flush();

            return $this->redirectToRoute('rubriques_index');
        }

        return $this->render('rubriques/new.html.twig', [
            'rubrique' => $rubrique,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rubriques_show", methods={"GET"})
     */
    public function show(Rubriques $rubrique): Response
    {
        return $this->render('rubriques/show.html.twig', [
            'rubrique' => $rubrique,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="rubriques_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Rubriques $rubrique): Response
    {
        $form = $this->createForm(RubriquesType::class, $rubrique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rubriques_index');
        }

        return $this->render('rubriques/edit.html.twig', [
            'rubrique' => $rubrique,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rubriques_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Rubriques $rubrique, ArticleRepository $article): Response
    {
        if ($article->findBy(["rubriques" => $rubrique]) != null) {
            $this->addFlash('danger', "Attention vous ne pouvez pas supprimer la rubrique car elle contient des articles");
            return $this->redirectToRoute('rubriques_index');
        } else {
            if ($this->isCsrfTokenValid('delete' . $rubrique->getId(), $request->request->get('_token'))) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($rubrique);
                $entityManager->flush();
            }

            return $this->redirectToRoute('rubriques_index');
        }
    }
}

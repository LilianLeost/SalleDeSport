<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ModifCompteType;
use App\Form\RegistrationFormType;
use App\Form\UserType;
use App\Repository\RubriquesRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccueilSDSController extends AbstractController
{
    /**
     * @Route("/", name="accueilsds")
     */
    public function index(MailerInterface $mailer)
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
     * @Route("/contact", name="contact")
     */
    public function contact(MailerInterface $mailer,Request $request)
    {
        $form = $this->createFormBuilder([])
            ->add('name', TextType::class)
            ->add('email', EmailType::class)
            ->add('message', TextareaType::class)
            ->add('send', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // data is an array with "name", "email", and "message" keys
            $data = $form->getData();

            $data->get('name');

            $email = (new Email())
                ->from($data->get('email'))
                ->to('leostlilian@teissieryannis.com')
                ->text($data->get('message'));

            $mailer->send($email);
        }
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
    /**
     * @Route("/newsletter", name="newsletter")
     */
    public function newsletter(UserRepository $userRepository): Response
    {
        return $this->render('accueil_sds/newsletter.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/moncompte", name="moncompte")
     */
    public function moncompte()
    {
        return$this->render('accueil_sds/moncompte.html.twig');
    }


    /**
     * @Route("/{id}/edit", name="compte_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user, UserPasswordEncoderInterface $encoder): Response
    {
        $form = $this->createForm(ModifCompteType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $encoded = $encoder->encodePassword($user,$_POST['modif_compte']['password']);
            $user->setPassword($encoded);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('moncompte');
        }

        return $this->render('accueil_sds/moncompte_edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}

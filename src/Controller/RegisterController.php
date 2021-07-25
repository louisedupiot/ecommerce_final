<?php

namespace App\Controller;

use App\Form\RegisterType;
use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class RegisterController extends AbstractController
{
    
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/inscription', name: 'register')]


    public function index(Request $request , UserPasswordEncoderInterface $encoder): Response
    {
        $user = new Utilisateur();
        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $user = $form->getData();

            $pwd = $encoder->encodePassword($user,$user->getpassword());
            $user->setpassword($pwd);

            $this->entityManager->persist($user);
            $this->entityManager->flush();
            $this->addFlash('success', 'Utilisateur créé');
    
            return $this->render('register/index.html.twig',[
                'form' => $form -> createView()
            ]);
        }
    }   
}
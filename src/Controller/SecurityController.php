<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserRegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;

class SecurityController extends AbstractController
{
    public const LAST_EMAIL = 'app_login_form_last_email';
    
       /**
     * @Route("/resister", name="app_register")
     */
    public function resister(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder)
    {

        $form = $this->createForm(UserRegistrationFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $password = $form->get('password')->getData();
            
            $user->setPassword($passwordEncoder->encodePassword($user, $password));

            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'your account has been created successfuly !');
            
             return $this->redirectToRoute('app_home');
        }
       
        return $this->render('security/register.html.twig',
            [
              'registrationForm'=>$form->createView()  
            ]);
    }


    
    /**
     * @Route("/login", name="app_login")
     */
    public function login(Security $security)
    {
        if ($security->getUser()) {
            return $this->redirectToRoute('app_home');
        }
       // $this->denyAccessUnlessGranted('IS_AUTHENTICATED_ANNONYMOUSLY');
        return $this->render('security/login.html.twig');
    }


    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        // controller can be blank: it will never be executed!
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
}

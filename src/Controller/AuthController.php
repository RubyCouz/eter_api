<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\EterUser;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{
    /**
    *@Route("/api/register", name="register", methods="POST")
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $data = json_decode($request->getContent(), true);

        $email = $data["email"];
        $password = $data["password"];
        
        $user = new EterUser($email);

        //Rempli les champs obligatoire
        $user->setUserLogin($email);
        $user->setUserMail($email);
        $user->setUserDiscord("discord#1234");
        $user->setUserDesactivate(0);
        $user->setUserRole("Utilisateur");
        $user->setUserPassword($encoder->encodePassword($user, $password));

        $em = $this->getDoctrine()->getManager();
        
        $em->persist($user);
        $em->flush();

        return new Response(sprintf('Compte %s crée', $user->getUsername()));
    }

    

}
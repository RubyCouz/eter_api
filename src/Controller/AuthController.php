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
    *@Route("/api/register", name="register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {

        $data = json_decode($request->getContent(), true);

        $em = $this->getDoctrine()->getManager();
        
        $email = $data["email"];
        $password = $data["password"];
        
        $user = new EterUser($email);
        $user->setUserLogin($email);
        $user->setUserMail($email);
        $user->setUserDesactivate(0);
        $user->setUserPassword($encoder->encodePassword($user, $password));
        $em->persist($user);
        $em->flush();

        return new Response(sprintf('Compte %s crée', $user->getUsername()));
    }

    

}
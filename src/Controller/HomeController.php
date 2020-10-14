<?php

namespace App\Controller;


use App\Repository\EterGameRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

    /**
     * @Route("/", name="home")
     * @param EterGameRepository $repo
     * @return Response
     */
    public function index(EterGameRepository $repo) {

        return $this->render('home/index.html.twig',[
            'randGame' => $repo->getRandGame(),
        ]);
    }
}
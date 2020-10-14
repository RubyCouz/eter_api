<?php

namespace App\Controller;

use App\Entity\EterGame;
use App\Form\EterGameType;
use App\Repository\EterGameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/eter/game")
 */
class EterGameController extends AbstractController
{
    /**
     * @Route("/", name="eter_game_index", methods={"GET"})
     * @param EterGameRepository $eterGameRepository
     * @return Response
     */
    public function index(EterGameRepository $eterGameRepository): Response
    {
        return $this->render('eter_game/index.html.twig', [
            'games' => $eterGameRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="eter_game_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $eterGame = new EterGame();
        $form = $this->createForm(EterGameType::class, $eterGame);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($eterGame);
            $entityManager->flush();

            return $this->redirectToRoute('eter_game_index');
        }

        return $this->render('eter_game/new.html.twig', [
            'eter_game' => $eterGame,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="eter_game_show", methods={"GET"})
     * @param EterGame $eterGame
     * @return Response
     */
    public function show(EterGame $eterGame): Response
    {
        return $this->render('eter_game/show.html.twig', [
            'game' => $eterGame,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="eter_game_edit", methods={"GET","POST"})
     * @param Request $request
     * @param EterGame $eterGame
     * @return Response
     */
    public function edit(Request $request, EterGame $eterGame): Response
    {
        $form = $this->createForm(EterGameType::class, $eterGame);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('eter_game_index');
        }

        return $this->render('eter_game/edit.html.twig', [
            'eter_game' => $eterGame,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="eter_game_delete", methods={"DELETE"})
     */
    public function delete(Request $request, EterGame $eterGame): Response
    {
        if ($this->isCsrfTokenValid('delete'.$eterGame->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($eterGame);
            $entityManager->flush();
        }

        return $this->redirectToRoute('eter_game_index');
    }
}

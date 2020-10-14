<?php

namespace App\Controller;

use App\Entity\EterUser;
use App\Form\EterUserType;
use App\Repository\EterUserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * @Route("/eteruser")
 */

class EterUserController extends AbstractController
{
    /**
     * @Route("/", name="eter_user_index", methods={"GET"})
     * @param EterUserRepository $eterUserRepository
     * @return Response
     */
    public function index(EterUserRepository $eterUserRepository): Response
    {
        $inProgress = false;
        return $this->render('eter_user/index.html.twig', [
            'eter_users' => $eterUserRepository->findAll(),
            'inProgress' => $inProgress
        ]);
    }

    /**
     * @Route("/new", name="eter_user_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $inProgress = false;
        $eterUser = new EterUser();
        $form = $this->createForm(EterUserType::class, $eterUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($eterUser);
            $entityManager->flush();

            return $this->redirectToRoute('eter_user_index');
        }

        return $this->render('eter_user/new.html.twig', [
            'eter_user' => $eterUser,
            'form' => $form->createView(),
            'inProgress' => $inProgress
        ]);
    }

    /**
     * @Route("/{id}", name="eter_user_show", methods={"GET"})
     * @param EterUser $eterUser
     * @return Response
     */
    public function show(EterUser $eterUser): Response
    {
        $inProgress = false;

        return $this->render('eter_user/show.html.twig', [
            'eter_user' => $eterUser,
            'inProgress' => $inProgress
        ]);
    }

    /**
     * @Route("/{id}/edit", name="eter_user_edit", methods={"GET","POST"})
     * @param Request $request
     * @param EterUser $eterUser
     * @param SluggerInterface $slugger
     * @return Response
     */
    public function edit(Request $request, EterUser $eterUser, SluggerInterface $slugger): Response
    {
        $inProgress = false;

        //Création du formulaire à partir du formulaire type EterUserType
        $form = $this->createForm(EterUserType::class, $eterUser);

        //Paramétrage de l'acceptation des requêtes SQL
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            //Récupération des données du fichier uploadé
            $avatarFile = $form['user_avatar']->getData();

            //Si un fichier a été déposé
            if ($avatarFile) {

                //Récupération du nom du fichier original
                $originalFilename = pathinfo($avatarFile->getClientOriginalName(), PATHINFO_FILENAME);

                //Sécurisation du nom de fichier
                $safeFilename = $slugger->slug($originalFilename);

                //Nouveau nom du fichier et ajout de l'extension
                $newFilename = $safeFilename.'-'.uniqid().'.'.$avatarFile->guessExtension();

                //Indication du nouveau nom de fichier
                $eterUser->setUserAvatar($newFilename);

                //Déplacement du fichier dans le dossier de destination
                try {
                    $avatarFile->move(
                        $this->getParameter('upload_directory'),
                        $newFilename
                    );
                } 
                catch (FileException $e) {
                    //Possibilité d'indiquer un message d'erreur si l'upload échoue
                }
            }

            //Insertion dans la BDD
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('eter_user_show', ['id' => $eterUser->getId()]);
        }
        return $this->render('eter_user/edit.html.twig', [
            'eter_user' => $eterUser,
            'form' => $form->createView(),
            'inProgress' => $inProgress
        ]);
    }

    /**
     * @Route("/{id}", name="eter_user_delete", methods={"DELETE"})
     * @param Request $request
     * @param EterUser $eterUser
     * @return Response
     */
    public function delete(Request $request, EterUser $eterUser): Response
    {
        if ($this->isCsrfTokenValid('delete'.$eterUser->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($eterUser);
            $entityManager->flush();
            // $eterUser->setUserDesactivate(1);
            // $this->getDoctrine()->getManager()->flush();
        }

        // Destruction de la session
        $session = new Session();
        $session->invalidate();

        return $this->redirectToRoute('home');
    }


    /**
     * @Route("/login", name="user_mail", methods={"POST", "GET"})
     * @return Response
     */
    public function checkUserMail() :Response
    {
        $errorMail = '';
        $request = Request::createFromGlobals();
        $mail = $request->request->get('mail');
//        dd($mail);
        if(!preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/', $mail)) {
            $errorMail = 'Veuillez saisir une adresse mail valide';
        }
        return $this->render('error/errorEmail.html.twig', [
            'errorEmail' => $errorMail,
        ]);
    }

    /**
     * @Route("/password", name="user_password", methods={"POST", "GET"})
     * @return Response
     */
    public function checkUserPassword() :Response
    {
        $errorPassword = '';
        $request = Request::createFromGlobals();
        $password = $request->request->get('password');
//        dd($mail);
        if(!preg_match('/^[\w!?#@%ùéèà\/]{8,}$/', $password)) {
            $errorPassword = 'Veuillez saisir un mot de passe valide';
        }
        return $this->render('error/errorPassword.html.twig', [
            'errorPassword' => $errorPassword,
        ]);
    }
}

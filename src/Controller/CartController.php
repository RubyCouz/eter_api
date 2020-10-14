<?php
namespace App\Controller;
use App\Repository\EterProductRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class CartController extends AbstractController
{
    /**
     * @Route("/panier", name="cart_index")
     */
    public function index(SessionInterface $session, EterProductRepository $eterProductRepository)
    {
        $inProgress = false;
        // On recherche les produits ajoutés par l'utilisateur dans le panier. Si il est vide, il sera représenté par un tableau vide
        $panier = $session->get('panier', []);
        // Nouveau tableau contenant tous les produits sélectionnés par l'utilisateur
        $panierWithData = [];
        // On boucle sur le panier et on extrait à chaque fois l'id et la quantité
        foreach($panier as $id => $quantity)
        {
            // Récupération des données sous forme d'un tableau associatif
            $panierWithData[] = [
                'product' => $eterProductRepository->find($id),
                'quantity' => $quantity,
                'inProgress' => $inProgress
            ];
        }
        // On instaure une variable qui commence à 0
        $total = 0;
        foreach($panierWithData as $item)
        {
            // Pour chaque produit on multiplie la quantité par le prix unitaire
            $totalItem = $item['product']->getProductPrice() * $item['quantity'];
            // Le total correspondra à la somme des prix des différents articles
            $total += $totalItem;
        }
        return $this->render('cart/cart.html.twig', [
            'items' => $panierWithData,
            'total' => $total,
            'inProgress' => $inProgress
        ]);
    }

    /**
     * @Route("/panier/add{id}", name="cart_add")
     */
    public function add($id, SessionInterface $session)
    {
        $inProgress = false;
        // Dans la session, on recherche le panier et si il n'y en a pas on instaure un tableau vide
        $panier = $session->get('panier', []);
        // Si le produit et donc son id sont déjà présents on ajoute +1 à la quantité déjà présente
        // Si le produit n'est pas présent dans le panier, on l'ajoute
        if(!empty($panier[$id]))
        {
            $panier[$id]++;
        }
        else
        {
            $panier[$id] = 1;
        }
        // Sauvegarde du panier mis à jour
        $session->set('panier', $panier);
        return $this->redirectToRoute("cart_index", [
            'inProgress' => $inProgress
        ]);
    }

    /**
     * @Route("/panier/remove{id}", name="cart_remove")
     */
    public function remove($id, SessionInterface $session) {
        $inProgress = false;
        $panier = $session->get('panier', []);
        if(!empty($panier[$id]))
        {
            unset($panier[$id]);
        }
        $session->set('panier', $panier);
        return$this->redirectToRoute("cart_index", [
            'inProgress' => $inProgress
        ]);
    }

}
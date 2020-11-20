<?php

namespace App\Resolver;

use ApiPlatform\Core\GraphQl\Resolver\MutationResolverInterface;
use App\Entity\EterUser;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;

final class EterUserMutResolver implements MutationResolverInterface
{
    /**
     * @param EterUserMut|null $item
     *
     * @return EterUserMut
    */

    private $passwordEncoder;
    private $security;

    public function __construct( UserPasswordEncoderInterface $encoder, Security $security)
    {
        $this->passwordEncoder = $encoder;
        $this->security = $security; 
    }

    public function __invoke($item, array $context)
    {
        // UserPasswordEncoderInterface $encoder
        // Mutation input arguments are in $context['args']['input'].

        // Do something with the book.
        // Or fetch the book if it has not been retrieved.

        // The returned item will pe persisted.

        //dump($this->security->getUser());
        //dump($this->security->getUser()->getUserRole());
        //dump($this->security->isGranted('ROLE_ADMIN'));

        if (!$this->security->isGranted('ROLE_ADMIN')) {
            $item->setUserRole("Utilisateur");
        }

        $item->setUserDesactivate(false);
        $item->setUserDate(new \DateTime('now'));
        $password = $item->getUserPassword();
        $hash =  $this->passwordEncoder->encodePassword($item, $password);
        $item->setUserPassword($hash);

        return $item;
    }
}


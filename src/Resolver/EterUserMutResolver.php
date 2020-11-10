<?php

namespace App\Resolver;

use ApiPlatform\Core\GraphQl\Resolver\MutationResolverInterface;
use App\Entity\EterUser;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class EterUserMutResolver implements MutationResolverInterface
{
    /**
     * @param EterUserMut|null $item
     *
     * @return EterUserMut
    */

    private $passwordEncoder;

    public function __construct( UserPasswordEncoderInterface $encoder)
    {
        $this->passwordEncoder = $encoder;
    }

    public function __invoke($item, array $context)
    {
        // UserPasswordEncoderInterface $encoder
        // Mutation input arguments are in $context['args']['input'].

        // Do something with the book.
        // Or fetch the book if it has not been retrieved.

        // The returned item will pe persisted.

        $item->setUserRole("Utilisateur");

        $item->setUserDesactivate(false);


        //$dateinscr = strtotime('now');
        $item->setUserDate(new \DateTime('now'));
        
        $password = $item->getUserPassword();
        $hash =  $this->passwordEncoder->encodePassword($item, $password);
        $item->setUserPassword($hash);

        return $item;
    }
}

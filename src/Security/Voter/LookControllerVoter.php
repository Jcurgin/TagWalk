<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;


class LookControllerEditVoter extends Voter
{
    public const EDIT_LOOK_CONTROLLER= 'EDIT_LOOK_CONTROLLER';
 

    protected function supports(string $attribute, mixed $subject): bool
    {
        return $attribute === self::EDIT_LOOK_CONTROLLER;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        if (!in_array('ROLE_EMPLOYE', $user->getRoles())) {
            return false;
        }
        
        // ici onn verifie que l'utilisateur n'est pas expiré
        $expirationDate = $user->getExpirationDate();
        if ($expirationDate && $expirationDate < new \DateTime()) {
            return false;
        }

        $now = new \DateTime();
        $dayOfWeek = (int)$now->format('N');
        $hour = (int)$now->format('G');

        if ($dayOfWeek >= 1 && $dayOfWeek <= 5 && $hour >= 9 && $hour < 18) {
            return true;
        }


        return false;
    }
}

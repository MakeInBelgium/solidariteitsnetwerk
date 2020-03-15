<?php
/**
 * solidariteitsnetwerk: UserEditVoter.php
 *
 * @author Koen Van den Wijngaert <koen@neok.be>
 */

namespace App\Security\Voter;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class UserEditVoter extends Voter
{
    private const EDIT = 'edit';

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports($attribute, $subject)
    {
        return in_array($attribute, [static::EDIT], true) && $subject instanceof User;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $currentUser = $token->getUser();

        // if the user is anonymous, do not grant access
        if (!$currentUser instanceof UserInterface) {
            return false;
        }

        /** @var User $subject */
        switch ($attribute) {
            case static::EDIT:
                if ($this->security->isGranted('ROLE_SUPERADMIN', $currentUser)) {
                    return true;
                }

                if( $this->security->isGranted('ROLE_SUPERADMIN', $subject) ) {
                    return false;
                }

                if($this->security->isGranted('ROLE_ADMIN', $currentUser)) {
                    return true;
                }

                return false;
        }

        throw new \Exception(sprintf('Unhandled attribute "%s"', $attribute));
    }
}

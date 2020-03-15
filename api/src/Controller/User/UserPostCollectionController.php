<?php
/**
 * solidariteitsnetwerk: UserPostCollectionController.php
 *
 * @author Koen Van den Wijngaert <koen@neok.be>
 */

namespace App\Controller\User;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class UserPostCollectionController
 * @package App\Controller
 */
class UserPostCollectionController extends BaseUserController
{
    /**
     * @param UserInterface $data
     * @return UserInterface
     */
    public function __invoke(UserInterface $data): UserInterface
    {
        return $this->encodePassword($data);
    }
}

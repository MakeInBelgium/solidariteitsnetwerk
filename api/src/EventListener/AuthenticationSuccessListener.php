<?php
/**
 * solidariteitsnetwerk: AuthenticationSuccessListener.php
 *
 * @author Koen Van den Wijngaert <koen@neok.be>
 */

namespace App\EventListener;

use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\Role\RoleHierarchyInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class AuthenticationSuccessListener
{
    /**
     * @var NormalizerInterface
     */
    protected $normalizer;

    /**
     * @var RoleHierarchyInterface
     */
    protected $hierarchy;

    /**
     * Sets the normalizer.
     *
     * @param NormalizerInterface $normalizer A NormalizerInterface instance
     * @required
     */
    public function setNormalizer(NormalizerInterface $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    /**
     * @param RoleHierarchyInterface $hierarchy
     * @required
     */
    public function setHierarchy(RoleHierarchyInterface $hierarchy): void
    {
        $this->hierarchy = $hierarchy;
    }

    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();
        $user = $event->getUser();

        if (!$user instanceof User) {
            return;
        }

        $data['user'] = $this->normalizer->normalize($user, null, ['groups' => ['user:read']]);
        $data['roles'] = $this->hierarchy->getReachableRoleNames($user->getRoles());

        $event->setData($data);
    }
}

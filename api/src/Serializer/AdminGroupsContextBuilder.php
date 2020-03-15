<?php
/**
 * solidariteitsnetwerk: AdminGroupsContextBuilder.php
 *
 * @author Koen Van den Wijngaert <koen@neok.be>
 */

namespace App\Serializer;

use ApiPlatform\Core\Serializer\SerializerContextBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

final class AdminGroupsContextBuilder implements SerializerContextBuilderInterface
{
    private $decorated;
    private $authorizationChecker;

    public function __construct(SerializerContextBuilderInterface $decorated, AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->decorated = $decorated;
        $this->authorizationChecker = $authorizationChecker;
    }

    public function createFromRequest(Request $request, bool $normalization, ?array $extractedAttributes = null): array
    {
        $context = $this->decorated->createFromRequest($request, $normalization, $extractedAttributes);

        $context['groups'] = $context['groups'] ?? [];

        $isStaff = $this->authorizationChecker->isGranted('ROLE_STAFF');
        $isAdmin = $this->authorizationChecker->isGranted('ROLE_ADMIN');
        $isSuperAdmin = $this->authorizationChecker->isGranted('ROLE_SUPERADMIN');

        $context['groups'][] = $normalization ? 'read' : 'write';

        if ($isStaff) {
            $context['groups'][] = $normalization ? 'staff:read' : 'staff:write';
        }

        if ($isAdmin) {
            $context['groups'][] = $normalization ? 'admin:read' : 'admin:write';
        }

        if ($isSuperAdmin) {
            $context['groups'][] = $normalization ? 'superadmin:read' : 'superadmin:write';
        }

        $context['groups'] = array_unique($context['groups']);

        return $context;
    }
}

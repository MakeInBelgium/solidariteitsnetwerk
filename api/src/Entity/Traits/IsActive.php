<?php
/**
 * solidariteitsnetwerk: IsActive.php
 *
 * @author Koen Van den Wijngaert <koen@neok.be>
 */

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Trait IsActive
 * @package App\Entity\Traits
 */
trait IsActive
{
    /**
     * @ORM\Column(type="boolean")
     * @Groups({
     *     "is_active_read",
     *     "is_active_write"
     * })
     */
    protected $isActive = true;

    /**
     * @return bool
     */
    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     *
     * @return IsActive
     */
    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }
}

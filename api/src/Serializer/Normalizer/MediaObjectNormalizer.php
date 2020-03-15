<?php
/**
 * solidariteitsnetwerk: MediaObjectNormalizer.php
 *
 * @author Koen Van den Wijngaert <koen@neok.be>
 */

namespace App\Serializer\Normalizer;

use App\Entity\MediaObject;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Vich\UploaderBundle\Storage\StorageInterface;

final class MediaObjectNormalizer implements NormalizerInterface, DenormalizerInterface, SerializerAwareInterface
{
    private $decorated;

    /**
     * @var StorageInterface
     */
    private $storage;

    /**
     * @var CacheManager
     */
    private $cacheManager;

    public function __construct(NormalizerInterface $decorated)
    {
        if ( ! $decorated instanceof DenormalizerInterface) {
            throw new \InvalidArgumentException(sprintf('The decorated normalizer must implement the %s.',
                DenormalizerInterface::class));
        }

        $this->decorated = $decorated;
    }

    public function supportsNormalization($data, $format = null)
    {
        return $this->decorated->supportsNormalization($data, $format);
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = $this->decorated->normalize($object, $format, $context);

        if($object instanceof MediaObject) {
            $this->setContentUrl($object, $data);
            $this->setThumbnails($object, $data);
        }


        return $data;
    }

    protected function setContentUrl(MediaObject $object, array &$data) {
        $data['contentUrl'] = $this->storage->resolveUri($object, 'file');
    }

    protected function setThumbnails(MediaObject $object, array &$data) {
        $data['thumbnails'] = [
            'square' => $this->cacheManager->getBrowserPath($object->getRelativePath(), 'thumb_squared'),
            'thumb' => $this->cacheManager->getBrowserPath($object->getRelativePath(), 'thumb'),
            'square-medium' => $this->cacheManager->getBrowserPath($object->getRelativePath(), 'thumb_squared_md'),
            'medium' => $this->cacheManager->getBrowserPath($object->getRelativePath(), 'thumb_md'),
            'square-large' => $this->cacheManager->getBrowserPath($object->getRelativePath(), 'thumb_squared_lg'),
            'large' => $this->cacheManager->getBrowserPath($object->getRelativePath(), 'thumb_lg'),
        ];
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $this->decorated->supportsDenormalization($data, $type, $format);
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        return $this->decorated->denormalize($data, $class, $format, $context);
    }

    public function setSerializer(SerializerInterface $serializer)
    {
        if ($this->decorated instanceof SerializerAwareInterface) {
            $this->decorated->setSerializer($serializer);
        }
    }

    /**
     * @param StorageInterface $storage
     *
     * @required
     */
    public function setStorage(StorageInterface $storage): void
    {
        $this->storage = $storage;
    }

    /**
     * @param CacheManager $cacheManager
     *
     * @required
     */
    public function setCacheManager(CacheManager $cacheManager): void
    {
        $this->cacheManager = $cacheManager;
    }
}

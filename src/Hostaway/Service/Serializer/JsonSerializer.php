<?php

namespace Hostaway\Service\Serializer;

use Symfony\Component\Serializer\Serializer;

class JsonSerializer implements SerializerInterface
{
    private const FORMAT = 'json';
    /**
     * @var Serializer
     */
    private $serializer;

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize($data): string
    {
        return $this->serializer->serialize($data, self::FORMAT);
    }

    /**
     * {@inheritdoc}
     */
    public function deserialize(string $data, string $type)
    {
        return $this->serializer->deserialize($data, $type, self::FORMAT);
    }
}
<?php

namespace Hostaway\Service\Serializer;

interface SerializerInterface
{
    /**
     * @param object $data
     *
     * @return string
     */
    public function serialize($data): string;

    /**
     * @param string $data
     * @param string $type
     *
     * @return object
     */
    public function deserialize(string $data, string $type);
}
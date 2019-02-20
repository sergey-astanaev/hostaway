<?php

namespace Hostaway\Service\Connector;

use GuzzleHttp\Client;

class HostawayConnector implements HostawayConnectorInterface
{
    private const STATUS_ERROR = 'fail';
    private const STATUS_SUCCESS = 'success';

    /**
     * @var string
     */
    private $baseUri;

    /**
     * @var Client|null
     */
    private $client;

    public function __construct(string $baseUri)
    {
        $this->baseUri = $baseUri;
    }

    /**
     * @inheritdoc
     */
    public function getCountryCodeList(): array
    {
        return $this->getDataByPath('/countries');
    }

    /**
     * @inheritdoc
     */
    public function getTimeZoneList(): array
    {
        return $this->getDataByPath('/timezones');
    }

    /**
     * @param string $path
     * @return array
     *
     * @throws \RuntimeException
     */
    private function getDataByPath(string $path): array
    {
        $client = $this->getClient();

        $body = (string) $client->get($path)->getBody();

        $data =  json_decode($body, true);

        if ($data === false) {
            throw new \RuntimeException('Invalid json');
        }

        $status = $data['status'] ?? self::STATUS_ERROR;

        if ($status !== self::STATUS_SUCCESS) {
            $message = $data['message'] ?? null;
            $errors = [
                'Invalid status ' . $status,
            ];

            if ($message !== null) {
                $errors[] = $message;
            }
            throw new \RuntimeException(implode('. ', $errors));
        }

        $result = $data['result'] ?? null;
        if ($result === null) {
            throw new \RuntimeException('Unset result');
        }

        return $result;
    }

    /**
     * @return Client
     */
    private function getClient(): Client
    {
        if ($this->client === null) {
            $this->client = new Client(
                [
                    'base_uri' => $this->baseUri,
                ]
            );
        }

        return $this->client;
    }
}
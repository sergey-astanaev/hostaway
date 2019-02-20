<?php

namespace Hostaway\Service\Connector;

interface HostawayConnectorInterface
{
    /**
     * @return array
     */
    public function getCountryCodeList(): array;

    /**
     * @return array
     */
    public function getTimeZoneList(): array;
}
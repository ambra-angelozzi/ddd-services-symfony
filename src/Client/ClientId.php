<?php

namespace BestInvestmentsLtd\Client;

class ClientId
{
    protected $id;

    public function __construct() {
        $this->id = uniqid('specialist_');
    }

    public function __toString()
    {
        return '' . $this->id;
    }
}

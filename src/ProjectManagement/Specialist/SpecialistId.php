<?php

namespace BestInvestmentsLtd\Specialist;


class SpecialistId
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

<?php

namespace BestInvestmentsLtd\Specialist;


class Specialist
{
    /** @var SpecialistId */
    protected $id;
    /** @var ContactDetails */
    protected $contactDetails;

    public function __construct($contactDetails) {
        $this->contactDetails = $contactDetails;
    }

    public static function add(ContactDetails $contactDetails): PotentailSpecialist {
        // @call Prospecting/Prospect::create
    }

    public function registerSpecialist() {
        return new Specialist($contactDetails);
    }
}

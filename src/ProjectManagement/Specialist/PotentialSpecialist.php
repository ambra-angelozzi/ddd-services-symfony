<?php

namespace BestInvestmentsLtd\Specialist;

class PotentialSpecialist {

    /** @var SpecialistId */
    protected $id;
    /** @var ContactDetails */
    protected $contactDetails;

    private function __construct($contactDetails) {
        $this->contactDetails = $contactDetails;
    }

    public static function add(ContactDetails $contactDetails): PotentialSpecialist {
        // @call Prospecting/Prospect::create
    }

    public function register($specialistId) {
        return new Specialist($specialistId);
    }
}

<?php

namespace BestInvestmentsLtd\ProjectManagement\Consultation;

use BestInvestmentsLtd\Specialist\SpecialistId;
use ConsultationId;
use DateTime;

class Consultation
{
    /** @var ConsultationId */
    protected $id;
    /** @var DateTime */
    protected $time;
    /** @var SpecialistId */
    protected $specialistId;
    /** @var ConsultationStatus */
    protected $status;

    protected $duration;

    public function __construct(SpecialistId $specialistId, DateTime $time) {
        $this->specialistId = $specialistId;
        $this->status = ConsultationStatus::open();
    }

    public function report($duration) {
        if (!$this->status->is(ConsultationStatus::OPEN)) {
            throw new \Exception('OutstandingConsultation must be open');
        }
        $this->duration = $duration;
        $this->status = ConsultationStatus::confirmed();
    }

    public function discard() {
        if (!$this->status->is(ConsultationStatus::OPEN)) {
            throw new \Exception('OutstandingConsultation must be open');
        }
        $this->status = ConsultationStatus::discarded();
    }

}

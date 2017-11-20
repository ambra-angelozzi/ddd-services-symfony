<?php

namespace BestInvestmentsLtd\ProjectManagement\Consultation;

class ConsultationStatus
{
    const OPEN = 1;
    const CONFIRMED = 2;
    const DISCARDED = 3;

    private $status;

    private function __construct($status) {
        $this->status = $status;
    }

    public function is($status) {
        return $this->status === $status;
    }

    public function isNot($status) {
        return !$this->is($status);
    }

    public static function open() {
        return new ConsultationStatus(ConsultationStatus::OPEN);
    }

    public static function confirmed() {
        return new ConsultationStatus(ConsultationStatus::CONFIRMED);
    }

    public static function discarded() {
        return new ConsultationStatus(ConsultationStatus::CONFIRMED);
    }
}

<?php

namespace BestInvestmentsLtd\ProjectManagement\Project;

class Status
{
    const DRAFT = 1;
    const ACTIVE = 2;
    const CLOSED = 3;

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

    public static function draft() {
        return new Status(Status::DRAFT);
    }

    public static function active() {
        return new Status(Status::ACTIVE);
    }

    public static function closed() {
        return new Status(Status::CLOSED);
    }

}

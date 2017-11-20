<?php

namespace BestInvestmentsLtd\ProjectManagement\Project;

use BestInvestmentsLtd\Client\ClientId;
use BestInvestmentsLtd\ProjectManagement\Project\Reference;
use BestInvestmentsLtd\ProjectManagement\Consultation\Consultation;
use BestInvestmentsLtd\Specialist\SpecialistId;
use ConsultationId;
use DateTime;
use Exception;

// This is an aggregate root
class Project
{
    /** @var ProjectId */
    protected $projectId;
    /** @var string */
    protected $name;
    /** @var Reference */
    protected $reference;
    /** @var DateTime */
    protected $endDate;
    /** @var int */
    protected $clientId;
    /** @var Status */
    protected $status;
    /** @var ProjectManagerId */
    protected $projectManagerId;
    /** @var int[] */
    protected $potentialSpecialists;
    /** @var int[] */
    protected $approvedSpecialists;
    /** @var int[] */
    protected $discardedSpecialist;
    /** @var Consultation[] */
    protected $consultations;

    private function __construct($name, DateTime $endDate, ClientId $clientId) {
        $this->name = $name;
        $this->endDate = $endDate;
        $this->reference = new Reference();
        $this->clientId = $clientId;
        $this->status = Status::draft();
        $this->potentialSpecialists = [];
        $this->discardedSpecialists = [];
        $this->approvedSpecialists = [];
    }

    public function start(ProjectManagerId $projectManagerId) {
        if ($this->status->isNot(Status::DRAFT)) {
            throw new Exception('INSUFFICIENT DRAFT ERROR');
        }
        $this->projectManagerId = $projectManagerId;
        $this->status = Status::active();
    }

    public function addSpecialist(SpecialistId $specialistId) {
        if ($this->status->isNot(Status::ACTIVE)) {
            throw new Exception('INSUFFICIENT DRAFT ERROR');
        }
        if (in_array($specialistId, $this->potentialSpecialists)) {
            throw new Exception('Cannot add duplicate specialist');
        }
        $this->potentialSpecialists[] = $specialistId;
    }

    public function approveSpecialist(SpecialistId $specialistId) {
        if (in_array($specialistId, $this->potentialSpecialists)) {
            throw new \Exception('Can only approve potential specialists');
        }
        if (in_array($specialistId, $this->discardedSpecialists)) {
            throw new \Exception('Cannot approve discarded specialist');
        }
        $key = array_search($specialistId, $this->potentialSpecialists);
        array_splice($this->potentialSpecialists, $key, 1);
        $this->approvedSpecialists = $specialistId;
    }

    public function discardSpecialist(SpecialistId $specialistId) {
        if (in_array($specialistId, $this->potentialSpecialists)) {
            throw new \Exception('Can only discard potential specialists');
        }
        if (in_array($specialistId, $this->approvedSpecialists)) {
            throw new \Exception('Cannot discard approved specialist');
        }
        $key = array_search($specialistId, $this->potentialSpecialists);
        array_splice($this->potentialSpecialists, $key, 1);
        $this->discardedSpecialist = $specialistId;
    }

    public function startConsultation(DateTime $time, SpecialistId $specialistId) {
        // The project must be active
        if (!$this->status->is(Status::ACTIVE)) {
            throw new \Exception('Project is not active');
        }
        if (!in_array($specialistId, $this->approvedSpecialists)) {
            throw new \Exception('Specialist is not approved');
        }

        $this->consultations = new Consultation($specialistId, $time);
    }

    public function reportConsultation(ConsultationId $consultationId, $duration) {
        if (in_array($consultationId, $this->consultations)) {
            throw new \Exception('OutstandingConsultation must be on this project');
        }
        $key = array_search($consultationId, $this->consultations);
        $consultation = $this->consultations[$key];
        $consultation->report($duration);
    }

    public function discardConsultation(ConsultationId $consultationId) {
        if (in_array($consultationId, $this->consultations)) {
            throw new \Exception('OutstandingConsultation must be on this project');
        }
    }

    public function close()
    {
        if (!$this->status->is(Status::ACTIVE)) {
            throw new \Exception('Project is not active');
        }

        $this->status = Status::closed();
    }

    public static function draft(string $name, DateTime $endDate, $clientId): Project {
        // @todo-ambra dispatch an event to notify the project manager
        return new Project($name, $endDate, $clientId);
    }

    public function save() {
//        DBHandler::query(<<<SQL
//    INSERT INTO the_data.projects (name, end_date, reference) VALUES ($0, $1, $2)
//SQL
//        , [$this->name, $this->endDate, $this->reference]);
    }
}

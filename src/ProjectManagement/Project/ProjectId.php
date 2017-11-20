<?php

namespace BestInvestmentsLtd\ProjectManagement\Project;


class ProjectId
{
    protected $id;

    public function __construct() {
        $this->id = uniqid('project_');
    }

    public function __toString()
    {
        return '' . $this->id;
    }
}

<?php

namespace BestInvestmentsLtd\ProjectManagement\Project;

interface ProjectRepositoryInterface
{
    public function save(Project $project);
    public function get($ref);
}

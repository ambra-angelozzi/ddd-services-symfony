<?php

namespace BestInvestmentsLtd\ProjectManagement\Service\Application;

use BestInvestmentsLtd\Project\ProjectManagerId;
use BestInvestmentsLtd\ProjectManagement\Project\Project;
use BestInvestmentsLtd\ProjectManagement\Project\ProjectRepositoryInterface;

class ProjectService {

    private $projectRepository;

    public function __construct(ProjectRepositoryInterface $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function draftProject(string $name, string $deadline, string $clientId)
    {
        $project = Project::draft($name, new \DateTime($deadline), new Client($clientId));
        $this->projectRepository->save($project);
    }

    public function startProject(string $reference, string $manager)
    {
        $project = $this->projectRepository->getByReference($reference);
        $project->start(new ProjectManagerId($manager));
        $this->projectRepository->save($project);
    }

}
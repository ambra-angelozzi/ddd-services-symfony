<?php

namespace BestInvestmentsLtd\ProjectManagement\Project;

class FileBasedProjectRepository implements ProjectRepositoryInterface
{

    public function save(Project $project)
    {
        file_put_contents('/tmp/best/project/' . $project->getReference(), serialize($project));
    }

    public function get($ref)
    {
        return file_get_contents($ref);
    }
}

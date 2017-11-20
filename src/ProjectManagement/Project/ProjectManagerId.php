<?php
/**
 * Created by PhpStorm.
 * User: stuart
 * Date: 19/10/2017
 * Time: 16:03
 */

namespace BestInvestmentsLtd\ProjectManagement\Project;


class ProjectManagerId
{
    protected $id;

    public function __construct() {
        $this->id = uniqid('project_manager_');
    }

    public function __toString()
    {
        return '' . $this->id;
    }
}

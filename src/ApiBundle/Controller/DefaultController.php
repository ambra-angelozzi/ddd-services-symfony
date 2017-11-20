<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ApiBundle:Default:index.html.twig');
    }

    public function draftProjectAction(Request $request)
    {
        $projectService = $this->container->get("project_service");
        $projectService->draftProject(
            $request->get("name"),
            $request->get("deadline"),
            $request->get("client_id")
        );

        return new Response("{}");
    }
}

<?php

namespace ApiBundle\Controller;

use ApiBundle\GenericCommand\Command;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller {

    public function indexAction()
    {
        return $this->render('ApiBundle:Default:index.html.twig');
    }

    public function draftProjectAction(Request $request)
    {
        $dispatcher = $this->container->get("event_dispatcher");
        $command = new Command("draft_project", [
                'name' => $request->get("name"),
                'deadline' => $request->get("deadline"),
                'clientId' => $request->get("client_id")
            ]);

        $dispatcher->dispatch($command->getName(), $command);
        return new Response("{}");
    }
}

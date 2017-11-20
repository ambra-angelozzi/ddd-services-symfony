<?php

namespace ProjectManagementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ProjectManagementBundle:Default:index.html.twig');
    }
}

<?php

namespace Api\Version1Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction( )
    {
        return $this->render('ApiVersion1Bundle:Default:index.html.twig', array());
    }
}

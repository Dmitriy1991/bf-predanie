<?php

namespace App\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        // set auth token
        if ( !$this->get('session')->get('auth_token') ) {
            $sPHPSESSID = $this->get('request')->cookies->get('PHPSESSID');
            $this->get('session')->set('auth_token', md5( $sPHPSESSID ));
        }

        return $this->render('AppMainBundle:Default:index.html.twig', array());
    }
}

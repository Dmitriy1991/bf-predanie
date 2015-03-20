<?php

namespace App\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $session = $this->get('session');
        $session->start();

        if ( !$session->get('auth_token') ) {
            $session->set('auth_token', md5( $session->getId() ));
        }

        $aLastAuthors = json_encode( $this->get('author_service')->getLastAuthors() );

        return $this->render('AppMainBundle:Default:index.html.twig', array( 'aLastAuthors' => $aLastAuthors ));
    }
}

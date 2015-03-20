<?php

namespace Api\Version1Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\ORM\EntityManager;

use Api\Version1Bundle\Entity\Author;

class AuthorController extends Controller implements TokenAuthenticatedController {

    protected $em;

    /**
     * @InjectParams
     */
    public function __construct(EntityManager $em = null)
    {
        $this->em = $em;
    }

    /**
     * Get all authors
     *
     * @return JsonResponse
     */
    public function getAllAction() {
        $aAuthors = $this->getDoctrine()->getRepository('ApiVersion1Bundle:Author')->findAll();

        $aResponse = array();
        foreach ( $aAuthors as $oAuthor ) {
            $aResponse[] = array(
                'sName' => $oAuthor->getName(),
                'sDescription' => $oAuthor->getDescription(),
                'sBirthDate' => $oAuthor->getBirthDate()->format('Y-m-d')
            );
        }

        return new JsonResponse( $aResponse );
    }

    /**
     * Get last authors
     *
     * @param int $iStart
     * @param int $iCount
     * @return array
     */
    public function getLastAuthors ( $iStart = 0, $iCount = 3 ) {
        $aAuthors = $this->em->getRepository('ApiVersion1Bundle:Author')->getNextAuthors( $iStart, $iCount );

        $aResponse = array();
        foreach ( $aAuthors as $oAuthor ) {
            $aResponse[] = array(
                'sName' => $oAuthor->getName(),
                'sDescription' => $oAuthor->getDescription(),
                'sBirthDate' => $oAuthor->getBirthDate()->format('Y-m-d')
            );
        }

        return $aResponse;
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function nextAuthorAction ( $id ) {
        $oAuthor = $this->getDoctrine()->getRepository('ApiVersion1Bundle:Author')->getNextAuthors( $id, 1 );

        $aResponse = array(
            'sName' => $oAuthor[0]->getName(),
            'sDescription' => $oAuthor[0]->getDescription(),
            'sBirthDate' => $oAuthor[0]->getBirthDate()->format('Y-m-d')
        );

        return new JsonResponse( $aResponse );
    }


    /**
     * Get author by id
     *
     * @param $id
     * @return JsonResponse
     * @throws NotFoundHttpException
     */
    public function getAction( $id ) {
        $oAuthor = $this->getDoctrine()->getRepository('ApiVersion1Bundle:Author')->find( $id );

        if ( !$oAuthor instanceof Author ) {
            throw new NotFoundHttpException('Invalid author id');
        }

        $aResponse = array(
            'sName' => $oAuthor->getName(),
            'sDescription' => $oAuthor->getDescription(),
            'sBirthDate' => $oAuthor->getBirthDate()->format('Y-m-d')
        );

        return new JsonResponse( $aResponse );
    }

    /**
     * Adding authors
     *
     * @return JsonResponse
     */
    public function postAction () {
        $aResponse = array(
            'bError' => false,
            'iAddedCount' => rand(1, 20)
        );

        return new JsonResponse( $aResponse );
    }

    /**
     * Update author
     *
     * @param $id
     * @return JsonResponse
     */
    public function putAction ( $id ) {
        $aResponse = array(
            'bError' => false,
            'iUpdateId' => $id
        );

        return new JsonResponse( $aResponse );
    }

    /**
     * Delete author
     *
     * @param $id
     * @return JsonResponse
     */
    public function deleteAction ( $id ) {
        $aResponse = array(
            'bError' => false,
            'iDeletedId' => $id,
            'sMessage' => 'author was deleted'
        );

        return new JsonResponse( $aResponse );
    }
}

<?php

namespace Api\Version1Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Api\Version1Bundle\Entity\Author;

class AuthorController extends Controller implements TokenAuthenticatedController {

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

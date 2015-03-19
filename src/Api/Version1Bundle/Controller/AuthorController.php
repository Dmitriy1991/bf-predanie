<?php

namespace Api\Version1Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthorController extends Controller {

    /**
     * Get all authors
     *
     * @return JsonResponse
     */
    public function getAllAction() {
        $aEntity = array(
            'name' => 'Hello world!',
            'date' => date('Y:m:d')
        );

        return new JsonResponse( $aEntity );
    }

    /**
     * Get author by id
     *
     * @param $id
     * @return JsonResponse
     */
    public function getAction( $id ) {
        $aEntity = array(
            'name' => 'Hello world!',
            'date' => date('Y:m:d'),
            'id'   => $id
        );

        return new JsonResponse( $aEntity );
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

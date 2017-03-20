<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\ViewHandler;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Place;

/**
 * Controller for the places
 */
class PlaceController extends Controller
{
    /**
     * @Rest\View()
     * @Rest\Get("/places")
     * @param Request $request
     * @return View
     */
    public function getPlacesAction(Request $request)
    {
        $places = $this->get('doctrine.orm.entity_manager')
                 ->getRepository('AppBundle:Place')
                 ->findAll();
        /* @var $places Place[] */

        return $places;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/places/{id}")
     * @param int     $id
     * @param Request $request
     * @return JsonResponse
     */
    public function getPlaceAction($id, Request $request)
    {
        $place = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AppBundle:Place')
                ->find($id);
        /* @var $place Place */

        if (empty($place)) {
            return new JsonResponse(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
        }

        return $place;
    }
}

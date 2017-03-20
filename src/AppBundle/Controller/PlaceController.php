<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Get;
use AppBundle\Entity\Place;

/**
 * Controller for the places
 */
class PlaceController extends Controller
{
    /**
     * @Get("/places")
     * @param Request $request
     * @return JsonResponse
     */
    public function getPlacesAction(Request $request)
    {
        $places = $this->get('doctrine.orm.entity_manager')
                 ->getRepository('AppBundle:Place')
                 ->findAll();
        /* @var $places Place[] */

        $formatted = [];
        foreach ($places as $place) {
             $formatted[] = [
                'id' => $place->getId(),
                'name' => $place->getName(),
                'address' => $place->getAddress(),
             ];
        }

         return new JsonResponse($formatted);
    }

    /**
     * @Get("/places/{id}")
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

        $formatted = [
           'id' => $place->getId(),
           'name' => $place->getName(),
           'address' => $place->getAddress(),
        ];

        return new JsonResponse($formatted);
    }
}

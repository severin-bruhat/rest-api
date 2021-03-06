<?php
namespace AppBundle\Controller\Place;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations
use AppBundle\Form\Type\PriceType;
use AppBundle\Entity\Price;

/**
 * Controller to handle price actions
 */
class PriceController extends Controller
{

  /**
   * @Rest\View(serializerGroups={"price"})
   * @Rest\Get("/places/{id}/prices")
   * @param Request $request
   * @return Collection of prices
   */
    public function getPricesAction(Request $request)
    {
        $place = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AppBundle:Place')
                ->find($request->get('id')); // L'identifiant en tant que paramétre n'est plus nécessaire
        /* @var $place Place */

        if (empty($place)) {
            return $this->placeNotFound();
        }

        return $place->getPrices();
    }


   /**
   * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"price"})
   * @Rest\Post("/places/{id}/prices")
   * @param Request $request
   * @return Price
   */
    public function postPricesAction(Request $request)
    {
        $place = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AppBundle:Place')
                ->find($request->get('id'));
        /* @var $place Place */

        if (empty($place)) {
            return $this->placeNotFound();
        }

        $price = new Price();
        $price->setPlace($place); // Ici, le lieu est associé au prix
        $form = $this->createForm(PriceType::class, $price);

        // Le paramétre false dit à Symfony de garder les valeurs dans notre
        // entité si l'utilisateur n'en fournit pas une dans sa requête
        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($price);
            $em->flush();

            return $price;
        } else {
            return $form;
        }
    }

    /**
     * method to handle placeNotFound message
     * @return [type] [description]
     */
    private function placeNotFound()
    {
        throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Place not found');
    }
}

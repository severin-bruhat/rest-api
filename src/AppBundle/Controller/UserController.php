<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Form\Type\UserType;
use AppBundle\Entity\User;

/**
 * Controller class to handle User
 */
class UserController extends Controller
{
    /**
     * @Rest\View()
     * @Rest\Get("/users")
     * @param Request $request
     * @return JsonResponse
     */
    public function getUsersAction(Request $request)
    {
        $users = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AppBundle:User')
                ->findAll();
        /* @var $users User[] */

        return $users;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/users/{id}")
     * @param int     $id
     * @param Request $request
     * @return JsonResponse
     */
    public function getUserAction($id, Request $request)
    {
        $user = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AppBundle:User')
                ->find($id);
        /* @var $user User */

        if (empty($user)) {
            return $this->userNotFound();
        }

        return $user;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/users")
     * @param Request $request
     * @return User
     */
    public function postUsersAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($user);
            $em->flush();

            return $user;
        } else {
            return $form;
        }
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/users/{id}")
     * @param Request $request
     */
    public function removeUserAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $user = $em->getRepository('AppBundle:User')
                    ->find($request->get('id'));
        /* @var $user User */

        if ($user) {
            $em->remove($user);
            $em->flush();
        }
    }

    /**
    * @Rest\View()
    * @Rest\Put("/users/{id}")
    * @param Request $request
    * @return User
    */
    public function updateUserAction(Request $request)
    {
        return $this->updateUser($request, true);
    }

    /**
    * @Rest\View()
    * @Rest\Patch("/users/{id}")
    * @param Request $request
    * @return User
    */
    public function patchUserAction(Request $request)
    {
        return $this->updateUser($request, false);
    }
    /**
     * method to update or partialy update a user
     * @param  Request $request      [description]
     * @param  [type]  $clearMissing [description]
     * @return [type]                [description]
     */
    private function updateUser(Request $request, $clearMissing)
    {
         $user = $this->get('doctrine.orm.entity_manager')
                 ->getRepository('AppBundle:User')
                 ->find($request->get('id')); // L'identifiant en tant que paramètre n'est plus nécessaire
         /* @var $user User */

        if (empty($user)) {
             return $this->userNotFound();
        }

        $form = $this->createForm(UserType::class, $user);

        $form->submit($request->request->all(), $clearMissing);

        if ($form->isValid()) {
             $em = $this->get('doctrine.orm.entity_manager');
             $em->persist($user);
             $em->flush();

             return $user;
        } else {
             return $form;
        }
    }

    /**
     * method to handle userNotFound message
     * @return [type] [description]
     */
    private function userNotFound()
    {
        return \FOS\RestBundle\View\View::create(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
    }
}

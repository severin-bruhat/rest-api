<?php
namespace AppBundle\Security;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\ORM\EntityRepository;

/**
 * Class allowing to get the user from the provided auth-key
 */
class AuthTokenUserProvider implements UserProviderInterface
{
    protected $authTokenRepository;
    protected $userRepository;

    /**
     * [__construct description]
     * @param EntityRepository $authTokenRepository [description]
     * @param EntityRepository $userRepository      [description]
     */
    public function __construct(EntityRepository $authTokenRepository, EntityRepository $userRepository)
    {
        $this->authTokenRepository = $authTokenRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * [getAuthToken description]
     * @param  [type] $authTokenHeader [description]
     * @return [type]                  [description]
     */
    public function getAuthToken($authTokenHeader)
    {
        return $this->authTokenRepository->findOneByValue($authTokenHeader);
    }

    /**
     * [loadUserByUsername description]
     * @param  [type] $email [description]
     * @return [type]        [description]
     */
    public function loadUserByUsername($email)
    {
        return $this->userRepository->findByEmail($email);
    }

    /**
     * [refreshUser description]
     * @param  UserInterface $user [description]
     * @return [type]              [description]
     */
    public function refreshUser(UserInterface $user)
    {
        // Le systéme d'authentification est stateless, on ne doit donc jamais appeler la méthode refreshUser
        throw new UnsupportedUserException();
    }

    /**
     * [supportsClass description]
     * @param  [type] $class [description]
     * @return [type]        [description]
     */
    public function supportsClass($class)
    {
        return 'AppBundle\Entity\User' === $class;
    }
}

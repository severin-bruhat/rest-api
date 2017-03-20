<?php
namespace AppBundle\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\PreAuthenticatedToken;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\Security\Http\Authentication\SimplePreAuthenticatorInterface;
use Symfony\Component\Security\Http\HttpUtils;

/**
 * Class to handle the authentication
 */
class AuthTokenAuthenticator implements SimplePreAuthenticatorInterface, AuthenticationFailureHandlerInterface
{
    /**
    * Token validity, 12 hours
    */
    const TOKEN_VALIDITY_DURATION = 12*3600;

    protected $httpUtils;

    /**
     * [__construct description]
     * @param HttpUtils $httpUtils [description]
     */
    public function __construct(HttpUtils $httpUtils)
    {
        $this->httpUtils = $httpUtils;
    }

    /**
     * [createToken description]
     * @param  Request $request     [description]
     * @param  [type]  $providerKey [description]
     * @return [type]               [description]
     */
    public function createToken(Request $request, $providerKey)
    {

        $targetUrl = '/auth-tokens';
        // Si la requête est une création de token, aucune vérification n'est effectuée
        if ($request->getMethod() === "POST" && $this->httpUtils->checkRequestPath($request, $targetUrl)) {
            return;
        }

        $authTokenHeader = $request->headers->get('X-Auth-Token');

        if (!$authTokenHeader) {
            throw new BadCredentialsException('X-Auth-Token header is required');
        }

        return new PreAuthenticatedToken(
            'anon.',
            $authTokenHeader,
            $providerKey
        );
    }

    /**
     * [authenticateToken description]
     * @param  TokenInterface        $token        [description]
     * @param  UserProviderInterface $userProvider [description]
     * @param  [type]                $providerKey  [description]
     * @return [type]                              [description]
     */
    public function authenticateToken(TokenInterface $token, UserProviderInterface $userProvider, $providerKey)
    {
        if (!$userProvider instanceof AuthTokenUserProvider) {
            throw new \InvalidArgumentException(
                sprintf(
                    'The user provider must be an instance of AuthTokenUserProvider (%s was given).',
                    get_class($userProvider)
                )
            );
        }

        $authTokenHeader = $token->getCredentials();
        $authToken = $userProvider->getAuthToken($authTokenHeader);

        if (!$authToken || !$this->isTokenValid($authToken)) {
            throw new BadCredentialsException('Invalid authentication token');
        }

        $user = $authToken->getUser();
        $pre = new PreAuthenticatedToken(
            $user,
            $authTokenHeader,
            $providerKey,
            $user->getRoles()
        );

        $pre->setAuthenticated(true);

        return $pre;
    }

    /**
     * [supportsToken description]
     * @param  TokenInterface $token       [description]
     * @param  [type]         $providerKey [description]
     * @return [type]                      [description]
     */
    public function supportsToken(TokenInterface $token, $providerKey)
    {
        return $token instanceof PreAuthenticatedToken && $token->getProviderKey() === $providerKey;
    }

    /**
     * [onAuthenticationFailure description]
     * @param  Request                 $request   [description]
     * @param  AuthenticationException $exception [description]
     * @return [type]                             [description]
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        // Si les données d'identification ne sont pas correctes, une exception est levée
        throw $exception;
    }

    /**
    * Chek if the tokin is valid
    * @param string $authToken
    * @return boolean
    */
    private function isTokenValid($authToken)
    {
        return (time() - $authToken->getCreatedAt()->getTimestamp()) < self::TOKEN_VALIDITY_DURATION;
    }
}

<?php

namespace App\Security;

use App\Entity\Members;
use App\Form\LoginType;
use Doctrine\ORM\EntityManager;
use App\Security\LoginFormAuthenticator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{
    private $formFactory;
    private $em;
    private $router;

    public function __construct(FormFactoryInterface $formFactory, EntityManager $em, RouterInterface $router)
    {
        $this->formFactory = $formFactory;
        $this->em = $em;
        $this->router = $router;
    }
    public function getCredentials(Request $request)
    {
        $isLoginSubmit = $request->getPathInfo() == '/login' && $request->isMethod('POST');
        if (!$isLoginSubmit) {
            // skip authentication
            return;
        }
        $form = $this->formFactory->create(LoginType::class);
        $form->handleRequest($request);
        $data = $form->getData();
        $request->getSession()->set(
            Security::LAST_USERNAME,
            $data['username_login']
        );
        return $data;
    }
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $username = $credentials['username_login'];
        return $this->em->getRepository('App:members')
            ->findOneBy(['username_login' => $username]);
    }
    public function checkCredentials($credentials, UserInterface $user)
    {
        $password = $credentials['password'];
        if ($password == 'aze') {
            return true;
        }
    }

    protected function getLoginUrl()
    {
        return $this->router->generate('security_login');
    }
    protected function getDefaultSuccessRedirectUrl()
    {
        return $this->router->generate('home');
    }





    
}
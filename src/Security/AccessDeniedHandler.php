<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\User\UserInterface;


class AccessDeniedHandler implements AccessDeniedHandlerInterface
{
    private RouterInterface $router;
    private Security $security;

    public function __construct(RouterInterface $router, Security $security)
    {
        $this->router = $router;
        $this->security = $security;
    }

    public function handle(Request $request, AccessDeniedException $accessDeniedException): RedirectResponse
    {
        $user = $this->security->getUser();

        if ($user instanceof User) {
            if ($user->getIsValid()==0){
                return new RedirectResponse($this->router->generate('app_attente'));
            }else{
                return new RedirectResponse($this->router->generate('app_home'));
            }
        }else{
            return new RedirectResponse($this->router->generate('app_home'));
        }
    }
}

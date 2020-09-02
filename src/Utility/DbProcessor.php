<?php

namespace App\Utility;


namespace App\Utility;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Security;

class DbProcessor
{
    private $request;
    private $security;
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * DbProcessor constructor.
     * @param RequestStack $request
     * @param Security $security
     * @param UserRepository $repository
     */
    public function __construct(RequestStack $request, Security $security,UserRepository $repository)
    {
        $this->request = $request->getCurrentRequest();
        $this->security = $security;
        $this->repository = $repository;
    }

    public function __invoke(array $record)
    {
        //on modifie le $record pour ajouter nos infos.
        $record['extra']['clientIp'] = $this->request->getClientIp();
        $record['extra']['url'] = $this->request->getBaseUrl();
        //$user = $this->security->getUser();
//        dump("here");die;

        // Todo need to implement user login and security to set it dynamic

//        $record['extra']['user'] = $user;

        return $record;
    }

}
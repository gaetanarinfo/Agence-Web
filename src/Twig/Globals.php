<?php

namespace App\Twig;

use App\Repository\WebSiteFooterRepository;
use App\Repository\WebSiteHeaderRepository;
use App\Repository\WebSiteMenuRepository;
use Doctrine\ORM\EntityManagerInterface;

class Globals {

    /**
     *
     * @var WebSiteHeaderRepository
     * @var WebSiteFooterRepository
     * @var EntityManagerInterface
     */
    private $repository;
    private $repository2;

    public function __construct(WebSiteHeaderRepository $repository, WebSiteFooterRepository $repository2, WebSiteMenuRepository $repository3, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->repository2 = $repository2;
        $this->repository3 = $repository3;
        $this->em = $em;
    }

    public function title()
    {
        $websiteHeader = $this->repository->findHeader();
        $title = null;
        foreach($websiteHeader as $event)
        {
            $title = $event->getWebTitle();
        }
        return $title;
    }

    public function description()
    {
        $websiteHeader = $this->repository->findHeader();
        $content = null;
        foreach($websiteHeader as $event)
        {
            $content = $event->getContent();
        }
        return $content;
    }

    public function contact()
    {
        $contact = $this->repository2->findFooter();
        
        return $contact;
    }

    public function social()
    {
        $social = $this->repository2->findFooter();
        
        return $social;
    }

    public function menu()
    {
        $menu = $this->repository3->findMenu();
        
        return $menu;
    }

    public function copyright()
    {
        $websiteFooter = $this->repository2->findFooter();
        $copyright = null;
        foreach($websiteFooter as $event)
        {
            $copyright = $event->getCopyright();
        }
        return $copyright;
    }

    
}
<?php

namespace App\Twig;

use App\Entity\WebSiteFooterMenuRepository;
use App\Entity\WebSiteHeader;
use App\Repository\WebSiteFooterMenuRepository as RepositoryWebSiteFooterMenuRepository;
use App\Repository\WebSiteFooterRepository;
use App\Repository\WebSiteHeaderRepository;
use App\Repository\WebSiteMenu2Repository;
use App\Repository\WebSiteMenuAdminRepository;
use App\Repository\WebSiteMenuProRepository;
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
    private $repository3;
    private $repository4;
    private $repository5;
    private $repository6;

    public function __construct(WebSiteHeaderRepository $repository, WebSiteFooterRepository $repository2, WebSiteMenuRepository $repository3, WebSiteMenu2Repository $repository4, WebSiteMenuAdminRepository $repository5, WebSiteMenuProRepository $repository6, RepositoryWebSiteFooterMenuRepository $repository7, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->repository2 = $repository2;
        $this->repository3 = $repository3;
        $this->repository4 = $repository4;
        $this->repository5 = $repository5;
        $this->repository6 = $repository6;
        $this->repository7 = $repository7;
        $this->em = $em;
    }

    public function websiteUrl()
    {
        $websiteHeader = $this->repository->findHeader();
        $url = null;
        foreach($websiteHeader as $event)
        {
            $url = $event->getWebSiteUrl();
        }
        return $url;
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

    public function backgroundHeader()
    {
        $websiteHeader = $this->repository->findHeader();
        $background = null;
        foreach($websiteHeader as $event)
        {
            $background = $event->getBackground();
        }
        return $background;
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

    public function menu2()
    {
        $menu2 = $this->repository4->findMenu2();
        
        return $menu2;
    }

    public function menuAdmin()
    {
        $menuAdmin = $this->repository5->findMenuAdmin();
        
        return $menuAdmin;
    }

    public function menuPro()
    {
        $menuPro = $this->repository6->findMenuPro();
        
        return $menuPro;
    }

    public function footerMenu()
    {
        $footer = $this->repository7->findFooterMenu();
        
        return $footer;
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
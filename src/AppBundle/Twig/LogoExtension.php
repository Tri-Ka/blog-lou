<?php

namespace AppBundle\Twig;

use AppBundle\Services\LogoService;
use Symfony\Component\HttpFoundation\RequestStack;

class LogoExtension extends \Twig_Extension
{
    protected $service;
    private $requestStack;

    public function __construct(LogoService $service, RequestStack $requestStack)
    {
        $this->service = $service;
        $this->requestStack = $requestStack;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('renderSiteLogo', array($this, 'renderSiteLogoFunction')),
        );
    }

    /**
     * Function retrieving the website logo.
     *
     * @return string
     */
    public function renderSiteLogoFunction()
    {
        $logo = $this->service->getLogo();
        if (file_exists($logo)) {
            return '<img src="'.$this->requestStack->getMasterRequest()->getSchemeAndHttpHost().'/'.$logo.'" alt="logo">';
        } else {
            return '<span class="title-brand">Blog Logo</span>';
        }
    }

    public function getName()
    {
        return 'logo_twig_extension';
    }
}

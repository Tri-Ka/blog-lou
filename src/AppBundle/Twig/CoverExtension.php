<?php

namespace AppBundle\Twig;

use AppBundle\Services\CoverService;
use Symfony\Component\HttpFoundation\RequestStack;

class CoverExtension extends \Twig_Extension
{
    protected $service;
    private $requestStack;

    public function __construct(CoverService $service, RequestStack $requestStack)
    {
        $this->service = $service;
        $this->requestStack = $requestStack;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('renderSiteCover', array($this, 'renderSiteCoverFunction')),
        );
    }

    /**
     * Function retrieving the website cover.
     *
     * @return string
     */
    public function renderSiteCoverFunction()
    {
        $cover = $this->service->getCover();
        if (file_exists($cover)) {
            return $this->requestStack->getMasterRequest()->getSchemeAndHttpHost().'/'.$cover;
        } else {
            return $this->requestStack->getMasterRequest()->getSchemeAndHttpHost().'/';
        }
    }

    public function getName()
    {
        return 'cover_twig_extension';
    }
}

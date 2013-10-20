<?php
/**
 * Farther Horizon Site Kit
 *
 * @link       http://github.com/alanwagner/FHSK for the canonical source repository
 * @copyright Copyright (c) 2013 Farther Horizon SARL (http://www.fartherhorizon.com)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GPLv3 License
 * @author    Alan Wagner (mail@alanwagner.org)
 */

namespace FhskSiteTest\View\Helper;

use FhskSiteTest\Bootstrap;

use FhskSite\View\Helper\Site;
use PHPUnit_Framework_TestCase;

class SiteTest extends PHPUnit_Framework_TestCase
{
    /**
     * The view helper
     * @var FhskSite\View\Helper\Site
     */
    protected $helper;

    public function setUp()
    {
        $this->helper = Bootstrap::getServiceManager()->get('ViewHelperManager')->get('site');
        parent::setUp();
    }

    public function testGetServiceLocator()
    {
        $serviceLocator = $this->helper->getServiceLocator();
        $this->assertInstanceOf('Zend\View\HelperPluginManager', $serviceLocator);
    }

    public function testGetGlobalServiceLocator()
    {
        $serviceLocator = $this->helper->getGlobalServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    public function testGetPath()
    {
        $_SERVER['REQUEST_URI'] = '/mock/somecontroller';

        $path = $this->helper->__invoke('path');
        $this->assertEquals('mock', $path);
    }

    public function testGetName()
    {
        $name = $this->helper->__invoke('name');
        $this->assertEquals('MockName', $name);
    }
}
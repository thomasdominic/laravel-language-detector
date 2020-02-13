<?php

namespace Thomasdominic\LanguageDetector\Testing\Providers;

use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase;

/**
 * Class LanguageDetectorServiceProviderTest.
 */
class LanguageDetectorServiceProviderTest extends TestCase
{
    /**
     * Registering the service provider.
     */
    public function testShouldRegisterServiceProvider()
    {
        $drivers = ['browser', 'subdomain', 'uri'];

        foreach ($drivers as $shortcut) {
            $this->assertInstanceOf(
                'Thomasdominic\LanguageDetector\Contracts\DetectorDriverInterface',
                $this->app['language.driver.'.$shortcut]
            );
        }

        $this->assertInstanceOf(
            'Thomasdominic\LanguageDetector\Contracts\LanguageDetectorInterface',
            $this->app['language.detector']
        );

        $this->assertInstanceOf(
            'Thomasdominic\LanguageDetector\Contracts\LanguageDetectorInterface',
            $this->app['Thomasdominic\LanguageDetector\Contracts\LanguageDetectorInterface']
        );

        $this->app['translator']->setLocale('fr');

        $this->app['language.detector']->detectAndApply();

        $this->assertEquals('en', $this->app['translator']->getLocale());
    }

    /**
     * @param Application $app
     * @return array
     */
    public function getPackageProviders($app)
    {
        $app['config']->set(
            'language.provider',
            'Thomasdominic\LanguageDetector\Providers\LanguageDetectorServiceProvider'
        );

        return [$app['config']->get('language.provider')];
    }
}

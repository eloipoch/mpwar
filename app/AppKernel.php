<?php

use Bazinga\Bundle\HateoasBundle\BazingaHateoasBundle;
use Bazinga\Bundle\RestExtraBundle\BazingaRestExtraBundle;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use FOS\RestBundle\FOSRestBundle;
use Hautelook\TemplatedUriBundle\HautelookTemplatedUriBundle;
use JMS\SerializerBundle\JMSSerializerBundle;
use MPWAR\Infrastructure\Symfony\Bundle\MPWARBundle;
use Oracle\Infrastructure\Symfony\OracleBundle;
use Sensio\Bundle\DistributionBundle\SensioDistributionBundle;
use Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle;
use Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle;
use SimpleBus\SymfonyBridge\SimpleBusCommandBusBundle;
use SimpleBus\SymfonyBridge\SimpleBusEventBusBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\MonologBundle\MonologBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Bundle\WebProfilerBundle\WebProfilerBundle;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            new FrameworkBundle(),
            new SensioFrameworkExtraBundle(),
            new TwigBundle(),

            new MonologBundle(),
            new DoctrineBundle(),

            new FOSRestBundle(),
            new JMSSerializerBundle(),
            new BazingaHateoasBundle(),
            new HautelookTemplatedUriBundle(),
            new BazingaRestExtraBundle(),

            new MPWARBundle(),
            new SimpleBusCommandBusBundle(),
            new SimpleBusEventBusBundle(),
            new OracleBundle(),
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'])) {
            $bundles[] = new WebProfilerBundle();
            $bundles[] = new SensioDistributionBundle();
            $bundles[] = new SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}

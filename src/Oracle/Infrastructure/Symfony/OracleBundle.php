<?php

namespace Oracle\Infrastructure\Symfony;

use Oracle\Infrastructure\Symfony\DependencyInjection\OracleExtension;
use SimpleBus\SymfonyBridge\DependencyInjection\Compiler\RegisterHandlers;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class OracleBundle extends Bundle
{
    private $configurationAlias;

    public function __construct($alias = 'oracle')
    {
        $this->configurationAlias = $alias;
    }

    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(
            new RegisterHandlers(
                'oracle.query_handler_map',
                'query_handler',
                'handles'
            )
        );
    }

    public function getContainerExtension()
    {
        return new OracleExtension($this->configurationAlias);
    }
}

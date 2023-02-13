<?php

declare(strict_types = 1);

namespace ValanticSpryker\Glue\UrlsRestApi;

use Spryker\Glue\Kernel\Container;
use Spryker\Glue\UrlsRestApi\UrlsRestApiDependencyProvider as SprykerUrlsRestApiDependencyProvider;

class UrlsRestApiDependencyProvider extends SprykerUrlsRestApiDependencyProvider
{
    public const URL_RESOLVER_PLUGINS = 'URL_RESOLVER_PLUGINS';

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);

        return $this->addUrlResolverPlugins($container);
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addUrlResolverPlugins(Container $container): Container
    {
        $container->set(static::URL_RESOLVER_PLUGINS, function () {
            return $this->getUrlResolverPlugins();
        });

        return $container;
    }

    /**
     * @return array<\ValanticSpryker\Glue\UrlsRestApi\Plugin\UrlResolverPluginInterface>
     */
    protected function getUrlResolverPlugins(): array
    {
        return [ ];
    }
}

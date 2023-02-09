<?php

declare(strict_types = 1);

namespace ValanticSpryker\Glue\UrlsRestApi;

use Spryker\Glue\UrlsRestApi\Processor\Url\Resolver\UrlResolverInterface;
use Spryker\Glue\UrlsRestApi\UrlsRestApiFactory as SprykerUrlsRestApiFactory;
use ValanticSpryker\Glue\UrlsRestApi\Processor\Url\Resolver\UrlResolver;

/**
 * @method \Spryker\Glue\UrlsRestApi\UrlsRestApiConfig getConfig()
 */
class UrlsRestApiFactory extends SprykerUrlsRestApiFactory
{
    /**
     * @return \Spryker\Glue\UrlsRestApi\Processor\Url\Resolver\UrlResolverInterface
     */
    public function createUrlResolver(): UrlResolverInterface
    {
        return new UrlResolver(
            $this->getUrlStorageClient(),
            $this->createUrlResponseBuilder(),
            $this->getRestUrlResolverAttributesTransferProviderPlugins(),
            $this->getUrlResolverPlugins(),
        );
    }

    /**
     * @return array<\Pyz\Glue\UrlsRestApi\Plugin\UrlResolverPluginInterface>
     */
    public function getUrlResolverPlugins(): array
    {
        return $this->getProvidedDependency(UrlsRestApiDependencyProvider::URL_RESOLVER_PLUGINS);
    }
}

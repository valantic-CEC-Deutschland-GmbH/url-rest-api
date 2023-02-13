<?php

declare(strict_types = 1);

namespace ValanticSpryker\Glue\UrlsRestApi\Processor\Url\Resolver;

use Generated\Shared\Transfer\RestUrlResolverAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\UrlsRestApi\Dependency\Client\UrlsRestApiToUrlStorageClientInterface;
use Spryker\Glue\UrlsRestApi\Processor\Url\Resolver\UrlResolver as SprykerUrlResolver;
use Spryker\Glue\UrlsRestApi\Processor\Url\ResponseBuilder\UrlResponseBuilderInterface;

class UrlResolver extends SprykerUrlResolver
{
    /**
     * @var array<\ValanticSpryker\Glue\UrlsRestApi\Plugin\UrlResolverPluginInterface>
     */
    private array $urlResolverPlugins;

    /**
     * @param \Spryker\Glue\UrlsRestApi\Dependency\Client\UrlsRestApiToUrlStorageClientInterface $urlStorageClient
     * @param \Spryker\Glue\UrlsRestApi\Processor\Url\ResponseBuilder\UrlResponseBuilderInterface $urlResponseBuilder
     * @param array $restUrlResolverAttributesTransferProviderPlugins
     * @param array $urlResolverPlugins
     */
    public function __construct(
        UrlsRestApiToUrlStorageClientInterface $urlStorageClient,
        UrlResponseBuilderInterface $urlResponseBuilder,
        array $restUrlResolverAttributesTransferProviderPlugins,
        array $urlResolverPlugins
    ) {
        parent::__construct($urlStorageClient, $urlResponseBuilder, $restUrlResolverAttributesTransferProviderPlugins);
        $this->urlResolverPlugins = $urlResolverPlugins;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function getUrlResolver(RestRequestInterface $restRequest): RestResponseInterface
    {
        $restResponse = $this->executeUrlResolverPlugins($restRequest);
        if (!$restResponse) {
            $restResponse = parent::getUrlResolver($restRequest);
        }

        return $restResponse;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface|null
     */
    private function executeUrlResolverPlugins(RestRequestInterface $restRequest): ?RestResponseInterface
    {
        $restUrlResolverAttributesTransfer = new RestUrlResolverAttributesTransfer();

        foreach ($this->urlResolverPlugins as $resolverPlugin) {
            $restUrlResolverAttributesTransfer = $resolverPlugin->resolve($restRequest);
        }

        if ($restUrlResolverAttributesTransfer->getEntityType() !== null) {
            return $this->urlResponseBuilder->createUrlResolverResourceResponse($restUrlResolverAttributesTransfer);
        }

        return null;
    }
}

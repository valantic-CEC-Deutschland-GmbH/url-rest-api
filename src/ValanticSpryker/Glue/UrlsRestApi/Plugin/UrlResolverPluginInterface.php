<?php

declare(strict_types = 1);

namespace Pyz\Glue\UrlsRestApi\Plugin;

use Generated\Shared\Transfer\RestUrlResolverAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface UrlResolverPluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\RestUrlResolverAttributesTransfer
     */
    public function resolve(RestRequestInterface $restRequest): RestUrlResolverAttributesTransfer;
}

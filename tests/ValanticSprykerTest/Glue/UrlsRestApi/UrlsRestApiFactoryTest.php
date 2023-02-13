<?php

declare(strict_types = 1);

namespace ValanticSprykerTest\Glue\UrlsRestApi;

use Codeception\Test\Unit;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Client\UrlStorage\UrlStorageClient;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\Kernel\Container;
use Spryker\Glue\UrlsRestApi\Dependency\Client\UrlsRestApiToUrlStorageClientInterface;
use Spryker\Glue\UrlsRestApi\UrlsRestApiDependencyProvider as SprykerUrlsRestApiDependencyProvider;
use ValanticSpryker\Glue\UrlsRestApi\Processor\Url\Resolver\UrlResolver;
use ValanticSpryker\Glue\UrlsRestApi\UrlsRestApiDependencyProvider;
use ValanticSpryker\Glue\UrlsRestApi\UrlsRestApiFactory;

/**
 * Auto-generated group annotations
 *
 * @group ValanticSprykerTest
 * @group Glue
 * @group UrlsRestApi
 * Add your own group annotations below this line
 */
class UrlsRestApiFactoryTest extends Unit
{
  /**
   * @var \ValanticSpryker\Glue\UrlsRestApi\UrlsRestApiFactory
   */
    protected $businessFactory;

  /**
   * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\Kernel\Container
   */
    private Container $containerMock;

  /**
   * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Client\UrlStorage\UrlStorageClient&\PHPUnit\Framework\MockObject\MockObject)
   */
    private MockObject|UrlStorageClient $urlStorageClient;

  /**
   * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface&\PHPUnit\Framework\MockObject\MockObject)
   */
    private RestResourceBuilderInterface|MockObject $restResourceBuilderMock;

  /**
   * @return void
   */
    protected function _before(): void
    {
        parent::_before();
    }

  /**
   * @return void
   */
    public function testCreateUrlResolver(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
        ->disableOriginalConstructor()
        ->getMock();

        $this->urlStorageClient = $this->getMockBuilder(UrlsRestApiToUrlStorageClientInterface::class)
        ->disableOriginalConstructor()
        ->getMock();

        $this->containerMock->expects(static::atLeastOnce())
        ->method('has')
        ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
        ->method('get')
        ->withConsecutive(
            [SprykerUrlsRestApiDependencyProvider::CLIENT_URL_STORAGE],
            [SprykerUrlsRestApiDependencyProvider::PLUGINS_REST_URL_RESOLVER_ATTRIBUTES_TRANSFER_PROVIDER],
            [UrlsRestApiDependencyProvider::URL_RESOLVER_PLUGINS],
        )
        ->willReturnOnConsecutiveCalls(
            $this->urlStorageClient,
            [],
            [],
        );

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
        ->disableOriginalConstructor()
        ->getMock();

        $this->businessFactory = new class ($this->restResourceBuilderMock) extends UrlsRestApiFactory {
          /**
           * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
           */
            protected RestResourceBuilderInterface $restResourceBuilder;

          /**
           * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
           */
            public function __construct(RestResourceBuilderInterface $restResourceBuilder)
            {
                $this->restResourceBuilder = $restResourceBuilder;
            }

          /**
           * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
           */
            public function getResourceBuilder(): RestResourceBuilderInterface
            {
                return $this->restResourceBuilder;
            }
        };

        $this->businessFactory->setContainer($this->containerMock);

        $this->assertInstanceOf(UrlResolver::class, $this->businessFactory->createUrlResolver());
    }
}

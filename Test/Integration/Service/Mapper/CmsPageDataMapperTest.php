<?php
namespace Creativestyle\CmsTagManagerExtension\Test\Integration\Service\Mapper;

/**
 * @magentoDbIsolation enabled
 * @magentoAppIsolation enabled
 */
class CmsPageDataMapperTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \Magento\TestFramework\ObjectManager
     */
    protected $objectManager;

    /**
     * @var \Creativestyle\CmsTagManagerExtension\Service\Mapper\CmsPageDataMapper
     */
    protected $dataMapper;

    /**
     * @var \Magento\Cms\Model\ResourceModel\Page\Collection
     */
    protected $cmsPageCollection;

    public function setUp()
    {
        $this->objectManager = \Magento\TestFramework\ObjectManager::getInstance();


        $this->dataMapper = $this->objectManager->create(\Creativestyle\CmsTagManagerExtension\Service\Mapper\CmsPageDataMapper::class);

        $this->cmsPageCollection = $this->objectManager->create(\Magento\Cms\Model\ResourceModel\Page\Collection::class);
    }

    /**
     * @magentoDbIsolation enabled
     * @magentoDataFixture loadPages
     */
    public function testItMapsPageCorrectly()
    {
        $cmsCollection = $this->cmsPageCollection;

        $cmsCollection->addFieldToFilter('identifier', 'page_test_tag1');

        $result = $this->dataMapper->mapPage($cmsCollection->getFirstItem());

        $this->assertArrayHasKey('headline', $result);
        $this->assertArrayHasKey('href', $result);
        $this->assertArrayHasKey('image', $result);
        $this->assertArrayHasKey('src', $result['image']);
        $this->assertEquals('Cms Test Tag Page1', $result['headline']);
        $this->assertEquals('http://localhost/index.php/page_test_tag1', $result['href']);
        $this->assertEquals('http://localhost/pub/media/cmsteaser/image1.png', $result['image']['src']);
    }


    public static function loadPages() {
        include __DIR__.'/../../../_files/pages.php';
    }

}
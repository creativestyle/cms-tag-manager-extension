<?php
namespace Creativestyle\CmsTagManagerExtension\Test\Integration\Controller\Adminhtml\Teaser;

/**
 * @magentoDbIsolation enabled
 * @magentoAppIsolation enabled
 */
class UploadTest extends \Magento\TestFramework\TestCase\AbstractBackendController
{
    /**
     * @var \Magento\TestFramework\ObjectManager
     */
    protected $objectManager;

    /**
     * @var \Creativestyle\CmsTagManagerExtension\Service\Processor\UploadTeaser
     */
    protected $uploadProcessor;

    /**
     * @var \Creativestyle\CmsTagManagerExtension\Api\TagsRepositoryInterface
     */
    protected $tagsRepository;

    /**
     * @var \Magento\Framework\Filesystem
     */
    protected $filesystem;

    public function setUp()
    {
        parent::setUp();
        $this->objectManager = \Magento\TestFramework\ObjectManager::getInstance();

        $this->uploadProcessor = $this->objectManager->create(\Creativestyle\CmsTagManagerExtension\Service\Processor\UploadTeaser::class);

        $this->tagsRepository = $this->objectManager->create(\Creativestyle\CmsTagManagerExtension\Api\TagsRepositoryInterface::class);

        $this->filesystem = $this->objectManager->create(\Magento\Framework\Filesystem::class);
    }

    /**
     * @magentoDbIsolation enabled
     * @magentoDataFixture moveCmsImageToTmp
     */
    public function testItUploadFileCorrectly()
    {
        $_FILES = [
            'cms_image_teaser' => [
                'name' => 'magento_image.jpg',
                'type' => 'image/jpg',
                'tmp_name' => __DIR__.'/../../../../_files/tmp/magento_image.jpg',
                'error' => 0,
                'size' => 13864
            ]
        ];

        $this->dispatch('backend/cmstags/teaser/upload');

        $response = json_decode($this->getResponse()->getBody(), true);
        $this->assertTrue(isset($response['name']));

        $this->assertTrue(isset($response['name']));
        $path = $this->filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA)->getAbsolutePath() . 'cmsteaser/' . $response['name'];
        $fileExist = file_exists($path);
        $this->assertTrue($fileExist);
    }


    /**
     * @magentoDbIsolation enabled
     * @magentoDataFixture moveCmsImageToTmp
     */
    public function testUploadWithWrongData()
    {
        $_FILES = [
            'brand_icon' => [
                'name' => 'magento_image.jpg',
                'type' => 'image/jpg',
                'tmp_name' => __DIR__.'/../../../d/_files/tmp/magento_image.jpg',
                'error' => 0,
                'size' => 13864
            ]
        ];

        $this->dispatch('backend/cmstags/teaser/upload');

        $response = json_decode($this->getResponse()->getBody(), true);

        $this->assertTrue(isset($response['error']));
    }

    public static function moveCmsImageToTmp() {
        include __DIR__.'/../../../../_files/cms_image.php';
    }
}
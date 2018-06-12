<?php
namespace Creativestyle\CmsTagManagerExtension\Service\Admin;

class ImageTeaserDataProvider
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;
    /**
     * @var \Creativestyle\CmsTagManagerExtension\Service\ImageTeaserUrlProvider
     */
    private $imageTeaserUrlProvider;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Creativestyle\CmsTagManagerExtension\Service\ImageTeaserUrlProvider $imageTeaserUrlProvider
    )
    {
        $this->storeManager = $storeManager;
        $this->imageTeaserUrlProvider = $imageTeaserUrlProvider;
    }

    /**
     * @param string $imageName
     * @return array
     */
    public function getImageData($imageName)
    {
        $size = file_exists('media/cmsteaser/' . $imageName) ? filesize('media/cmsteaser/' . $imageName) : 0;

        $url = $this->imageTeaserUrlProvider->getCmsTeaserUrl($imageName);

        $imageData = [
            0 => [
                'url' => $url,
                'name' => $imageName,
                'size' => $size
            ]
        ];

        return $imageData;
    }

}
<?php
namespace Creativestyle\CmsTagManagerExtension\Plugin;

class CmsTeaserImageUrlMethod
{
    /**
     * @var \Creativestyle\CmsTagManagerExtension\Service\ImageTeaserUrlProvider
     */
    private $imageTeaserUrlProvider;

    public function __construct(
        \Creativestyle\CmsTagManagerExtension\Service\ImageTeaserUrlProvider $imageTeaserUrlProvider
    )
    {
        $this->imageTeaserUrlProvider = $imageTeaserUrlProvider;
    }

    public function aroundGetData(\Magento\Cms\Model\Page $subject, callable $proceed, $key = '', $index = null)
    {
        if ($key != 'cms_teaser_image_url') {
            return $proceed($key, $index);
        }

        $result = $this->imageTeaserUrlProvider->getCmsTeaserUrl($subject->getCmsImageTeaser());

        return $result;
    }
}
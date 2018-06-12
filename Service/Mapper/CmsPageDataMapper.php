<?php
namespace Creativestyle\CmsTagManagerExtension\Service\Mapper;

class CmsPageDataMapper
{
    /**
     * @var \Magento\Cms\Helper\Page
     */
    private $cmsPageHelper;
    /**
     * @var \Creativestyle\ContentConstructorFrontendExtension\Service\MediaResolver
     */
    private $mediaResolver;

    public function __construct(
        \Magento\Cms\Helper\Page $cmsPageHelper,
        \Creativestyle\ContentConstructorFrontendExtension\Service\MediaResolver $mediaResolver
    )
    {
        $this->cmsPageHelper = $cmsPageHelper;
        $this->mediaResolver = $mediaResolver;
    }

    public function mapPage($page)
    {
        $url = false;
        if($page->getCmsImageTeaser()) {
            $url = $page->getCmsTeaserImageUrl();
        }
        $pagesData = [
            'headline' => $page->getTitle(),
            'href' => $this->cmsPageHelper->getPageUrl($page->getId()),
            'image' => [
                'src' => $url ? $url :'',
                'srcSet' => $url ? $this->mediaResolver->resolveSrcSet($url) : ''
            ],
            'displayVariant' => 2
        ];

        return $pagesData;
    }
}
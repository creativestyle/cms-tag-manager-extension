<?php
namespace Creativestyle\CmsTagManagerExtension\Observer;

class BeforeCmsPageSave implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @var \Creativestyle\CmsTagManagerExtension\Service\Processor\SaveTags
     */
    private $saveTagsProcessor;

    public function __construct(
        \Creativestyle\CmsTagManagerExtension\Service\Processor\SaveTags $saveTagsProcessor
    )
    {
        $this->saveTagsProcessor = $saveTagsProcessor;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $pageObject = $observer->getObject();

        $imageTeaserData = $pageObject->getData('cms_image_teaser');

        if ($imageTeaserData && isset($imageTeaserData[0]['name'])) {
            $pageObject->setData('cms_image_teaser', $imageTeaserData[0]['name']);
        }
    }
}
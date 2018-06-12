<?php
namespace Creativestyle\CmsTagManagerExtension\Observer;

class AfterCmsPageSave implements \Magento\Framework\Event\ObserverInterface
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

        $data = [
            'page_id' => $pageObject->getPageId(),
            'page_tags' => $pageObject->getCmsPageTags()
        ];

        $this->saveTagsProcessor->processSave($data);
    }
}
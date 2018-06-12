<?php
namespace Creativestyle\CmsTagManagerExtension\Plugin;

class AroundFilterByTag
{
    /**
     * @var \Creativestyle\CmsTagManagerExtension\Api\TagsRepositoryInterface
     */
    private $tagsRepository;
    /**
     * @var \Creativestyle\CmsTagManagerExtension\Model\TagsFactory
     */
    private $tagsFactory;

    public function __construct(
        \Creativestyle\CmsTagManagerExtension\Api\TagsRepositoryInterface $tagsRepository,
        \Creativestyle\CmsTagManagerExtension\Model\TagsFactory $tagsFactory
    )
    {
        $this->tagsRepository = $tagsRepository;
        $this->tagsFactory = $tagsFactory;
    }

    public function aroundAddFieldToFilter(\Magento\Cms\Model\ResourceModel\Page\Collection $subject, callable $proceed, $field, $condition)
    {
        if($field != 'cms_page_tags'){
            return $proceed($field, $condition);
        }

        $pageIds = $this->tagsRepository->getCmsPageIdsByTags($condition['in']);
        $subject->addFieldToFilter('page_id', ['in' => $pageIds]);

        return $subject;
    }
}

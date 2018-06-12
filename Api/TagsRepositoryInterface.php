<?php

namespace Creativestyle\CmsTagManagerExtension\Api;

use Creativestyle\CmsTagManagerExtension\Api\Data\TagsInterface;

interface TagsRepositoryInterface
{
    /**
     * @param int $id
     * @return array
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getTagsByCmsPageId($id);

    /**
     * @param string $tagName
     * @return array
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getCmsPagesByTagName($tagName);

    /**
     * @param $pageId
     * @param $tagName
     * @return \Magento\Framework\DataObject|null
     */
    public function getTag($pageId, $tagName);

    /**
     * @param \Creativestyle\CmsTagManagerExtension\Api\Data\TagsInterface $tag
     * @return \Creativestyle\CmsTagManagerExtension\Api\Data\TagsInterface
     */
    public function save(TagsInterface $tag);

    /**
     * @param \Creativestyle\CmsTagManagerExtension\Api\Data\TagsInterface $tag
     * @return void
     */
    public function delete(TagsInterface $tag);

    /**
     * @return array
     */
    public function getAllTags();


    /**
     * @param array $tags
     * @return \Magento\Cms\Model\ResourceModel\Page\Collection
     */
    public function getCmsPageCollectionByTags($tags);

    /**
     * @param array $tags
     * @return array
     */
    public function getCmsPageIdsByTags($tags);

}
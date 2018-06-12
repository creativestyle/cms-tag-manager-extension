<?php
namespace Creativestyle\CmsTagManagerExtension\Service\Processor;

class SaveTags
{
    /**
     * @var \Creativestyle\CmsTagManagerExtension\Api\TagsRepositoryInterface
     */
    private $tagsRepository;
    /**
     * @var \Creativestyle\CmsTagManagerExtension\Model\TagsFactory
     */
    private $tags;

    public function __construct(
        \Creativestyle\CmsTagManagerExtension\Api\TagsRepositoryInterface $tagsRepository,
        \Creativestyle\CmsTagManagerExtension\Model\TagsFactory $tags
    )
    {
        $this->tagsRepository = $tagsRepository;
        $this->tags = $tags;
    }

    /**
     * @param array $data
     */
    public function processSave($data)
    {
        $postTagsArray = explode(',', $data['page_tags']);

        $pageTags = $this->tagsRepository->getTagsByCmsPageId($data['page_id']);

        $tagsToSkip = [];
        foreach ($pageTags as $tag) {
            if (!in_array($tag, $postTagsArray)) {
                $tag = $this->tagsRepository->getTag($data['page_id'], $tag);
                $this->tagsRepository->delete($tag);
            }

            $tagsToSkip[] = $tag;
        }

        foreach ($postTagsArray as $postTag) {
            if (!$postTag) {
                continue;
            }
            if (in_array($postTag, $tagsToSkip)) {
                continue;
            }

            $newTag = $this->tags->create();

            $newTag->setCmsPageId($data['page_id']);
            $newTag->setTagName($postTag);
            $this->tagsRepository->save($newTag);
        }
    }
}
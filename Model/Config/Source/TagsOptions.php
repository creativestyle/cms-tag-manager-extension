<?php
namespace Creativestyle\CmsTagManagerExtension\Model\Config\Source;

class TagsOptions implements \Magento\Framework\Option\ArrayInterface
{

    /**
     * @var \Creativestyle\CmsTagManagerExtension\Api\TagsRepositoryInterface
     */
    private $tagsRepository;

    public function __construct(
        \Creativestyle\CmsTagManagerExtension\Api\TagsRepositoryInterface $tagsRepository
    )
    {
        $this->tagsRepository = $tagsRepository;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $result = [];

        $allTags = $this->tagsRepository->getAllTags();

        foreach ($allTags as $tag) {
            $result[] = [
                'value' => $tag,
                'label' => $tag
            ];
        }

        return $result;
    }
}
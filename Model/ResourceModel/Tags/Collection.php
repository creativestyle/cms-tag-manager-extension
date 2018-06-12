<?php

namespace Creativestyle\CmsTagManagerExtension\Model\ResourceModel\Tags;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'Creativestyle\CmsTagManagerExtension\Model\Tags',
            'Creativestyle\CmsTagManagerExtension\Model\ResourceModel\Tags'
        );
    }
}
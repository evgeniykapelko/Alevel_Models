<?php

namespace Alevel\Learning\Model;

use Magento\Framework\Model\AbstractModel;
use Alevel\Learning\Api\Data\PostInterface;

use Alevel\Learning\Model\ResourceModel\Post as ResourceModel;

/**
 * Class Post.
 *
 * @package Alevel\Learning\Model
 */
class Post extends AbstractModel implements PostInterface
{

    /**
     *  Init resource model.
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @return mixed|string
     */
    public function getName()
    {
        return $this->getData(PostInterface::NAME);
    }

    public function setName($name)
    {
        return $this->setData(PostInterface::NAME, $name);
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->getData(PostInterface::EMAIL);
    }

    public function setEmail($email)
    {
        return $this->setData(PostInterface::EMAIL, $email);
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->getData(PostInterface::CONTENT);
    }

    public function setContent($content)
    {
        return $this->setData(PostInterface::CONTENT, $content);
    }

    /**
     * @return mixed
     */
    public function getEnabled()
    {
        return $this->getData(PostInterface::ENABLED);
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->getData(PostInterface::TELEPHONE);
    }

}
<?php

namespace Alevel\Learning\Api\Data;

/**
 * Interface PostInterface
 * @package Alevel\Learning\Api\Data
 */
interface PostInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    const ENTITY_ID = 'entity_id';
    const NAME = 'name';
    const EMAIL = 'email';
    const CONTENT = 'content';
    const ENABLED = 'enabled';
    const TELEPHONE = 'telephone';

    /**
     * @return int
     */
    public function getId();

    /**
     * @return int
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @return string
     */
    public function setEmail($email);

    /**
     * @return string
     */
    public function getContent();

    /**
     * @return string
     */
    public function setContent($content);

    /**
     * @return string
     */
    public function getEnabled();

    /**
     * @return mixed
     */
    public function getTelephone();
}
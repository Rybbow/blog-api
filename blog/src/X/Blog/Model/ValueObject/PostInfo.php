<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace X\Blog\Model\ValueObject;

/**
 * Class PostInfo
 *
 * @author  Michał Rybnik <rybbow@gmail.com> 
 */
class PostInfo
{
    /** @var TitleInfo */
    private $titleInfo;

    /** @var DateInfo */
    private $dateInfo;

    /**
     * @param TitleInfo $titleInfo
     * @param DateInfo  $dateInfo
     */
    public function __construct(TitleInfo $titleInfo, DateInfo $dateInfo)
    {
        $this->titleInfo = $titleInfo;
        $this->dateInfo  = $dateInfo;
    }

    /**
     * @return DateInfo
     */
    public function getDateInfo()
    {
        return $this->dateInfo;
    }

    /**
     * @return TitleInfo
     */
    public function getTitleInfo()
    {
        return $this->titleInfo;
    }

    /**
     * @return Title
     */
    public function getTitle()
    {
        return $this->titleInfo->getTitle();
    }

    /**
     * @return Slug
     */
    public function getSlug()
    {
        return $this->titleInfo->getSlug();
    }

}

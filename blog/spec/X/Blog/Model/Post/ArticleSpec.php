<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\X\Blog\Model\Post;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use X\Blog\Model\Collection\Displayables;
use X\Blog\Model\Content;
use X\Blog\Model\Displayable\DisplayableInterface;
use X\Blog\Model\Displayable\Page;
use X\Blog\Model\Post;
use X\Blog\Model\Post\Article;
use X\Blog\Model\ValueObject\PostInfo;
use X\Common\Exception\InvalidTypeException;

class ArticleSpec extends ObjectBehavior
{
    function let(PostInfo $postInfo, Content $content)
    {
        $this->beConstructedWith($postInfo, $content);
    }
    
    function it_is_initializable()
    {
        $this->shouldHaveType(Article::class);
    }

    function it_is_a_post_subtype()
    {
        $this->shouldHaveType(Post::class);
    }

    function it_has_added_pages(Content $content, Displayables $displayables, Page $page)
    {
        $content->getDisplayables()->willReturn($displayables);
        $displayables->add($page)->shouldBeCalled()->willReturn(true);

        $this->addDisplayable($page);
    }

    function it_cannot_accept_displayable_other_than_page(DisplayableInterface $displayable)
    {
        $this->shouldThrow(InvalidTypeException::class)->during('addDisplayable', [$displayable]);
    }
}

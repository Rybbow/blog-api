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
use X\Blog\Model\Post;
use X\Blog\Model\Post\Article;
use X\Blog\Model\ValueObject\PostInfo;

class ArticleSpec extends ObjectBehavior
{
    function let(PostInfo $postInfo)
    {
        $this->beConstructedWith($postInfo);
    }
    
    function it_is_initializable()
    {
        $this->shouldHaveType(Article::class);
    }

    function it_is_a_post_subtype()
    {
        $this->shouldHaveType(Post::class);
    }
}

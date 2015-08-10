<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\X\Blog\Service\Factory;

use Doctrine\Common\Collections\Collection;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use X\Blog\Model\Blog;
use X\Blog\Model\Post\Article;
use X\Blog\Model\ValueObject\Slug;
use X\Blog\Model\ValueObject\Title;
use X\Blog\Service\Factory\ArticleFactory;
use X\Blog\Service\Slug\SlugifierInterface;
use X\Common\Model\String\Text;

class ArticleFactorySpec extends ObjectBehavior
{
    function let(SlugifierInterface $slugifier)
    {
        $this->beConstructedWith($slugifier);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ArticleFactory::class);
    }

    function it_creates_an_article(
        Blog $blog,
        Title $title,
        Text $teaser,
        Collection $rawDisplayables,
        SlugifierInterface $slugifier,
        Slug $slug)
    {
        $slugifier->slugify($title)->shouldBeCalled()->willReturn($slug);

        $blog->addPost(Argument::that(function($argument) use($slug) {
            return $argument instanceof Article
                && $argument->getSlug() === $slug->getWrappedObject();
        }))->shouldBeCalled();

        $rawDisplayables->getIterator()->willReturn(new \ArrayIterator([]));

        $this->create($blog, $title, $teaser, $rawDisplayables)->shouldBeAnInstanceOf(Article::class);
    }
}

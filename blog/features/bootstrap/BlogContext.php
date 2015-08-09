<?php
/**
 * This file is part of the blog package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use X\Blog\Model\Blog;
use X\Blog\Model\Author;
use X\Blog\Model\Post;
use X\Blog\Model\Identifier\BlogId;
use X\BlogBundle\Repository\InMemoryBlogRepository;
use X\Blog\Service\Factory\AbstractPostFactory;
use X\Blog\Service\Factory\BlogFactory;
use X\Blog\Service\Factory\ArticleFactory;
use X\BlogBundle\Service\Slug\DoctrineInflectorSlugifier;
use X\Blog\Model\ValueObject\Slug;
use X\Blog\Model\ValueObject\Title;
use X\Blog\Model\Content\NullContent;

/**
 * Class BlogContext
 *
 * @author  Michał Rybnik <rybbow@gmail.com>
 */
class BlogContext implements Context, SnippetAcceptingContext
{
    /** @var Author */
    private $owner;

    /** @var InMemoryBlogRepository */
    private $repository;

    /** @var BlogId */
    private $blogId;

    /** @var Slug */
    private $slug;

    /**
     *
     */
    public function __construct()
    {
        $this->owner      = new Author();
        $this->repository = new InMemoryBlogRepository();
    }

    /**
     * @Given there is a blog I own
     */
    public function thereIsABlogIOwn()
    {
        $factory = new BlogFactory();
        $blog    = $factory->create($this->owner);
        $this->repository->save($blog);

        $this->blogId = $blog->getId();
    }

    /**
     * @When I add a new post with title :title
     */
    public function iAddANewPostWithTitleAndContent($title)
    {
        $blog    = $this->repository->find($this->blogId);
        $factory = new ArticleFactory(new DoctrineInflectorSlugifier());
        $post    = $factory->create($blog, new Title($title), new NullContent());
        $this->repository->save($blog);

        $this->slug = $post->getSlug();
    }

    /**
     * @Then the new post should be added to my blog
     */
    public function theNewPostShouldBeAddedToMyBlog()
    {
        $blog = $this->repository->find($this->blogId);

        if (!$blog->hasPost($this->slug)) {
            return \Behat\Testwork\Tester\Result\TestResult::FAILED;
        }
    }
}

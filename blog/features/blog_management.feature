Feature: Blog management
    In order to manage my blog
    As a registered user
    I need to be able to create and edit posts on my blog

    @ui
    Scenario: Creating a new blog post
        Given there is a blog I own
        When I add a new post with title "My first blog post"
        Then the new post should be added to my blog
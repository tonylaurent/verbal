About
-----

Verbal is the blog engine for command lines addicts.

Getting started
---------------

First, create a tag to categorize your post:

    $ verbal tag:add "Foo" --description="This is my first tag"

Write your first post:

    $ verbal post:add "My first post" --tag="Foo" --content="# Hello world!"

With a multi lines content:

    $ verbal post:add "My first post" --content="
    > # Hello world!
    > This is the first paragraph.
    >
    > This is the second paragraph.
    > "

Usage
-----

- [Posts](#posts)
    - [Browse all posts](#browse-all-posts)
    - [Add a new post](#add-a-new-post)
- [Tags](#tags)
    - [Browse all tags](#browse-all-tags)
    - [Read an exising tag](#read-an-exising-tag)
    - [Edit an exising tag](#edit-an-exising-tag)
    - [Add a new tag](#add-a-new-tag)
    - [Delete an exising tag](#delete-an-exising-tag)

### Posts ###

#### Browse all posts

    $ verbal post:browse [OPTIONS]

_Options_
`--show=COLUMN` Show the specified column (multiple values allowed)
`--hide=COLUMN` Hide the specified column (multiple values allowed)
`--sort=COLUMN` Sort by the specified column
`--reverse` Reverse sort order

#### Add a new post

    $ verbal tag:add TITLE [OPTIONS]

_Arguments_
`TITLE` The title of the post

_Options_
`--summary=SUMMARY` Set a short description of the post
`--content=CONTENT` Set content of the post in markdown format
`--content-path=PATH` Get markdown content from a file
`--image-path=PATH` Set an image for the post
`--tag=tag` Categorize the post with a tag name (multiple values allowed)

### Tags ###

> Tags allow to categorize posts.

#### Browse all tags

    $ verbal tag:browse [OPTIONS]

_Options_
`--show=COLUMN` Show the specified column (multiple values allowed)
`--hide=COLUMN` Hide the specified column (multiple values allowed)
`--sort=COLUMN` Sort by the specified column
`--reverse` Reverse sort order

#### Read an existing tag

    $ verbal tag:read ID

_Arguments_
`ID` The ID of the tag

#### Edit an existing tag

    $ verbal tag:edit ID [OPTIONS]

_Arguments_
`ID` The ID of the tag

_Options_
`--name[=NAME]` The name of the tag
`--description[=DESCRIPTION]` The description of the tag

#### Add a new tag

    $ verbal tag:add NAME [OPTIONS]

_Arguments_
`NAME` The name of the tag

_Options_
`--description[=DESCRIPTION]` The description of the tag

#### Delete an existing tag

    $ verbal tag:delete ID [OPTIONS]

_Arguments_
`ID` The ID of the tag

_Options_
`--force` Skip confirmation



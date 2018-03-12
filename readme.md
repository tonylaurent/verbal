About
-----

Verbal is the blog engine for command lines addicts.

Getting started
---------------

Create your first post

    $ verbal post:add "My first post"--content="
    > # Hello world!
    > This is my first paragraph.
    >
    > This is my second paragraph.
    > "

Documentation
-------------

- [Posts](#posts)
    - [Browse all posts](#browse-all-posts)
    - [Add a new post](#add-a-new-post)
- [Tags](#tags)
    - [Browse all tags](#browse-all-tags)
    - [Read an exising tag](#read-an-exising-tag)
    - [Edit an exising tag](#edit-an-exising-tag)
    - [Add a new tag](#add-a-new-tag)
    - [Delete an exising tag](#delete-an-exising-tag)

### Posts

#### Browse all posts

    $ verbal post:browse [OPTIONS]

_Options_
`--show=COLUMN` Show the specified column (multiple values allowed)
`--hide=COLUMN` Hide the specified column (multiple values allowed)
`--sort=COLUMN` Sort by the specified column
`--reverse` Reverse sort order

### Tags

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



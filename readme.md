About
-----

Verbal is the blog engine for command lines addicts.

Getting started
---------------

Write your first post (the content must be in markdown format):

    $ verbal post:add "My first post" --summary="This is my first post" --content="# Hello world!"

If you need a multi-line content, type enter after the double quote:

    $ verbal post:add "My first post" --summary="This is my first post" --content="
    > # Hello world!
    > This is the first paragraph.
    >
    > This is the second paragraph.
    > "

You can custom the post date instead of use the current timestamp:

    $ verbal post:add "My first post" --datetime="2018-01-01 12:30:00"

Set an image path to illustrate your post:

    $ verbal post:add "My first post" --image="/home/tony/picture.png"

Create a tag to categorize your post:

    $ verbal tag:add "Foo" --description="This is my first tag"


Usage
-----

- [Posts](#posts)
    - [Add a new post](#add-a-new-post)
    - [Browse all posts](#browse-all-posts)
    - [Read an existing post](#add-an-existing-post)
    - [Edit an existing post](#edit-an-existing-post)
    - [Delete an existing post](#delete-an-existing-post)
- [Tags](#tags)
    - [Add a new tag](#add-a-new-tag)
    - [Browse all tags](#browse-all-tags)
    - [Read an existing tag](#read-an-exising-tag)
    - [Edit an existing tag](#edit-an-exising-tag)
    - [Delete an existing tag](#delete-an-exising-tag)

### Posts ###

#### Add a new post

    $ verbal post:add TITLE [OPTIONS]

_Arguments_  
`"TITLE"` The title of the post  

_Options_  
`--summary="SUMMARY"` Set a short description of the post  
`--content="CONTENT"` Set a content of the post in markdown format  
`--date="YYYY-MM-DD MM:HH:SS"` Set a date for the post  
`--image="PATH"` Set an image for the post  
`--tag="TAG"` Categorize the post with a tag name (multiple values allowed)  

#### Browse all posts

    $ verbal post:browse [OPTIONS]

_Options_  
`--show=COLUMN` Show the specified column (multiple values allowed)  
`--hide=COLUMN` Hide the specified column (multiple values allowed)  
`--sort=COLUMN` Sort by the specified column  
`--reverse` Reverse sort order  

#### Read an existing post

    $ verbal post:read ID

_Arguments_  
`ID` The ID of the post  

#### Edit an existing post

    $ verbal post:edit ID [OPTIONS]

_Arguments_  
`ID` The ID of the post  

_Options_  
`--title[=TITLE]` The title of the post    
`--summary[=SUMMARY]` The summary of the post  
`--image-path=PATH` Set an image for the post  
`--tag=tag` Categorize the post with a tag name (multiple values allowed)  

#### Delete an existing post

    $ verbal post:delete ID [OPTIONS]

_Arguments_  
`ID` The ID of the post  

_Options_  
`--force` Skip confirmation  

### Tags ###

> Tags allow to categorize posts.

#### Add a new tag

    $ verbal tag:add NAME [OPTIONS]

_Arguments_  
`NAME` The name of the tag  

_Options_  
`--description[=DESCRIPTION]` The description of the tag  

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

#### Delete an existing tag

    $ verbal tag:delete ID [OPTIONS]

_Arguments_  
`ID` The ID of the tag  

_Options_  
`--force` Skip confirmation  

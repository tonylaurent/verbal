About
-----

Verbal is the blog engine for command lines addicts.

Getting started
---------------

Write your first post (the content must be in markdown format):

    $ verbal post:add "My first post" --summary="This is my first post" --content="# Hello world!"

If you need a multi-line content, type enter after the first double quote and finish with an other double quote:

    $ verbal post:add "My first post" --summary="This is my first post" --content="
    > # Hello world!
    > This is the first paragraph.
    >
    > This is the second paragraph.
    > "

You can custom the post datetime instead of use the default current timestamp:

    $ verbal post:add "My first post" --datetime="2018-01-01 12:30:00"

Add an image to illustrate your post:

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
`"TITLE"` The title of the post to add  

_Options_  
`--summary="SUMMARY"` Set the post’s summary  
`--content="CONTENT"` Set the post’s content (markdown format)  
`--datetime="YYYY-MM-DD MM:HH:SS"` Set the post’s datetime  
`--image="PATH"` Set the post’s image  
`--tag="TAG"` Categorize the post with a tag name (multiple values allowed)  

#### Browse all posts

    $ verbal post:browse [OPTIONS]

_Options_  
`--show="COLUMN"` Show the specified column (multiple values allowed)  
`--hide="COLUMN"` Hide the specified column (multiple values allowed)  
`--sort="COLUMN"` Sort by the specified column  
`--reverse` Reverse sort order  

#### Read an existing post

    $ verbal post:read ID

_Arguments_  
`ID` The ID of the post to read  

#### Edit an existing post

    $ verbal post:edit ID [OPTIONS]

_Arguments_  
`ID` The ID of the post to edit

_Options_  
`--title="TITLE"` Change the post’s title  
`--summary="SUMMARY"` Change the post’s summary  
`--content="CONTENT"` Change the post’s content (markdown format)  
`--datetime="YYYY-MM-DD MM:HH:SS"` Change the post’s datetime  
`--image="PATH"` Change the post’s image  
`--tag="NAME"` Categorize the post with a tag (multiple values allowed)  

#### Delete an existing post

    $ verbal post:delete ID [OPTIONS]

_Arguments_  
`ID` The ID of the post to delete  

_Options_  
`--force` Skip confirmation  

### Tags ###

> Tags allow to categorize posts.

#### Add a new tag

    $ verbal tag:add NAME [OPTIONS]

_Arguments_  
`"NAME"` The name of the tag to add    

_Options_  
`--description="DESCRIPTION"` Set the tag’s description  

#### Browse all tags

    $ verbal tag:browse [OPTIONS]

_Options_  
`--show="COLUMN"` Show the specified column (multiple values allowed)  
`--hide="COLUMN"` Hide the specified column (multiple values allowed)  
`--sort="COLUMN"` Sort by the specified column  
`--reverse` Reverse sort order  

#### Read an existing tag

    $ verbal tag:read ID

_Arguments_  
`ID` The ID of the tag to read  

#### Edit an existing tag

    $ verbal tag:edit ID [OPTIONS]

_Arguments_  
`ID` The ID of the tag to edit   

_Options_  
`--name="NAME"` Change the tag’s name  
`--description="DESCRIPTION"` Change the tag’s description  

#### Delete an existing tag

    $ verbal tag:delete ID [OPTIONS]

_Arguments_  
`ID` The ID of the tag to delete  

_Options_  
`--force` Skip confirmation  

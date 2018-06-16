[![Build Status](https://travis-ci.org/tonylaurent/verbal.svg?branch=master)](https://travis-ci.org/tonylaurent/verbal)

About
-----

Verbal is the blog engine for command lines addicts.

![Verbal](verbal.png?raw=true)

Requirements
------------

Verbal is built on Laravel and use SQLite as embedded database: 

- PHP >= 7.0.0
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- SQLite 3

Installation
------------

Create your blog project with Composer:

    composer create-project --prefer-dist tonylaurent/verbal blog dev-master
    
Start the built-in server and go to http://localhost:8000 (only for testing):

    php artisan serve

Getting started
---------------

First, create a tag to categorize your post:

    $ php artisan tag:add "Foo" --description="This is my first tag"

Write your first post (the content must be in markdown format):

    $ php artisan post:add "My first post" --tag="Foo" --summary="This is my first post" --content="# Hello world!"

If you need a multi-line content, type enter after the first double quote and finish with an other double quote:

    $ php artisan post:add "My first post" --tag="Foo" --summary="This is my first post" --content="
    > # Hello world!
    > This is the first paragraph.
    >
    > This is the second paragraph.
    > "

You can custom the post datetime instead of use the default current timestamp:

    $ php artisan post:add "My first post" --datetime="2018-01-01 12:30:00"

Maybe need a picture to illustrate your post?

    $ php artisan post:add "My first post" --image="/home/tony/picture.png"

Usage
-----

- [Posts](#posts)
    - [Add a new post](#add-a-new-post)
    - [Browse all posts](#browse-all-posts)
    - [Read an existing post](#add-an-existing-post)
    - [Edit an existing post](#edit-an-existing-post)
    - [Delete an existing post](#delete-an-existing-post)
    - [Tag an existing post](#tag-an-existing-post)
    - [Untag an existing post](#untag-an-existing-post)
- [Tags](#tags)
    - [Add a new tag](#add-a-new-tag)
    - [Browse all tags](#browse-all-tags)
    - [Read an existing tag](#read-an-exising-tag)
    - [Edit an existing tag](#edit-an-exising-tag)
    - [Delete an existing tag](#delete-an-exising-tag)

### Posts ###

#### Add a new post

    $ php artisan post:add TITLE [OPTIONS]

_Arguments_  
`"TITLE"` The title of the post to add  

_Options_  
`--summary="SUMMARY"` Set the post’s summary  
`--content="CONTENT"` Set the post’s content (markdown format)  
`--datetime="YYYY-MM-DD MM:HH:SS"` Set the post’s datetime  
`--image="PATH"` Set the post’s image  
`--tag="NAME"` Categorize the post with a tag name (multiple values allowed)  

#### Browse all posts

    $ php artisan post:browse [OPTIONS]

_Options_  
`--show="COLUMN"` Show the specified column (multiple values allowed)  
`--hide="COLUMN"` Hide the specified column (multiple values allowed)  
`--sort="COLUMN"` Sort by the specified column  
`--reverse` Reverse sort order  

#### Read an existing post

    $ php artisan post:read ID

_Arguments_  
`ID` The ID of the post to read  

#### Edit an existing post

    $ php artisan post:edit ID [OPTIONS]

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

    $ php artisan post:delete ID [OPTIONS]

_Arguments_  
`ID` The ID of the post to delete  

_Options_  
`--force` Skip confirmation  

#### Tag an existing post

    $ php artisan post:tag ID [OPTIONS]

_Arguments_  
`ID` The ID of the post to tag  

_Options_  
`--tag="NAME"` The tag’s name to add (multiple values allowed)  

#### Untag an existing post

    $ php artisan post:untag ID [OPTIONS]

_Arguments_  
`ID` The ID of the post to untag  

_Options_  
`--tag="NAME"` The tag’s name to remove (multiple values allowed)   

### Tags ###

#### Add a new tag

    $ php artisan tag:add NAME [OPTIONS]

_Arguments_  
`"NAME"` The name of the tag to add    

_Options_  
`--description="DESCRIPTION"` Set the tag’s description  

#### Browse all tags

    $ php artisan tag:browse [OPTIONS]

_Options_  
`--show="COLUMN"` Show the specified column (multiple values allowed)  
`--hide="COLUMN"` Hide the specified column (multiple values allowed)  
`--sort="COLUMN"` Sort by the specified column  
`--reverse` Reverse sort order  

#### Read an existing tag

    $ php artisan tag:read ID

_Arguments_  
`ID` The ID of the tag to read  

#### Edit an existing tag

    $ php artisan tag:edit ID [OPTIONS]

_Arguments_  
`ID` The ID of the tag to edit   

_Options_  
`--name="NAME"` Change the tag’s name  
`--description="DESCRIPTION"` Change the tag’s description  

#### Delete an existing tag

    $ php artisan tag:delete ID [OPTIONS]

_Arguments_  
`ID` The ID of the tag to delete  

_Options_  
`--force` Skip confirmation  

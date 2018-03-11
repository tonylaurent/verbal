About
-----

Verbal is the blog engine for command lines addicts.

Usage
-----

### Tags

> Tags allow to categorize posts.

#### Browse all tags

    $ verbal tag:browse [OPTIONS]

_Options_  
`--show=COLUMN` Show the specified column (multiple values allowed)  
`--hide=COLUMN` Hide the specified column (multiple values allowed)  
`--sort=COLUMN` Sort by the specified column  
`--reverse` Reverse sort order  

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
`-f, --force` Skip confirmation  



About
-----

Verbal is the blog engine for command lines addicts.

Usage
-----

### Tags

>Tags categorize yours contents.

**Browse all tags:**

    verbal tag:browse [OPTIONS]

    --show=COLUMN   Show the specified column (multiple values allowed)
    --hide=COLUMN   Hide the specified column (multiple values allowed)
    --sort=COLUMN   Sort by the specified column
    --reverse       Reverse sort order

**Add a new tag:**

    verbal tag:add [OPTIONS]

    -i, --interactive           Enable interactive mode
    --name[=NAME]               The name of the tag
    --description[=DESCRIPTION] The description of the tag


**Delete a tag with:**

    tag:delete ID [OPTIONS]

    Arguments:
    id

    Options:
    -f, --force   Skip confirmation



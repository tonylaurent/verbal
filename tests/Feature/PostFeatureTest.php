<?php
namespace Tests\Feature;

use Tests\TestCase;

use App\Post;

/**
 * Class PostFeatureTest.
 * 
 * @author Tony Laurent <contact@tony-laurent.com>
 */
class PostFeatureTest extends TestCase
{
    /**
     * Test post add.
     *
     * @return void
     */
    public function testAdd()
    {
        $output = shell_exec('
            php artisan post:add foo \
                --summary="foo bar" \
                --content="foo bar baz" \
                --datetime="1970-01-01 12:30:15" \
                --image="' . resource_path() . '/tests/blue.png"
        ');
        
        $this->assertRegExp('/Post added./', $output);     
    }

    /**
     * Test post add with a missing title.
     *
     * @return void
     */
    public function testAddWithMissingTitle()
    {
        $output = shell_exec('php artisan post:add');
        
        $this->assertRegExp(
            '/Not enough arguments \(missing: "title"\)./', 
            $output
        );     
    }
    
    /**
     * Test post add with invalid datetime.
     *
     * @return void
     */
    public function testAddWithInvalidDatetime()
    {
        $output = shell_exec(
            'php artisan post:add foo --datetime="01/01/2000 12h30"'
        );
        
        $this->assertRegExp(
            '/The datetime does not match the format yyyy-mm-dd hh:mm:ss./', 
            $output
        );     
    }    
    
    /**
     * Test post add with image not found.
     *
     * @return void
     */
    public function testAddWithImageNotFound()
    {
        $output = shell_exec('
            php artisan post:add foo \
                --image="' . resource_path() . '/tests/foo.png"
        ');
        
        $this->assertRegExp('/Image not found./',  $output);     
    }    
    
    /**
     * Test post browse.
     *
     * @return void
     */
    public function testBrowse()
    {
        $output = shell_exec("php artisan post:browse");
        
        $this->assertRegExp("/\| id/", $output);
        $this->assertRegExp("/\| title/", $output);        
    }

    /**
     * Test post browse with hidden column.
     *
     * @return void
     */
    public function testBrowseWithHiddenColumn()
    {
        $output = shell_exec('php artisan post:browse --hide="title"');
        
        $this->assertRegExp("/\| id/", $output);
        $this->assertNotRegExp("/\| title/", $output);
    }

    /**
     * Test post browse with shown column.
     *
     * @return void
     */
    public function testBrowseWithShownColumn()
    {
        $output = shell_exec('php artisan post:browse --show="title"');
        
        $this->assertNotRegExp("/\| id/", $output);
        $this->assertRegExp("/\| title/", $output);
    }

    /**
     * Test post read.
     *
     * @return void
     */    
    public function testRead()
    {
        $post = Post::get()->last();
        $output = shell_exec("php artisan post:read {$post->id}");
        
        $this->assertRegExp("/title: {$post->title}/", $output);
    }
    
    /**
     * Test post read not found.
     *
     * @return void
     */    
    public function testReadNotFound()
    {
        $output = shell_exec("php artisan post:read 0");
        
        $this->assertRegExp("/Post not found./", $output);
    }
    
    /**
     * Test post edit.
     *
     * @return void
     */    
    public function testEdit()
    {
        $post = Post::get()->last();
        
        $output = shell_exec('
            php artisan post:edit ' . $post->id . ' \
                --title=bar \
                --summary="bar baz" \
                --content="bar baz qux" \
                --datetime="1970-12-31 18:15:06" \
                --image="' . resource_path() . '/tests/red.png"
        ');

        $this->assertRegExp('/Post updated./', $output);
    }
    
    /**
     * Test post edit not found.
     *
     * @return void
     */    
    public function testEditNotFound()
    {
        $output = shell_exec("php artisan post:edit 0");
        
        $this->assertRegExp("/Post not found./", $output);
    }    

    /**
     * Test post delete.
     *
     * @return void
     */    
    public function testDelete()
    {
        $post = Post::get()->last();
        
        $output = shell_exec("
            php artisan post:delete {$post->id} --force"
        );

        $this->assertRegExp("/Post deleted./", $output);     
    }
    
    /**
     * Test post delete not found.
     *
     * @return void
     */    
    public function testDeleteNotFound()
    {
        $output = shell_exec("php artisan post:delete 0");
        
        $this->assertRegExp("/Post not found./", $output);
    }        
}

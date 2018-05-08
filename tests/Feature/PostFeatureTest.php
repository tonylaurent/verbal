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
    public function testAdd(): void
    {
        $output = shell_exec('
            php artisan post:add foo \
                --summary="foo bar" \
                --content="foo bar baz" \
                --datetime="1970-01-01 12:30:15" \
                --image="' . resource_path() . '/tests/blue.png"
        ');
        
        $this->assertRegExp('/"title": "foo"/', $output);     
        $this->assertRegExp('/"summary": "foo bar"/', $output);
        $this->assertRegExp('/"content": "foo bar baz"/', $output);
        $this->assertRegExp('/"datetime": "1970-01-01 12:30:15"/', $output);
        $this->assertRegExp('/"image": "(.*).png"/', $output);
    }

    /**
     * Test post add with a missing title.
     *
     * @return void
     */
    public function testAddWithMissingTitle(): void
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
    public function testAddWithInvalidDatetime(): void
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
    public function testAddWithImageNotFound(): void
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
    public function testBrowse(): void
    {
        $output = shell_exec("php artisan post:browse");
        
        $this->assertRegExp("/foo/", $output);
    }

    /**
     * Test post read.
     *
     * @return void
     */    
    public function testRead(): void
    {
        $post = Post::get()->last();
        $output = shell_exec("php artisan post:read {$post->id}");
        
        $this->assertRegExp("/\"title\": \"{$post->title}\"/", $output);        
    }
    
    /**
     * Test post edit.
     *
     * @return void
     */    
    public function testEdit(): void
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

        $this->assertRegExp('/"title": "bar"/', $output);     
        $this->assertRegExp('/"summary": "bar baz"/', $output);         
        $this->assertRegExp('/"content": "bar baz qux"/', $output);         
        $this->assertRegExp('/"datetime": "1970-12-31 18:15:06"/', $output);
        $this->assertRegExp('/"image": "(.*).png"/', $output);    
    }

    /**
     * Test post delete.
     *
     * @return void
     */    
    public function testDelete(): void
    {
        $post = Post::get()->last();
        
        $output = shell_exec("
            php artisan post:delete {$post->id} --force"
        );

        $this->assertRegExp("/\"title\": \"{$post->title}\"/", $output);     
    }
}

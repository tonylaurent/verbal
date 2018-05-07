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
        $output = shell_exec('php artisan post:add foo --summary="foo bar" --content="foo bar baz"');
        
        $this->assertRegExp('/"title": "foo"/', $output);     
        $this->assertRegExp('/"summary": "foo bar"/', $output);
        $this->assertRegExp('/"content": "foo bar baz"/', $output);
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
        $output = shell_exec("php artisan post:edit {$post->id} --title=bar --summary='bar baz' --content='bar baz qux'");

        $this->assertRegExp('/"title": "bar"/', $output);     
        $this->assertRegExp('/"summary": "bar baz"/', $output);         
        $this->assertRegExp('/"content": "bar baz qux"/', $output);         
    }

    /**
     * Test post delete.
     *
     * @return void
     */    
    public function testDelete(): void
    {
        $post = Post::get()->last();
        $output = shell_exec("php artisan post:delete {$post->id} --force");

        $this->assertRegExp("/\"title\": \"{$post->title}\"/", $output);     
    }
}

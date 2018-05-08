<?php
namespace Tests\Feature;

use Tests\TestCase;

use App\Tag;

/**
 * Class TagFeatureTest.
 * 
 * @author Tony Laurent <contact@tony-laurent.com>
 */
class TagFeatureTest extends TestCase
{
    /**
     * Test tag add.
     *
     * @return void
     */
    public function testAdd(): void
    {
        $output = shell_exec('php artisan tag:add foo --description="foo bar"');
        
        $this->assertRegExp('/"name": "foo"/', $output);     
        $this->assertRegExp('/"description": "foo bar"/', $output);     
    }
    
    /**
     * Test tag browse.
     *
     * @return void
     */
    public function testBrowse(): void
    {
        $output = shell_exec("php artisan tag:browse");
        
        $this->assertRegExp("/foo/", $output);
    }

    /**
     * Test tag read.
     *
     * @return void
     */    
    public function testRead(): void
    {
        $tag = Tag::get()->last();
        $output = shell_exec("php artisan tag:read {$tag->id}");
        
        $this->assertRegExp("/\"name\": \"{$tag->name}\"/", $output);        
    }
    
    /**
     * Test tag edit.
     *
     * @return void
     */    
    public function testEdit(): void
    {
        $tag = Tag::get()->last();
        $output = shell_exec("php artisan tag:edit {$tag->id} --name=bar --description='bar baz'");

        $this->assertRegExp('/"name": "bar"/', $output);     
        $this->assertRegExp('/"description": "bar baz"/', $output);         
    }

    /**
     * Test tag delete.
     *
     * @return void
     */    
    public function testDelete(): void
    {
        $tag = Tag::get()->last();
        $output = shell_exec("php artisan tag:delete {$tag->id} --force");

        $this->assertRegExp("/\"name\": \"{$tag->name}\"/", $output);     
    }
}
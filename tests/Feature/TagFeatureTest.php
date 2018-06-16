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
    public function testAdd()
    {
        $output = shell_exec('php artisan tag:add foo --description="foo bar"');
        
        $this->assertRegExp('/Tag added./', $output);     
    }
    
    /**
     * Test tag browse.
     *
     * @return void
     */
    public function testBrowse()
    {
        $output = shell_exec("php artisan tag:browse");
        
        $this->assertRegExp("/\| id/", $output);
        $this->assertRegExp("/\| name/", $output);
    }

    /**
     * Test tag browse with hidden column.
     *
     * @return void
     */
    public function testBrowseWithHiddenColumn()
    {
        $output = shell_exec('php artisan tag:browse --hide="name"');
        
        $this->assertRegExp("/\| id/", $output);
        $this->assertNotRegExp("/\| name/", $output);
    }

    /**
     * Test tag browse with shown column.
     *
     * @return void
     */
    public function testBrowseWithShownColumn()
    {
        $output = shell_exec('php artisan tag:browse --show="name"');
        
        $this->assertNotRegExp("/\| id/", $output);
        $this->assertRegExp("/\| name/", $output);
    }

    /**
     * Test tag read.
     *
     * @return void
     */    
    public function testRead()
    {
        $tag = Tag::get()->last();
        $output = shell_exec("php artisan tag:read {$tag->id}");
        
        $this->assertRegExp("/name: {$tag->name}/", $output);        
    }
    
    /**
     * Test tag read not found.
     *
     * @return void
     */    
    public function testReadNotFound()
    {
        $output = shell_exec("php artisan tag:read 0");
        
        $this->assertRegExp("/Tag not found./", $output);
    }    
    
    /**
     * Test tag edit.
     *
     * @return void
     */    
    public function testEdit()
    {
        $tag = Tag::get()->last();
        $output = shell_exec("php artisan tag:edit {$tag->id} --name=bar --description='bar baz'");

        $this->assertRegExp('/Tag updated./', $output);     
    }

    /**
     * Test post edit not found.
     *
     * @return void
     */    
    public function testEditNotFound()
    {
        $output = shell_exec("php artisan tag:edit 0");
        
        $this->assertRegExp("/Tag not found./", $output);
    }

    /**
     * Test tag delete.
     *
     * @return void
     */    
    public function testDelete()
    {
        $tag = Tag::get()->last();
        $output = shell_exec("php artisan tag:delete {$tag->id} --force");

        $this->assertRegExp("/Tag deleted./", $output);     
    }
    
    /**
     * Test post delete not found.
     *
     * @return void
     */    
    public function testDeleteNotFound()
    {
        $output = shell_exec("php artisan tag:delete 0");
        
        $this->assertRegExp("/Tag not found./", $output);
    }    
}

<?php

namespace Tests\Unit;

use App\Models\Category;
use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;


class CategoryTest extends TestCase
{
    use RefreshDatabase;


    /**
     * Test retrieving all categories.
     *
     * @return void
     */

    public function test_getCategories()
    {
        $response = $this->get('/api/category');
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/xml; charset=UTF-8');
    }


    /**
     * Test retrieving a specific category by ID.
     *
     * @return void
     */
    public function test_getCategoryWithId()
    {
        $category = Category::create([
            'name' => 'sampleTestingCategory'
        ]);
        $response = $this->get('/api/category/' . $category->id);
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/xml; charset=UTF-8');
    }

    /**
     * Test creating a new category.
     *
     * @return void
     */
    public function test_addCategory()
    {
        $category = Category::make([
            'name' => 'parentCategory'
        ]);
        $category2 = Category::make([
            'name' => 'parentCategory'
        ]);

        $category->save();
        $this->get('/api/category/' . $category->id);
        self::assertTrue($category->count() == 1);
        self::assertFalse($category2->exists);
    }

    /**
     * Test updating an existing category.
     *
     * @return void
     */
    public function test_modifyCategory()
    {
        $oldCategory = Category::make([
            'name' => 'parentCategory'
        ]);
        $oldCategory->save();

        $oldCategory->name = 'updatedCategory';
        $oldCategory->save();

        // apply assertion
        $updated = Category::where('name', 'updatedCategory')->get();
        $olderParentCategory = Category::where('name', 'parentCategory')->get();

        self::assertCount(1,$updated);
        self::assertCount(0,$olderParentCategory);
    }

    /**
     * Test deleting a category.
     *
     * @return void
     */
    public function test_removeCategory(){
        $category = Category::create(['name'=>'sample category']);

        $response = $this->delete('/api/category/'.$category->id);
        $response->assertStatus(200);
        $response->assertHeader('Content-Type','text/xml; charset=UTF-8');
    }

}

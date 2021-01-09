<?php

namespace Tests\Unit\Http\Requests\Order;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @see \App\Http\Requests\Order\UpdateRequest
 */
class UpdateRequestTest extends TestCase
{
    /** @var \App\Http\Requests\Order\UpdateRequest */
    private $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new \App\Http\Requests\Order\UpdateRequest();
    }

    /**
     * @test
     */
    public function authorize()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $actual = $this->subject->authorize();

        $this->assertTrue($actual);
    }

    /**
     * @test
     */
    public function rules()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $actual = $this->subject->rules();

        $this->assertValidationRules([
            'shipping_number' => [
                'sometimes',
            ],
            'status_code' => [
                'sometimes',
            ],
            'packer_user_id' => [
                'sometimes',
                'integer',
                'exists:users,id',
            ],
            'is_packed' => [
                'sometimes',
                'boolean',
            ],
        ], $actual);
    }

    // test cases...
}

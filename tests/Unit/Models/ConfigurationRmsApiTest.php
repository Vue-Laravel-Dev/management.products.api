<?php

namespace Tests\Unit\Models;

use Tests\TestCase;

use App\Models\RmsApiConnection;

class ConfigurationRmsApiTest extends TestCase
{
    public function test_encrypts_password()
    {
        $config = new RmsApiConnection();
        $config->password = 'foo';

        // Tests that that password is encrypted before saving to the database.
        $this->assertNotEquals('foo', $config->password);
        // Make sure we can reuse the password when needed.
        $this->assertEquals('foo', \Crypt::decryptString($config->password));
    }
}

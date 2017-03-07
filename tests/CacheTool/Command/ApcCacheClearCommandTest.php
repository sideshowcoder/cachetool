<?php

namespace CacheTool\Command;

class ApcCacheClearCommandTest extends CommandTest
{
    public function testCommand()
    {
        if (explode('.', PHP_VERSION_ID)[0] >= 7) {
            $this->markTestSkipped('Skip APC test w/ php7');
        }
        $this->assertHasApc();

        $result = $this->runCommand('apc:cache:clear all -v');

        $this->assertContains('apc_clear_cache("user")', $result);
        $this->assertContains('apc_clear_cache("all")', $result);
    }

    public function testCommandUser()
    {
        if (explode('.', PHP_VERSION_ID)[0] >= 7) {
            $this->markTestSkipped('Skip APC test w/ php7');
        }
        $this->assertHasApc();

        $result = $this->runCommand('apc:cache:clear user -v');

        $this->assertContains('apc_clear_cache("user")', $result);
    }

    public function testException()
    {
        if (explode('.', PHP_VERSION_ID)[0] >= 7) {
            $this->markTestSkipped('Skip APC test w/ php7');
        }
        $this->assertHasApc();

        $result = $this->runCommand('apc:cache:clear err -v');

        $this->assertContains('type argument must be user, system or all', $result);
    }
}

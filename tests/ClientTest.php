<?php

declare(strict_types=1);

/*
 * This file is part of eelly package.
 *
 * (c) eelly.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eelly\FastDFS;

use PHPUnit\Framework\TestCase;

/**
 * @author hehui<hehui@eelly.net>
 */
class ClientTest extends TestCase
{
    /**
     * @var string
     */
    private $testFile;

    /**
     * @var Client
     */
    private $client;

    public function setUp(): void
    {
        $this->testFile = __DIR__.'/resources/test.jpg';
        $this->client = new Client([
            'host'  => '172.18.107.97',
            'port'  => 22122,
            'group' => [
                'G01',
                'G02',
            ],
        ]);
    }

    public function testUploadFile(): void
    {
        $result = $this->client->uploadFile($this->testFile);
        $this->assertStringStartsWith('G', $result);
    }

    public function testDeleteFile(): void
    {
        $filename = $this->client->uploadFile($this->testFile);
        $result = $this->client->deleteFile($filename);
        $this->assertTrue($result);
    }
}

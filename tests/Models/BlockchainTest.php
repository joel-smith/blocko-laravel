<?php

namespace Tests\Models;

use App\BlockchainService;
use App\Models\Block;
use App\Models\Blockchain;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class BlockchainTest extends TestCase
{
use DatabaseMigrations;

protected BlockchainService $service;

public function setUp(): void
{
    parent::setUp();
    $this->service = new BlockchainService();
}

    public function test_it_can_create_blockchain()
    {
        $blockchain = Blockchain::factory()->create();

        $this->assertInstanceOf(Blockchain::class, $blockchain);
        $this->assertNotNull($blockchain->id);
    }

    public function test_it_can_createGenesisBlock()
    {
        $blockchain = Blockchain::factory()->create();

        $genesisBlock = $this->service->createGenesisBlock($blockchain);

        $this->assertInstanceOf(Block::class, $genesisBlock);
    }

    public function test_it_can_addBlock()
    {
        $data = 'Test Data';
        $blockchain = Blockchain::factory()->create();
        $this->service->createGenesisBlock($blockchain);
        $block = $this->service->addBlock($blockchain, $data);

        $this->assertNotNull($block);
        $this->assertEquals($data, $block->data);
    }

    public function test_it_can_check_if_Blockchain_IsValid()
    {
        $blockchain = Blockchain::factory()->create();
        $this->service->createGenesisBlock($blockchain);
        $this->service->addBlock($blockchain, 'Test Data 1');
        $this->service->addBlock($blockchain, 'Test Data 2');
        $this->assertTrue($this->service->isValid($blockchain));
    }
}

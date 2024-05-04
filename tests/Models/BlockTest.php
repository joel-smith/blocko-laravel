<?php

namespace Tests\Models;

use App\Models\Block;
use App\Models\Blockchain;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class BlockTest extends TestCase
{

    use DatabaseMigrations;

    public function test_it_can_create_block()
    {
        $block = Block::factory()->create(
            [
                'data' => 'Test Data',
                'prev_hash' => 'Test Prev Hash',
                'hash' => '',
            ]
        );

        $this->assertInstanceOf(Block::class, $block);
        $this->assertNotNull($block->id);
    }

    public function test_it_can_CalculateHash() {

    $testPreviousHash = 'Test Prev Hash';

    $block = Block::factory()->create([
            'data' => 'Test Data',
            'prev_hash' => $testPreviousHash,
            'hash' => '',
        ]);

    $block->hash = $block->calculateHash();
    $block->save();

    $expectedHash = hash('sha256', $block->id . $block->data . $testPreviousHash . $block->created_at->timestamp);

    $this->assertEquals($expectedHash, $block->calculateHash());
}

}

<?php

namespace App;

use App\Models\Block;
use App\Models\Blockchain;

class BlockchainService
{
    public function createGenesisBlock(Blockchain $blockchain): Block
    {
        $genesisBlock = Block::factory()->create([
            'blockchain_id' => $blockchain->id,
            'data' => 'Genesis Block',
            'prev_hash' => '',
            'hash' => '',
        ]);

        $genesisBlock->hash = $genesisBlock->calculateHash();
        $genesisBlock->save();

        return $genesisBlock;
    }

    public function addBlock(Blockchain $blockchain, $data)
    {
        $prevBlock = Block::where('blockchain_id', $blockchain->id)->latest()->first();

        $newBlock = Block::factory()->create([
            'blockchain_id' => $blockchain->id,
            'data' => $data,
            'prev_hash' => $prevBlock->hash,
            'hash' => '',
        ]);

        $newBlock->hash = $newBlock->calculateHash();
        $newBlock->save();
        return $newBlock;
    }


    public function isValid(Blockchain $blockchain): bool
    {
        $blocks = Block::where('blockchain_id', $blockchain->id)->get();

        $previousBlock = null;

        foreach ($blocks as $block) {
            if ($previousBlock !== null) {
                if ($block->hash !== $block->calculateHash()) {
                    return false;
                }
                if ($previousBlock->hash !== $block->prev_hash) {
                    return false;
                }
                $previousBlock = $block;
            }
        }
        return true;
    }
}

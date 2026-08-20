<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Leader;
use DOMDocument;
use DOMXPath;

class ImportLeadersCommand extends Command
{
    protected $signature = 'import:leaders';
    protected $description = 'Import leaders from info.gov.kh/structure';

    public function handle()
    {
        $this->info("Fetching structure page...");
        
        $response = Http::get('https://info.gov.kh/structure');
        
        if (!$response->successful()) {
            $this->error("Failed to fetch the page.");
            return;
        }

        $html = $response->body();
        
        $dom = new DOMDocument();
        @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
        $xpath = new DOMXPath($dom);

        // 1. Fetch Minister
        $ministerCards = $xpath->query("//div[contains(@class, 'minister-card')]");
        foreach ($ministerCards as $card) {
            $nameNode = $xpath->query(".//span[contains(@class, 'member-name')]", $card)->item(0);
            $imgNode = $xpath->query(".//img[contains(@class, 'avatar')]", $card)->item(0);
            
            $name = $nameNode ? trim($nameNode->nodeValue) : '';
            $imgUrl = $imgNode ? $imgNode->getAttribute('src') : null;
            
            if ($name) {
                $this->createLeader($name, 'minister', $imgUrl, 1);
            }
        }

        // 2. Fetch others
        $tierBlocks = $xpath->query("//div[contains(@class, 'tier-block') and not(contains(@class, 'minister-block'))]");
        
        $order = 2;
        foreach ($tierBlocks as $block) {
            $btnNode = $xpath->query(".//button[contains(@class, 'tier-label')]", $block)->item(0);
            if (!$btnNode) continue;
            
            $roleText = trim($btnNode->nodeValue);
            
            $role = '';
            if (strpos($roleText, 'អនុរដ្ឋលេខាធិការ') !== false) {
                $role = 'under_secretary_of_state';
            } elseif (strpos($roleText, 'រដ្ឋលេខាធិការ') !== false) {
                $role = 'secretary_of_state';
            } else {
                continue;
            }

            $members = $xpath->query(".//div[contains(@class, 'member-card')]", $block);
            foreach ($members as $member) {
                $nameNode = $xpath->query(".//span[contains(@class, 'member-name')]", $member)->item(0);
                $imgNode = $xpath->query(".//img[contains(@class, 'avatar')]", $member)->item(0);
                
                $name = $nameNode ? trim($nameNode->nodeValue) : '';
                $imgUrl = $imgNode ? $imgNode->getAttribute('src') : null;
                
                if ($name) {
                    $this->createLeader($name, $role, $imgUrl, $order++);
                }
            }
        }
        
        $this->info("Done importing leaders.");
    }

    private function createLeader($nameKm, $role, $imgUrl, $order)
    {
        $leader = Leader::where('name_km', $nameKm)->first();
        if (!$leader) {
            $leader = new Leader();
            $leader->name_km = $nameKm;
            $leader->name_en = $nameKm; 
        }
        
        $leader->role = $role;
        $leader->order = $order;
        
        $leader->save();
        
        $this->info("Imported: $nameKm ($role)");

        if ($imgUrl && strpos($imgUrl, 'http') === 0) {
            if ($leader->getMedia('leader_images')->count() === 0) {
                try {
                    $leader->addMediaFromUrl($imgUrl)->toMediaCollection('leader_images');
                    $this->info("  -> Added image from $imgUrl");
                } catch (\Exception $e) {
                    $this->error("  -> Failed to add image: " . $e->getMessage());
                }
            }
        }
    }
}

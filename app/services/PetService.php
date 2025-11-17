<?php

namespace App\Services;

use App\Models\Pet;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PetService
{
    public function parsePetData(string $input): array
    {
        $input = preg_replace('/\s+/', ' ', trim($input));
        
        if (preg_match('/^(.+?)\s+(.+?)\s+(.+?)\s+(.+)$/', $input, $matches)) {
            $name = strtoupper(trim($matches[1]));
            $type = strtoupper(trim($matches[2]));
            $ageInput = trim($matches[3]);
            $weightInput = trim($matches[4]);
            
            $age = $this->parseAge($ageInput);
            $weight = $this->parseWeight($weightInput);
            
            return [
                'name' => $name,
                'type' => $type,
                'age' => $age,
                'weight' => $weight,
            ];
        }
        
        throw new \Exception('Format data tidak valid. Format: NAMA JENIS USIA BERAT');
    }
    
    private function parseAge(string $ageInput): int
    {
        $ageInput = trim($ageInput);
        
        if (preg_match('/^(\d+)\s*(tahun|thn|th)$/i', $ageInput, $matches)) {
            return (int) $matches[1];
        }
        
        if (preg_match('/^(\d+)$/', $ageInput, $matches)) {
            return (int) $matches[1];
        }
        
        throw new \Exception('Format usia tidak valid');
    }
    
    private function parseWeight(string $weightInput): float
    {
        $weightInput = trim($weightInput);
        $weightInput = str_replace(',', '.', $weightInput);
        $weightInput = preg_replace('/\s*kg\s*/i', '', $weightInput);
        
        if (preg_match('/^(\d+\.?\d*)$/', $weightInput, $matches)) {
            return (float) $matches[1];
        }
        
        throw new \Exception('Format berat tidak valid');
    }
    
    public function generateCode(int $ownerId): string
    {
        $now = Carbon::now();
        $time = $now->format('Hi');
        
        $ownerPadded = str_pad($ownerId, 4, '0', STR_PAD_LEFT);
        
        $lastPet = Pet::where('owner_id', $ownerId)
            ->orderBy('id', 'desc')
            ->first();
        
        $sequence = $lastPet ? (int) substr($lastPet->code, -4) + 1 : 1;
        $sequencePadded = str_pad($sequence, 4, '0', STR_PAD_LEFT);
        
        $code = $time . $ownerPadded . $sequencePadded;
        
        while (Pet::where('code', $code)->exists()) {
            $sequence++;
            $sequencePadded = str_pad($sequence, 4, '0', STR_PAD_LEFT);
            $code = $time . $ownerPadded . $sequencePadded;
        }
        
        return $code;
    }
}

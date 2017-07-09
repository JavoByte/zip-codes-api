<?php

use Illuminate\Database\Seeder;
use App\FederalEntity;
use App\Municipality;
use App\ZipCode;
use App\SettlementType;
use App\Settlement;

class MexicoZipCodesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Read file with this headers:
        // d_codigo|d_asenta|d_tipo_asenta|D_mnpio|d_estado|d_ciudad|d_CP|c_estado|c_oficina|c_CP|c_tipo_asenta|c_mnpio|id_asenta_cpcons|d_zona|c_cve_ciudad
        $path = database_path('seeds/files').'/mexico.txt';
        if($handle = fopen($path, 'r')) {
            while($row = fgetcsv($handle, 0, '|')) {
                $zipCode = $row[0];
                $settlementName = $row[1];
                $settlementTypeName = $row[2];
                $municipalityName = $row[3];
                $entityName = $row[4];
                $localityName = $row[5];
                // row 6 unused
                $entityKey = $row[7];
                // rows 8 & 9 unused
                $settlementTypeKey = $row[10];
                $municipalityKey = $row[11];
                $settlementKey = $row[12];
                $zoneType = $row[13];
                // row 14 unused

                $entity = FederalEntity::firstOrNew([
                    'key' => $entityKey,
                ]);
                if(!$entity->exists) {
                    $entity->name = $entityName;
                    $entity->save();
                }

                $entity = FederalEntity::firstOrNew([
                    'key' => $entityKey,
                ]);
                if(!$entity->exists) {
                    $entity->name = $entityName;
                    $entity->save();
                }
                
                $municipality = Municipality::firstOrNew([
                    'key' => $municipalityKey,
                    'federal_entity_id' => $entity->id,
                ]);
                if(!$municipality->exists) {
                    $municipality->name = $municipalityName;
                    $municipality->save();
                }

                $zipCode = ZipCode::firstOrNew([
                    'zip_code' => $zipCode,
                    'municipality_id' => $municipality->id,
                ]);
                if(!$zipCode->exists) {
                    $zipCode->locality = $localityName;
                    $zipCode->save();
                }

                

                $settlement = Settlement::firstOrNew([
                    'key' => $settlementKey,
                    'zip_code_id' => $zipCode->id,
                ]);
                if(!$settlement->exists) {
                    $settlementType = SettlementType::firstOrNew([
                        'key' => $settlementTypeKey,
                    ]);
                    if(!$settlementType->exists) {
                        $settlementType->fill([
                            'name' => $settlementTypeName,
                        ]);
                        $settlementType->save();
                    }
                    $settlement->fill([
                        'name' => $settlementName,
                        'zone_type' => $zoneType,
                        'settlement_type_id' => $settlementType->id,
                    ]);
                    $settlement->save();
                }
            }
        }
    }
}

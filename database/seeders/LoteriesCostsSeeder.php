<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\LoteryCosts;
use App\Models\Lotery;

class LoteriesCostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $costsToCreate = $this->getCostsToCreate();

        $i = 1;
        foreach ($costsToCreate as $prize)
        {
            $this->command->info('Creating prize for lotery ' . $i++);

            $this->create_lotery($prize);

            $this->command->info('Success!');
        }
    }

    public function getLoteryId($initials = 'MG')
    {
        $lotery = Lotery::where('initials', $initials)->first();

        return $lotery->id;
    }

    public function costsMegasena()
    {
        $loteryId = $this->getLoteryId('MG');

        return [
            [
                'lotery_id' => $loteryId
                ,'number_matches' => 6
                ,'prize' => 5
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 7
                ,'prize' => 35
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 8
                ,'prize' => 140
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 9
                ,'prize' => 420
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 10
                ,'prize' => 1050
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 11
                ,'prize' => 2310
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 12
                ,'prize' => 4620
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 13
                ,'prize' => 8580
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 14
                ,'prize' => 15015
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 15
                ,'prize' => 25025
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 16
                ,'prize' => 40040
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 17
                ,'prize' => 61880
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 18
                ,'prize' => 92820
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 19
                ,'prize' => 135660
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 20
                ,'prize' => 193800
            ]
        ];
    }

    public function costsQuina()
    {
        $loteryId = $this->getLoteryId('QN');

        return [
            [
                'lotery_id' => $loteryId
                ,'number_matches' => 5
                ,'prize' => 2.50
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 6
                ,'prize' => 15.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 7
                ,'prize' => 52.50
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 8
                ,'prize' => 140
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 9
                ,'prize' => 315
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 10
                ,'prize' => 630
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 11
                ,'prize' => 1155
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 12
                ,'prize' => 1980
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 13
                ,'prize' => 3217.5
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 14
                ,'prize' => 5005
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 15
                ,'prize' => 7507.5
            ]
        ];
    }

    public function costsLotofacil()
    {
        $loteryId = $this->getLoteryId('LF');

        return [
            [
                'lotery_id' => $loteryId
                ,'number_matches' => 15
                ,'prize' => 3
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 16
                ,'prize' => 48.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 17
                ,'prize' => 408
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 18
                ,'prize' => 2448
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 19
                ,'prize' => 11628
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 20
                ,'prize' => 46512
            ]
        ];
    }

    public function costsDuplasena()
    {
        $loteryId = $this->getLoteryId('DS');

        return [
            [
                'lotery_id' => $loteryId
                ,'number_matches' => 6
                ,'prize' => 2.50
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 7
                ,'prize' => 17.50
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 8
                ,'prize' => 70.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 9
                ,'prize' => 210.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 10
                ,'prize' => 525.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 11
                ,'prize' => 1155.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 12
                ,'prize' => 2310.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 13
                ,'prize' => 4290.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 14
                ,'prize' => 7507.50
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 15
                ,'prize' => 12512.50
            ]
        ];
    }

    public function costsLotomania()
    {
        $loteryId = $this->getLoteryId('LM');

        return [
            [
                'lotery_id' => $loteryId
                ,'number_matches' => 50
                ,'prize' => 2.50
            ]
        ];
    }

    public function costsTimemania()
    {
        $loteryId = $this->getLoteryId('TM');

        return [
            [
                'lotery_id' => $loteryId
                ,'number_matches' => 10
                ,'prize' => 3.00
            ]
        ];
    }

    public function costsLoteca()
    {
        $loteryId = $this->getLoteryId('LC');

        return [
            [
                'lotery_id' => $loteryId
                ,'double' => 1
                ,'triple' => 0
                ,'number_matches' => 2
                ,'prize' => 3.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 2
                ,'triple' => 0
                ,'number_matches' => 4
                ,'prize' => 6.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 3
                ,'triple' => 0
                ,'number_matches' => 8
                ,'prize' => 12.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 4
                ,'triple' => 0
                ,'number_matches' => 16
                ,'prize' => 24.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 5
                ,'triple' => 0
                ,'number_matches' => 32
                ,'prize' => 48.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 6
                ,'triple' => 0
                ,'number_matches' => 64
                ,'prize' => 96.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 7
                ,'triple' => 0
                ,'number_matches' => 128
                ,'prize' => 192.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 8
                ,'triple' => 0
                ,'number_matches' => 256
                ,'prize' => 384.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 9
                ,'triple' => 0
                ,'number_matches' => 512
                ,'prize' => 768.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 0
                ,'triple' => 1
                ,'number_matches' => 3
                ,'prize' => 4.50
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 1
                ,'triple' => 1
                ,'number_matches' => 6
                ,'prize' => 9.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 2
                ,'triple' => 1
                ,'number_matches' => 12
                ,'prize' => 18.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 3
                ,'triple' => 1
                ,'number_matches' => 24
                ,'prize' => 36.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 4
                ,'triple' => 1
                ,'number_matches' => 48
                ,'prize' => 72.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 5
                ,'triple' => 1
                ,'number_matches' => 96
                ,'prize' => 144.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 6
                ,'triple' => 1
                ,'number_matches' => 192
                ,'prize' => 288.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 7
                ,'triple' => 1
                ,'number_matches' => 384
                ,'prize' => 576.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 8
                ,'triple' => 1
                ,'number_matches' => 768
                ,'prize' => 1152.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 0
                ,'triple' => 2
                ,'number_matches' => 9
                ,'prize' => 13.50
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 1
                ,'triple' => 2
                ,'number_matches' => 18
                ,'prize' => 27.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 2
                ,'triple' => 2
                ,'number_matches' => 36
                ,'prize' => 54.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 3
                ,'triple' => 2
                ,'number_matches' => 72
                ,'prize' => 108.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 4
                ,'triple' => 2
                ,'number_matches' => 144
                ,'prize' => 216.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 5
                ,'triple' => 2
                ,'number_matches' => 288
                ,'prize' => 432.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 6
                ,'triple' => 2
                ,'number_matches' => 576
                ,'prize' => 864.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 0
                ,'triple' => 3
                ,'number_matches' => 27
                ,'prize' => 40.50
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 1
                ,'triple' => 3
                ,'number_matches' => 54
                ,'prize' => 81.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 2
                ,'triple' => 3
                ,'number_matches' => 108
                ,'prize' => 162.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 3
                ,'triple' => 3
                ,'number_matches' => 216
                ,'prize' => 324.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 4
                ,'triple' => 3
                ,'number_matches' => 432
                ,'prize' => 648.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 5
                ,'triple' => 3
                ,'number_matches' => 869
                ,'prize' => 1296.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 0
                ,'triple' => 4
                ,'number_matches' => 81
                ,'prize' => 121.50
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 1
                ,'triple' => 4
                ,'number_matches' => 162
                ,'prize' => 243.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 2
                ,'triple' => 4
                ,'number_matches' => 324
                ,'prize' => 486.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 3
                ,'triple' => 4
                ,'number_matches' => 648
                ,'prize' => 972.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 0
                ,'triple' => 5
                ,'number_matches' => 243
                ,'prize' => 364.50
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 1
                ,'triple' => 5
                ,'number_matches' => 486
                ,'prize' => 729.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'double' => 0
                ,'triple' => 6
                ,'number_matches' => 729
                ,'prize' => 1093.50
            ]
        ];
    }

    public function costsFederal()
    {
        $loteryId = $this->getLoteryId('FD');

        return [
            [
                'lotery_id' => $loteryId
                ,'number_matches' => 0
                ,'prize' => 15.00
            ]
        ];
    }

    public function costsLotogol()
    {
        $loteryId = $this->getLoteryId('LG');

        return [
            [
                'lotery_id' => $loteryId
                ,'number_matches' => 1
                ,'prize' => 1.50
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 2
                ,'prize' => 3.00
            ]
            ,[
                'lotery_id' => $loteryId
                ,'number_matches' => 4
                ,'prize' => 6.00
            ]
        ];
    }

    public function getCostsToCreate()
    {
        $megasena = $this->costsMegasena();
        $quina = $this->costsQuina();
        $lotofacil = $this->costsLotofacil();
        $duplasena = $this->costsDuplasena();
        $lotomania = $this->costsLotomania();
        $timemania = $this->costsTimemania();
        $loteca = $this->costsLoteca();
        $federal = $this->costsFederal();
        $lotogol = $this->costsLotogol();

        $costsToCreate = array_merge($megasena,$quina, $lotofacil, $duplasena, $lotomania, $timemania, $loteca, $federal, $lotogol);

        return $costsToCreate;
    }

    public function create_lotery($data = [])
    {
        return LoteryCosts::create($data);
    }
}

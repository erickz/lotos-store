<div class='socialProofCt mt-5 mb-0 p-4'>
    <h2 class='ps-0 text-info3'><b>Confira alguns depoimentos sobre a {{ env('APP_NAME') }}</b></h2>

    <?php
        //Social proof demo array
        $testimonies = [
            [
                'name' => 'Adilson C.',
                'text' => 'A Lotos Online é boa para apostar com outras pessoas.',
                'rating' => 5
            ],
            [
                'name' => 'Oscar S.',
                'text' => 'Muito fácil e da pra lucrar de verdade, vale a pena!',
                'rating' => 5
            ],
            [
                'name' => 'Rosana L.',
                'text' => 'Gostei muito da forma de fazer os bolões, não consegui vender todas as cotas mas mesmo assim ganhei um dinheirinho de volta!',
                'rating' => 5
            ],
            [
                'name' => 'Cicero G.',
                'text' => 'Achei muito prático. Boa sorte a todos!',
                'rating' => 5
            ],
            [
                'name' => 'Ricardo O.',
                'text' => 'Bem fácil. ',
                'rating' => 4
            ],
        ];

        shuffle($testimonies);
    ?>
    
    <div class='d-flex d-flex-responsive justify-content-between'>
        @for($i = 0; $i < 3; $i++)
            <div class='socialProof bg-white shadow-sm rounded col mb-5'>
                <div class='iconBg'>
                    <i class='fa fa-quote-left'></i>
                </div>
                <div class='titlePerson'>
                    <b class='font-larger'>{{ $testimonies[$i]['name'] }}</b>
                </div>
                <div class='testimony mb-1'>
                    {{ $testimonies[$i]['text'] }}
                </div>
                <div class='ctStars mt-3'>
                    @for($j = 0; $j < $testimonies[$i]['rating']; $j++)
                        <i class='fa fa-star text-warning'></i>
                    @endfor
                    @for($j = 0; $j < (5-$testimonies[$i]['rating']); $j++)
                        <i class='fa fa-star text-gray'></i>
                    @endfor
                </div>
            </div>
        @endfor
    </div>
</div><!-- /socialProofCt -->
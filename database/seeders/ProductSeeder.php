<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // TODO:
        Product::create([
           'name'=> 'Gel para cabello',
           'url'=>'https://cdn-0.somosmamas.com.ar/wp-content/uploads/2020/11/Gel-para-el-cabello-13-990x826.jpg',
           'description'=>'Probando',
           'price'=>19.95,
           'stock'=>3
        ]);
        Product::create([
            'name'=> 'Crema hidratante',
            'url'=> 'https://cdn2.actitudfem.com/media/files/media/files/cremas_hidratantes_para_piel_grasa_de_marcas_dermatologicas_bio-hydratante_crema_hidratante_ponds.jpg',
            'description'=>'Probando',
            'price'=>9.95,
            'stock'=>10
         ]);

         Product::create([
            'name'=> 'Peine profesional',
            'url'=> 'https://www.tremendatienda.com/content/images/thumbs/0003817_peine-profesional-desenredante-carbon_600.jpeg',
            'description'=>'Probando',
            'price'=>16.95,
            'stock'=>15
         ]);

         Product::create([
            'name'=> 'Laca',
            'url'=> 'https://a0.soysuper.com/76c044aa72e3468303902d0fe3b3e459.1500.0.0.0.wmark.95b87553.jpg',
            'description'=>'Probando',
            'price'=>14.95,
            'stock'=>3
         ]);

         Product::create([
            'name'=> 'Mascarilla',
            'url'=> 'https://a1.soysuper.com/fd6870ab5c0ff4ce6a63b2d9c0439d16.1500.0.0.0.wmark.492403c2.jpg',
            'description'=>'Probando',
            'price'=>20,
            'stock'=>9
         ]);

         Product::create([
            'name'=> 'Secador de pelo',
            'url'=> 'https://mlstaticquic-a.akamaihd.net/secador-de-pelo-xion-profesional-2200w-se4200-dimm-D_NQ_NP_688133-MLU31242495368_062019-F.jpg',
            'description'=>'Probando',
            'price'=>129.95,
            'stock'=>5
         ]);
    }
}

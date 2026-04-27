<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create([
            'name' => 'REBOND BRAZILLIAN BOTOX',
            'description' => 'This is a premium "all-in-one" treatment that permanently straightens hair while using "Botox" nutrients to repair damage and add deep moisture.',
            'price' => '2000.00',
            'duration' => 120,
            'status' => 'active',
            'category' => 'Hair',
            'image' => 'rebond1.jpg',
        ]);

        Service::create([
            'name' => 'REBOND BOTOX COLOR',
            'description' => 'Rebond Botox Color is a premium all-in-one treatment that permanently straightens hair, repairs damage, and adds a fresh, vibrant color.',
            'price' => '2500.00',
            'duration' => 150,
            'status' => 'active',
            'category' => 'Hair',
            'image' => 'rebond2.jpg',
        ]);

        Service::create([
            'name' => 'COLOR (SHORT)',
            'description' => 'Professional hair coloring tailored specifically for shorter lengths to give you a vibrant, refreshed look.',
            'price' => '500.00',
            'duration' => 60,
            'status' => 'active',
            'category' => 'Hair',
            'image' => 'rebond3.jpg',
        ]);

        Service::create([
            'name' => 'COLOR (LONG)',
            'description' => 'A professional coloring service designed for long hair to ensure complete, even coverage and a vibrant, long-lasting shade.',
            'price' => '800.00',
            'duration' => 90,
            'status' => 'active',
            'category' => 'Hair',
            'image' => 'rebond4.jpg',
        ]);

        Service::create([
            'name' => 'COLOR BOTOX (SHORT)',
            'description' => 'Targeted, high-speed treatment for hair above the shoulders, focusing on rapid cuticle repair and color vibrancy.',
            'price' => '1100.00',
            'duration' => 90,
            'status' => 'active',
            'category' => 'Hair',
            'image' => 'rebond5.jpg',
        ]);

        Service::create([
            'name' => 'COLOR BOTOX (LONG)',
            'description' => 'Intensive, full-coverage application for hair below the shoulders ensuring even restoration and deep color penetration.',
            'price' => '1600.00',
            'duration' => 120,
            'status' => 'active',
            'category' => 'Hair',
            'image' => 'rebond6.jpg',
        ]);

        Service::create([
            'name' => 'HIGHLIGHTS (SHORT)',
            'description' => 'Restorative treatment for hair above the chin that adds bright dimension and repairs strands for a sun-kissed look.',
            'price' => '500.00',
            'duration' => 60,
            'status' => 'active',
            'category' => 'Hair',
            'image' => 'rebond7.png',
        ]);

        Service::create([
            'name' => 'HIGHLIGHTS (LONG)',
            'description' => 'Combines multi-dimensional coloring with a deep-repair treatment to give long hair vibrant depth and shine.',
            'price' => '800.00',
            'duration' => 90,
            'status' => 'active',
            'category' => 'Hair',
            'image' => 'rebond8.png',
        ]);

        Service::create([
            'name' => 'HIGHLIGHTS COLOR BOTOX',
            'description' => 'Neutralizes brassiness and adds high-gloss shine specifically to brighten lightened strands while repairing fibers.',
            'price' => '2000.00',
            'duration' => 150,
            'status' => 'active',
            'category' => 'Hair',
            'image' => 'rebond9.png',
        ]);

        Service::create([
            'name' => 'BALAYAGE BOTOX',
            'description' => 'A deep-conditioning service that enhances hand-painted gradients while intensely hydrating ends for a natural flow.',
            'price' => '3000.00',
            'duration' => 180,
            'status' => 'active',
            'category' => 'Hair',
            'image' => 'rebond10.png',
        ]);

        Service::create([
            'name' => 'BALAYAGE REBOND BOTOX',
            'description' => 'A dual-action service that permanently straightens hair while repairing hand-painted gradients for maximum sleekness.',
            'price' => '4500.00',
            'duration' => 240,
            'status' => 'active',
            'category' => 'Hair',
            'image' => 'rebond11.png',
        ]);

        Service::create([
            'name' => 'CELLOPHANE TREATMENT',
            'description' => 'A chemical-free, semi-permanent gloss that adds a protective layer of translucent color and intense shine.',
            'price' => '500.00',
            'duration' => 30,
            'status' => 'active',
            'category' => 'Hair',
            'image' => 'rebond12.png',
        ]);

        Service::create([
            'name' => 'BRAZILLIAN BOTOX TREATMENT',
            'description' => 'A heavy-duty smoothing therapy that eliminates frizz and repairs fibers for a sleek, manageable finish.',
            'price' => '800.00',
            'duration' => 60,
            'status' => 'active',
            'category' => 'Hair',
            'image' => 'rebond13.png',
        ]);

        Service::create([
            'name' => 'HIGHLIGHTS BOTOX SHORT',
            'description' => 'A targeted repair and toning service for lightened hair above the shoulders, restoring health to every strand.',
            'price' => '1100.00',
            'duration' => 90,
            'status' => 'active',
            'category' => 'Hair',
            'image' => 'rebond14.png',
        ]);

        Service::create([
            'name' => 'HIGHLIGHTS BOTOX LONG',
            'description' => 'A full-coverage restorative treatment to brighten and hydrate long, highlighted hair for a professional finish.',
            'price' => '1600.00',
            'duration' => 120,
            'status' => 'active',
            'category' => 'Hair',
            'image' => 'rebond15.png',
        ]);

        Service::create([
            'name' => 'PEDICURE/MANICURE',
            'description' => 'A manicure focuses on the hands, while a pedicure focuses on the feet. The primary goal is grooming the nails and the skin immediately surrounding them.',
            'price' => '100.00',
            'duration' => 30,
            'status' => 'active',
            'category' => 'Other',
            'image' => 'manicure1.png',
        ]);

        Service::create([
            'name' => 'FOOT SPA',
            'description' => 'A foot spa is a more intensive, therapeutic treatment than a standard pedicure. While a pedicure is about the nails, a foot spa is about the entire foot up to the ankle or calf.',
            'price' => '300.00',
            'duration' => 60,
            'status' => 'active',
            'category' => 'Other',
            'image' => 'footspa.png',
        ]);

        Service::create([
            'name' => 'RF FACE',
            'description' => 'A focused radio frequency treatment designed to tighten skin and improve facial contours for a rejuvenated look.',
            'price' => '229.00',
            'duration' => 30,
            'status' => 'active',
            'category' => 'RF',
            'image' => 'rf1.png',
        ]);

        Service::create([
            'name' => 'RF ARMS W/ CAVITATION',
            'description' => 'A targeted tightening treatment that uses heat to firm loose skin and sculpt the upper arms for a toned look.',
            'price' => '429.00',
            'duration' => 45,
            'status' => 'active',
            'category' => 'RF',
            'image' => 'rf2.png',
        ]);

        Service::create([
            'name' => 'RF TUMMY W/ CAVITATION',
            'description' => 'A non-invasive contouring service that firms the abdominal area and smooths skin for a tighter, flatter waistline.',
            'price' => '519.00',
            'duration' => 45,
            'status' => 'active',
            'category' => 'RF',
            'image' => 'rf3.png',
        ]);

        Service::create([
            'name' => 'RF LEGS W/ CAVITATION',
            'description' => 'A smoothing treatment designed to reduce the appearance of cellulite and tighten skin for firmer, more contoured legs.',
            'price' => '519.00',
            'duration' => 45,
            'status' => 'active',
            'category' => 'RF',
            'image' => 'rf4.png',
        ]);

        Service::create([
            'name' => 'MICRO SHADING',
            'description' => 'Creates a soft, powdered makeup look that adds fullness and definition to sparse eyebrows.',
            'price' => '1299.00',
            'duration' => 60,
            'status' => 'active',
            'category' => 'Eyebrows',
            'image' => 'eyebrows1.png',
        ]);

        Service::create([
            'name' => 'MICRO BLADING/OMBRE',
            'description' => 'Uses fine strokes or shading to create natural-looking hair or a trendy gradient finish.',
            'price' => '1299.00',
            'duration' => 60,
            'status' => 'active',
            'category' => 'Eyebrows',
            'image' => 'eyebrows2.png',
        ]);

        Service::create([
            'name' => 'COMBROW',
            'description' => 'The ultimate hybrid of blading and shading for maximum dimension, thickness, and a long-lasting shape.',
            'price' => '2099.00',
            'duration' => 90,
            'status' => 'active',
            'category' => 'Eyebrows',
            'image' => 'eyebrows3.png',
        ]);

        Service::create([
            'name' => 'BROWS LAMINATION',
            'description' => 'A "perm" for your brows that realigns the hair to look fuller, fluffier, and perfectly groomed.',
            'price' => '349.00',
            'duration' => 30,
            'status' => 'active',
            'category' => 'Eyebrows',
            'image' => 'eyebrows4.png',
        ]);

        Service::create([
            'name' => 'EYEBROW THREADING',
            'description' => 'A precise hair removal technique that uses a thin thread to create a clean, sharp brow arch.',
            'price' => '50.00',
            'duration' => 15,
            'status' => 'active',
            'category' => 'Eyebrows',
            'image' => 'eyebrows5.png',
        ]);

        Service::create([
            'name' => 'LIP BLUSH',
            'description' => 'A semi-permanent tint that enhances your natural lip color and shape for a soft, "just-bitten" flush.',
            'price' => '1299.00',
            'duration' => 60,
            'status' => 'active',
            'category' => 'Misc',
            'image' => 'lips.png',
        ]);

        Service::create([
            'name' => 'WARTS REMOVAL',
            'description' => 'A quick and safe procedure to effectively eliminate skin warts for a clearer, smoother complexion.',
            'price' => '199.00',
            'duration' => 15,
            'status' => 'active',
            'category' => 'Misc',
            'image' => 'wartspng.png',
        ]);

        Service::create([
            'name' => 'MESO LIPO FACE (FREE RF)',
            'description' => 'A non-surgical fat-melting injection that slims the face and jawline, paired with RF to tighten the skin.',
            'price' => '429.00',
            'duration' => 60,
            'status' => 'active',
            'category' => 'Meso',
            'image' => 'meso1.png',
        ]);

        Service::create([
            'name' => 'MESO LIPO ARMS (FREE RF)',
            'description' => 'Targets stubborn arm fat with localized injections and RF to eliminate flab and sculpt a leaner look.',
            'price' => '629.00',
            'duration' => 60,
            'status' => 'active',
            'category' => 'Meso',
            'image' => 'meso2.png',
        ]);

        Service::create([
            'name' => 'MESO LIPO TUMMY (FREE RF)',
            'description' => 'A powerful treatment to dissolve abdominal fat and tighten the stomach area for a flatter silhouette.',
            'price' => '729.00',
            'duration' => 60,
            'status' => 'active',
            'category' => 'Meso',
            'image' => 'meso3.png',
        ]);

        Service::create([
            'name' => 'MESO LIPO LEGS (FREE RF)',
            'description' => 'Specifically designed to melt fat in the thighs and calves while smoothing skin texture with RF.',
            'price' => '729.00',
            'duration' => 60,
            'status' => 'active',
            'category' => 'Meso',
            'image' => 'meso4.png',
        ]);
    }
}

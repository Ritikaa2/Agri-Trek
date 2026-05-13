<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Scheme;

class SchemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schemes = [
            [
                'title' => 'PMKSY',
                'name' => 'Pradhan Mantri Krishi Sinchayee Yojana (PMKSY)',
                'description' => 'Focuses on "Har Khet ko Pani" and improving water use efficiency "More crop per drop" by implementing micro-irrigation systems.',
                'eligibility_criteria' => 'Farmers owning irrigated or un-irrigated land.',
                'benefits' => 'Up to 55% subsidy on drip and sprinkler irrigation systems.',
                'deadline' => now()->addMonths(2)->format('Y-m-d'),
                'government_link' => 'https://pmksy.gov.in/',
                'status' => 'active',
                'max_beneficiaries' => 50000,
            ],
            [
                'title' => 'e-NAM',
                'name' => 'National Agriculture Market (e-NAM)',
                'description' => 'A pan-India electronic trading portal which networks the existing APMC mandis to create a unified national market for agricultural commodities.',
                'eligibility_criteria' => 'Registered farmers and APMC traders.',
                'benefits' => 'Better price discovery, lower transaction costs, direct banking.',
                'deadline' => now()->addMonths(12)->format('Y-m-d'),
                'government_link' => 'https://enam.gov.in/web/',
                'status' => 'active',
                'max_beneficiaries' => null,
            ],
            [
                'title' => 'ACABC',
                'name' => 'Agri-Clinic & Agri-Business Centers (ACABC)',
                'description' => 'Provides subsidized loans to agriculture graduates to set up their own Agri-Clinics and Agri-Business Centers to support farmers.',
                'eligibility_criteria' => 'Graduates in agriculture and allied subjects.',
                'benefits' => '36% to 44% back-ended composite subsidy on bank loans.',
                'deadline' => now()->addMonths(4)->format('Y-m-d'),
                'government_link' => 'https://www.agriclinics.net/',
                'status' => 'active',
                'max_beneficiaries' => 10000,
            ],
            [
                'title' => 'PM-Kisan',
                'name' => 'Pradhan Mantri Kisan Samman Nidhi (PM-Kisan)',
                'description' => 'Financial support for small and marginal farmers.',
                'eligibility_criteria' => 'Must own less than 2 hectares of land.',
                'benefits' => '₹6,000 per year transferred directly to bank accounts in three equal installments.',
                'deadline' => now()->addMonths(1)->format('Y-m-d'),
                'government_link' => 'https://pmkisan.gov.in/',
                'status' => 'active',
                'max_beneficiaries' => 10000000,
            ],
            [
                'title' => 'PMFBY',
                'name' => 'Pradhan Mantri Fasal Bima Yojana (PMFBY)',
                'description' => 'Crop insurance support against yield losses caused by natural calamities, pests, and diseases.',
                'eligibility_criteria' => 'Farmers growing notified crops in notified areas, including sharecroppers and tenant farmers where permitted.',
                'benefits' => 'Low farmer premium rates with claim support for crop loss events.',
                'deadline' => now()->addMonths(3)->format('Y-m-d'),
                'government_link' => 'https://pmfby.gov.in/',
                'status' => 'active',
                'max_beneficiaries' => null,
            ],
            [
                'title' => 'AIF',
                'name' => 'Agriculture Infrastructure Fund',
                'description' => 'Medium to long-term financing facility for post-harvest management and community farming assets.',
                'eligibility_criteria' => 'Farmers, FPOs, PACS, agri entrepreneurs, startups, and eligible community farming projects.',
                'benefits' => 'Interest subvention and credit guarantee support for eligible infrastructure projects.',
                'deadline' => now()->addMonths(6)->format('Y-m-d'),
                'government_link' => 'https://agriinfra.dac.gov.in/',
                'status' => 'active',
                'max_beneficiaries' => null,
            ],
            [
                'title' => 'Soil Health Card',
                'name' => 'Soil Health Card Scheme',
                'description' => 'Soil testing based advisory for balanced fertilizer use and better crop productivity.',
                'eligibility_criteria' => 'Farmers requiring soil nutrient testing and crop-wise fertilizer recommendations.',
                'benefits' => 'Soil nutrient report with crop-specific recommendations to reduce input cost.',
                'deadline' => now()->addMonths(9)->format('Y-m-d'),
                'government_link' => 'https://soilhealth.dac.gov.in/',
                'status' => 'active',
                'max_beneficiaries' => null,
            ],
        ];

        foreach ($schemes as $scheme) {
            Scheme::updateOrCreate(
                ['title' => $scheme['title']],
                $scheme
            );
        }
    }
}

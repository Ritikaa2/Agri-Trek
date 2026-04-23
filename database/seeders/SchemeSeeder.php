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
        // Clear existing schemes
        Scheme::truncate();

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
            ]
        ];

        foreach ($schemes as $scheme) {
            Scheme::create($scheme);
        }
    }
}

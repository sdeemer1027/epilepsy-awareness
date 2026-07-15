<?php

namespace Database\Seeders;

use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KnowledgeBaseCategorySeeder extends Seeder
{
    /**
     * Seed the Knowledge Base category hierarchy.
     */
    public function run(): void
    {
        $this->seedLivingWithEpilepsy();
        $this->seedDiagnosis();
        $this->seedSeizureTypes();
        $this->seedMedication();
        $this->seedSafety();
        $this->seedLifestyle();

         $this->seedCaregiversAndFamily();
    $this->seedDrivingAndTransportation();
    $this->seedEmploymentAndEducation();
    $this->seedMentalHealthAndWellness();
    $this->seedPregnancyAndFamilyPlanning();
    $this->seedLegalAndFinancial();
    $this->seedTechnologyAndDevices();

    $this->seedResearchAndClinicalTrials();
    $this->seedCommunityAndSupport();
    $this->seedHealthcareProfessionals();


    }

    /**
     * Create a category.
     */
    private function createCategory(
        ?int $parentId,
        string $name,
        string $description,
        int $sortOrder
    ): ArticleCategory {

        return ArticleCategory::create([
            'parent_id'   => $parentId,
            'name'        => $name,
            'slug'        => Str::slug($name),
            'description' => $description,
            'sort_order'  => $sortOrder,
            'is_active'   => true,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Living with Epilepsy
    |--------------------------------------------------------------------------
    */

    private function seedLivingWithEpilepsy(): void
    {
        $root = $this->createCategory(
            null,
            'Living with Epilepsy',
            'Resources for everyday life with epilepsy.',
            10
        );

        $this->createCategory($root->id,'Children','Resources for children living with epilepsy.',10);
        $this->createCategory($root->id,'Teens','Resources for teenagers with epilepsy.',20);
        $this->createCategory($root->id,'Adults','Resources for adults living with epilepsy.',30);
        $this->createCategory($root->id,'Seniors','Resources for older adults with epilepsy.',40);
        $this->createCategory($root->id,'Newly Diagnosed','Starting your epilepsy journey.',50);
    }

    /*
    |--------------------------------------------------------------------------
    | Diagnosis
    |--------------------------------------------------------------------------
    */

    private function seedDiagnosis(): void
    {
        $root = $this->createCategory(
            null,
            'Diagnosis',
            'Testing and diagnosis of epilepsy.',
            20
        );

        $this->createCategory($root->id,'EEG','Electroencephalogram information.',10);
        $this->createCategory($root->id,'MRI & Imaging','Brain imaging and MRI.',20);
        $this->createCategory($root->id,'Genetic Testing','Genetic testing and inherited epilepsy.',30);
        $this->createCategory($root->id,'Blood Work','Laboratory testing.',40);
        $this->createCategory($root->id,'Second Opinions','Seeking another medical opinion.',50);
    }

    /*
    |--------------------------------------------------------------------------
    | Seizure Types
    |--------------------------------------------------------------------------
    */

    private function seedSeizureTypes(): void
    {
        $root = $this->createCategory(
            null,
            'Seizure Types',
            'Understanding the different seizure types.',
            30
        );

        $this->createCategory($root->id,'Focal Seizures','Focal onset seizures.',10);
        $this->createCategory($root->id,'Generalized Seizures','Generalized seizure information.',20);
        $this->createCategory($root->id,'Absence Seizures','Absence seizure information.',30);
        $this->createCategory($root->id,'Tonic-Clonic Seizures','Generalized tonic-clonic seizures.',40);
        $this->createCategory($root->id,'Unknown Onset','Unknown onset seizures.',50);
        $this->createCategory($root->id,'Status Epilepticus','Medical emergency seizure information.',60);
    }

    /*
    |--------------------------------------------------------------------------
    | Medication
    |--------------------------------------------------------------------------
    */

    private function seedMedication(): void
    {
        $root = $this->createCategory(
            null,
            'Medication',
            'Anti-seizure medication information.',
            40
        );

        $this->createCategory($root->id,'Daily Medication','Long-term anti-seizure medication.',10);
        $this->createCategory($root->id,'Rescue Medication','Emergency seizure medication.',20);
        $this->createCategory($root->id,'Side Effects','Medication side effects.',30);
        $this->createCategory($root->id,'Drug Interactions','Medication interactions.',40);
        $this->createCategory($root->id,'Medication Costs','Financial assistance and costs.',50);
        $this->createCategory($root->id,'Medication Adherence','Taking medication correctly.',60);
    }

    /*
    |--------------------------------------------------------------------------
    | Safety
    |--------------------------------------------------------------------------
    */

    private function seedSafety(): void
    {
        $root = $this->createCategory(
            null,
            'Safety',
            'Staying safe while living with epilepsy.',
            50
        );

        $this->createCategory($root->id,'Seizure First Aid','Helping someone during a seizure.',10);
        $this->createCategory($root->id,'SUDEP','Sudden Unexpected Death in Epilepsy.',20);
        $this->createCategory($root->id,'Home Safety','Making your home safer.',30);
        $this->createCategory($root->id,'School Safety','School safety planning.',40);
        $this->createCategory($root->id,'Water Safety','Swimming and bathing safety.',50);
        $this->createCategory($root->id,'Emergency Planning','Emergency preparedness.',60);
    }

    /*
    |--------------------------------------------------------------------------
    | Lifestyle
    |--------------------------------------------------------------------------
    */

    private function seedLifestyle(): void
    {
        $root = $this->createCategory(
            null,
            'Lifestyle',
            'Healthy living with epilepsy.',
            60
        );

        $this->createCategory($root->id,'Sleep','Sleep and seizure management.',10);
        $this->createCategory($root->id,'Nutrition','Nutrition and epilepsy.',20);
        $this->createCategory($root->id,'Exercise','Exercise and physical activity.',30);
        $this->createCategory($root->id,'Stress Management','Managing stress.',40);
        $this->createCategory($root->id,'Travel','Traveling with epilepsy.',50);
        $this->createCategory($root->id,'Hobbies','Safe hobbies and recreation.',60);
    }


    /*
|--------------------------------------------------------------------------
| Caregivers & Family
|--------------------------------------------------------------------------
*/

private function seedCaregiversAndFamily(): void
{
    $root = $this->createCategory(
        null,
        'Caregivers & Family',
        'Resources for family members and caregivers.',
        70
    );

    $this->createCategory($root->id,'Parents','Parents of children with epilepsy.',10);
    $this->createCategory($root->id,'Spouses & Partners','Support for spouses and partners.',20);
    $this->createCategory($root->id,'Grandparents','Resources for grandparents.',30);
    $this->createCategory($root->id,'Siblings','Helping brothers and sisters understand epilepsy.',40);
    $this->createCategory($root->id,'Friends','Supporting a friend with epilepsy.',50);
}
/*
|--------------------------------------------------------------------------
| Driving & Transportation
|--------------------------------------------------------------------------
*/

private function seedDrivingAndTransportation(): void
{
    $root = $this->createCategory(
        null,
        'Driving & Transportation',
        'Driving laws, transportation, and independence.',
        80
    );

    $this->createCategory($root->id,'Driver Licensing','Obtaining or restoring driving privileges.',10);
    $this->createCategory($root->id,'State Driving Laws','Understanding state regulations.',20);
    $this->createCategory($root->id,'Public Transportation','Using buses, trains, and transit safely.',30);
    $this->createCategory($root->id,'Ride Share Services','Transportation alternatives.',40);
    $this->createCategory($root->id,'Commercial Driving','Commercial driver regulations.',50);
}

/*
|--------------------------------------------------------------------------
| Employment & Education
|--------------------------------------------------------------------------
*/

private function seedEmploymentAndEducation(): void
{
    $root = $this->createCategory(
        null,
        'Employment & Education',
        'Working, learning, and understanding your rights.',
        90
    );

    $this->createCategory($root->id,'ADA Rights','Americans with Disabilities Act information.',10);
    $this->createCategory($root->id,'Workplace Accommodations','Reasonable accommodations at work.',20);
    $this->createCategory($root->id,'Returning to Work','Returning after diagnosis.',30);
    $this->createCategory($root->id,'School Plans','504 and IEP information.',40);
    $this->createCategory($root->id,'College','College accommodations.',50);
    $this->createCategory($root->id,'Vocational Rehabilitation','Career assistance programs.',60);
}
/*
|--------------------------------------------------------------------------
| Mental Health & Wellness
|--------------------------------------------------------------------------
*/

private function seedMentalHealthAndWellness(): void
{
    $root = $this->createCategory(
        null,
        'Mental Health & Wellness',
        'Emotional health and wellness resources.',
        100
    );

    $this->createCategory($root->id,'Anxiety','Managing anxiety.',10);
    $this->createCategory($root->id,'Depression','Understanding depression.',20);
    $this->createCategory($root->id,'Stress','Managing stress.',30);
    $this->createCategory($root->id,'Counseling','Professional counseling resources.',40);
    $this->createCategory($root->id,'Peer Support','Connecting with others.',50);
}

/*
|--------------------------------------------------------------------------
| Pregnancy & Family Planning
|--------------------------------------------------------------------------
*/

private function seedPregnancyAndFamilyPlanning(): void
{
    $root = $this->createCategory(
        null,
        'Pregnancy & Family Planning',
        'Pregnancy and parenting with epilepsy.',
        110
    );

    $this->createCategory($root->id,'Pregnancy','Pregnancy planning.',10);
    $this->createCategory($root->id,'Parenting','Parenting with epilepsy.',20);
    $this->createCategory($root->id,'Genetics','Inherited forms of epilepsy.',30);
    $this->createCategory($root->id,'Family Planning','Planning for the future.',40);
    $this->createCategory($root->id,'Breastfeeding','Breastfeeding considerations.',50);
}


/*
|--------------------------------------------------------------------------
| Legal & Financial
|--------------------------------------------------------------------------
*/

private function seedLegalAndFinancial(): void
{
    $root = $this->createCategory(
        null,
        'Legal & Financial',
        'Legal rights and financial assistance.',
        120
    );

    $this->createCategory($root->id,'Disability Benefits','Social Security and disability.',10);
    $this->createCategory($root->id,'Insurance','Health and life insurance.',20);
    $this->createCategory($root->id,'Financial Assistance','Financial support resources.',30);
    $this->createCategory($root->id,'Advance Directives','Medical directives.',40);
    $this->createCategory($root->id,'Employment Rights','Legal protections at work.',50);
}

/*
|--------------------------------------------------------------------------
| Technology & Devices
|--------------------------------------------------------------------------
*/

private function seedTechnologyAndDevices(): void
{
    $root = $this->createCategory(
        null,
        'Technology & Devices',
        'Technology that supports epilepsy management.',
        130
    );

    $this->createCategory($root->id,'Medical ID','Medical identification.',10);
    $this->createCategory($root->id,'Smart Watches','Wearable technology.',20);
    $this->createCategory($root->id,'Seizure Detection','Detection devices.',30);
    $this->createCategory($root->id,'Mobile Apps','Helpful mobile applications.',40);
    $this->createCategory($root->id,'Wearables','Emerging wearable technology.',50);
}

private function seedResearchAndClinicalTrials(): void
{
    $root = $this->createCategory(
        null,
        'Research & Clinical Trials',
        'Research, studies, and emerging epilepsy treatments.',
        140
    );

    $this->createCategory($root->id,'Current Studies','Current epilepsy research.',10);
    $this->createCategory($root->id,'Clinical Trials','Participating in clinical trials.',20);
    $this->createCategory($root->id,'Genetics Research','Research into genetic epilepsy.',30);
    $this->createCategory($root->id,'New Treatments','Emerging therapies and treatments.',40);
    $this->createCategory($root->id,'Medical Advances','New developments in epilepsy care.',50);
}

private function seedCommunityAndSupport(): void
{
    $root = $this->createCategory(
        null,
        'Community & Support',
        'Connecting people affected by epilepsy.',
        150
    );

    $this->createCategory($root->id,'Support Groups','Local and online support groups.',10);
    $this->createCategory($root->id,'Peer Mentoring','Support from people with lived experience.',20);
    $this->createCategory($root->id,'Newly Diagnosed Support','Resources for new diagnoses.',30);
    $this->createCategory($root->id,'Caregiver Stories','Experiences from caregivers.',40);
    $this->createCategory($root->id,'Member Stories','Community experiences.',50);
    $this->createCategory($root->id,'Advocacy','Epilepsy awareness and advocacy.',60);
    $this->createCategory($root->id,'Awareness Events','Events and awareness activities.',70);
}

private function seedHealthcareProfessionals(): void
{
    $root = $this->createCategory(
        null,
        'Healthcare Professionals',
        'Resources for epilepsy healthcare providers.',
        160
    );

    $this->createCategory($root->id,'Neurologists','Neurology resources.',10);
    $this->createCategory($root->id,'Epileptologists','Epilepsy specialists.',20);
    $this->createCategory($root->id,'Nurses','Nursing resources.',30);
    $this->createCategory($root->id,'Emergency Responders','EMS and emergency care.',40);
    $this->createCategory($root->id,'Pharmacists','Medication support resources.',50);
    $this->createCategory($root->id,'Therapists','Therapy and rehabilitation resources.',60);
}

}
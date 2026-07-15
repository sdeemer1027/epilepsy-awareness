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
}
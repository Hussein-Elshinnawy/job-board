<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Candidate;
use App\Models\Category;
use App\Models\City;
use App\Models\Comment;
use App\Models\Company;
use App\Models\JobPost;
use App\Models\Technology;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        if (City::count() == 0) {
            $this->call(CitySeeder::class);
        }

        if (Category::count() == 0) {
            $this->call(CategorySeeder::class);
        }

        if (Technology::count() == 0) {
            $this->call(TechnologySeeder::class);
        }

        // if (User::count() == 0) {
        //     $this->call(UserSeeder::class);
        // }

        if (Candidate::count() == 0) {
            $this->call(CandidateSeeder::class);
        }

        if (Company::count() == 0) {
            $this->call(CompanySeeder::class);
        }

        if (JobPost::count() == 0) {
            $this->call(JobPostSeeder::class);
        }

        if (Application::count() == 0) {
            $this->call(ApplicationSeeder::class);
        }

        if (Comment::count() == 0) {
            $this->call(CommentSeeder::class);
        }
    }
}

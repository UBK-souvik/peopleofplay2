<?php

use App\Models\HomePage;
use App\Models\MainListPage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{

    protected $home_page_data = [
        [
            'display_order' => 1,
            'title' => 'FIND TOYS, GAMES & INVENTORS',
            'type' => 1,
        ],
        [
            'display_order' => 2,
            'title' => 'Play Events',
            'type' => 2,
        ],
        [
            'display_order' => 3,
            'title' => 'Latest News',
            'type' => 3,
        ],
        // [
        //     'display_order' => 4,
        //     'title' => 'Newsletter',
        //     'type' => 4,
        // ],
        [
            'display_order' => 4,
            'title' => 'Birthdays and Anniversaries',
            'type' => 4,
        ],
        [
            'display_order' => 5,
            'title' => 'Poll: Favorite Game',
            'type' => 5,
        ],
    ];
    protected $main_list_page_data = [
        [
            'display_order' => 1,
            'title' => 'Top Picks',
            'type' => 1,
        ],
        [
            'display_order' => 2,
            'title' => 'Featured Today',
            'type' => 1,
        ],
        [
            'display_order' => 3,
            'title' => 'New Releases',
            'type' => 1,
        ],
        [
            'display_order' => 4,
            'title' => 'Exclusive Videos',
            'type' => 1,
        ],
        [
            'display_order' => 5,
            'title' => 'Born Today Circle',
            'type' => 1,
        ],
        //
        [
            'display_order' => 1,
            'title' => 'Top Picks',
            'type' => 2,
        ],
        [
            'display_order' => 2,
            'title' => 'Featured Today',
            'type' => 2,
        ],
        [
            'display_order' => 3,
            'title' => 'New Releases',
            'type' => 2,
        ],
        [
            'display_order' => 4,
            'title' => 'Exclusive Videos',
            'type' => 2,
        ],
        [
            'display_order' => 5,
            'title' => 'Born Today Circle',
            'type' => 2,
        ],
        //
        [
            'display_order' => 1,
            'title' => 'Top Picks',
            'type' => 3,
        ],
        [
            'display_order' => 2,
            'title' => 'Featured Today',
            'type' => 3,
        ],
        [
            'display_order' => 3,
            'title' => 'New Releases',
            'type' => 3,
        ],
        [
            'display_order' => 4,
            'title' => 'Exclusive Videos',
            'type' => 3,
        ],
        [
            'display_order' => 5,
            'title' => 'Born Today Circle',
            'type' => 3,
        ],
        //
        [
            'display_order' => 1,
            'title' => 'Top Picks',
            'type' => 4,
        ],
        [
            'display_order' => 2,
            'title' => 'Featured Today',
            'type' => 4,
        ],
        [
            'display_order' => 3,
            'title' => 'New Releases',
            'type' => 4,
        ],
        [
            'display_order' => 4,
            'title' => 'Exclusive Videos',
            'type' => 4,
        ],
        [
            'display_order' => 5,
            'title' => 'Born Today Circle',
            'type' => 4,
        ],
        //
        [
            'display_order' => 1,
            'title' => 'Top Picks',
            'type' => 5,
        ],
        [
            'display_order' => 2,
            'title' => 'Featured Today',
            'type' => 5,
        ],
        [
            'display_order' => 3,
            'title' => 'New Releases',
            'type' => 5,
        ],
        [
            'display_order' => 4,
            'title' => 'Exclusive Videos',
            'type' => 5,
        ],
        [
            'display_order' => 5,
            'title' => 'Born Today Circle',
            'type' => 5,
        ],
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('home_pages')->truncate();
        HomePage::insert($this->home_page_data);

        DB::table('main_list_pages')->truncate();
        MainListPage::insert($this->main_list_page_data);

        // $this->call(UsersTableSeeder::class);
    }
}

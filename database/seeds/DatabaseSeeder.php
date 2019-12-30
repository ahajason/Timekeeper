<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $iconArr = [
            'fa fa-tag',
            'fa fa-book',
            'fa fa-tasks',
            'fa fa-bath',
            'fa fa-bed',
            'fa fa-bell',
            'fa fa-bell-slash',
            'fa fa-bicycle',
            'fa fa-bookmark',
            'fa fa-briefcase',
            'fa fa-building',
            'fa fa-bullseye',
            'fa fa-bus',
            'fa fa-taxi',
            'fa fa-calendar',
            'fa fa-coffee',
            'fa fa-comment',
            'fa fa-comments',
            'fa fa-cutlery',
            'fa fa-envelope',
            'fa fa-film',
            'fa fa-glass',
            'fa fa-graduation-cap',
            'fa fa-music',
            'fa fa-video-camera',
            'fa fa-video-camera',
            'fa fa-send',
            'fa fa-terminal',
            'fa fa-shopping-cart',
        ];
        foreach ($iconArr as $index => $icon) {
            \App\Model\Icon::updateOrCreate(
                ['icon_src' => $icon, 'icon_type' => '1'],
                ['icon_size' => 100, 'icon_order' => $index + 1]
            );
        }

    }
}

<?php

return [
        'app_name' => 'People of Play Admin Panel',
        'company' => 'People of Play',
        'title' => ':: People of Play App ::',

        'originalImagePath' => 'uploads/images/',

        'allowed_image_mimes' => 'mimes:jpeg,png,bmp,jpg|max:102400',
        'allowed_video_mimes' => 'mimes:3gp,mp4,mpeg,avi,mov,wmv,mkv,flv,vob,rm,rmbv,m4p,flv,f4v,f4p,f4a,f4b,ogg,qt|max:2048',
        'allowed_video_image_mimes' => 'mimes:jpeg,png,bmp,jpg,gif,svg,3gp,mp4,mpeg,avi,mov,wmv,mkv,flv,vob,rm,rmbv,m4p,flv,f4v,f4p,f4a,f4b,ogg,qt|max:2048',
        'fcm_legacy_key' => '',
        'user_status' => ['1' => 'Active', '0' => 'Inactive', '2' => 'Block'],
        'locale' => ['ar' => 'Arabic', 'en' => 'English'],
        'action_status' => ['1' => 'Active', '0' => 'Inactive'],
        'other_action' => ['1' => 'Yes', '0' => 'No'],
        'user_locale' => ['en' => 'English', 'ar' => 'Arabic'],
        'gender' => ['Male', 'Female', 'Other'],
        'role' => [
            1 => 'Inventor',
            2 => 'Company'
        ],
        'group' => [
            1 => 'Toy',
            2 => 'Game'
        ],
        
       'social_media_icon' => [
            'images/icon1.png',
            'images/icon2.png',
            'images/icon3.png',
            'images/icon261.png', // missing
            'images/icon5.png',
            'images/icon271.jpg', // missing
            'images/icon4.png',
            'images/icon6.png',
            'images/icon23.png',
            'images/icon7.png',
            'images/icon8.png',
            'images/icon9.png',
            'images/icon30.jpg',
            'images/icon10.png',
            'images/icon11.png',
            'images/icon12.png',
            'images/icon291.png', // missing
            'images/icon13.png',
            'images/icon14.png',
            'images/icon15.png',
            'images/icon16.png',
            'images/icon17.png',
            'images/icon18.png',
            'images/icon19.png',
            'images/icon301.png', // missing
            'images/icon24.png',
            'images/icon20.png',
            'images/icon21.png',
            'images/icon22.png',
            // 'images/icon24.png',
            'images/icon25.png',
            'images/icon26.png',
        ],
        'social_media_icon_old' => [
            'images/icon1.png',
            'images/icon9.png',
            'images/icon17.png',
            'images/icon25.png',
            'images/icon2.png',
            'images/icon10.png',
            'images/icon18.png',
            'images/icon18.png',
            'images/icon3.png',
            'images/icon11.png',
            'images/icon19.png',
            'images/icon19.png',
            'images/icon5.png',
            'images/icon12.png',
            'images/icon20.png',
            'images/icon20.png',
            'images/icon4.png',
            'images/icon13.png',
            'images/icon21.png',
            'images/icon21.png',
            'images/icon6.png',
            'images/icon14.png',
            'images/icon22.png',
            'images/icon22.png',
            'images/icon7.png',
            'images/icon15.png',
            'images/icon23.png',
            'images/icon8.png',
            'images/icon16.png',
            // 'images/icon24.png',
            'images/icon25.png',
            'images/icon26.png',
        ],

        'social_media_now' => [
              'Amazon',
              'Behance',
              'Facebook',
              'Instagram',
              'LinkedIn',
              'Pinterest',
              'Twitter',
              'YouTube',
              'Website',
        ],

      
          'social_media' => [
            'Amazon',
            'Bandcamp',
            'Beatport',
            'Behance',
            'Blogger',
            'Coroflot',
            'Deezer',
            'DeviantArt',
            'Facebook',
            'Flickr',
            'Google Play',
            'Houzz',
            'Instagram',
            'iTunes',
            'LinkedIn',
            'Odnoklassniki',
            'Pinterest',
            'RSS',
            'Snapchat',
            'SoundCloud',
            'Spotify',
            'Tidal',
            'TikTok',
            'TripAdvisor',
            'Tumblr',
            'Twitter',
            'Vimeo',
            'Vkontakte',
            'Yelp',
            'YouTube',
            'Website',
        ],

        'product_interest' => [
            1 => 'Animals & Nature',
            'TV & Movies',
            'Fashion & Sci-Fi',
            'Anime',
            'Comics',
            'Fantasy',
            'Learning',
            'Music',
            'Occupations',
            'Sports',
            'Transportation',
            'Video Games'
        ],
        'common_options' => [
            1 => 'Yes',
            'NO',
            'Not applicable'
        ],
        'setting_for_play' => [
            1 => 'Cooperative',
            'Travel',
            'Trading',
            'Religious',
            'Collectible',
            'Traditional',
            'Educational',
            'Novelty',
            'Wearable',
            'Birthday',
            'Skill and Action',
            'Arts and Craft',
            'War and Battle',
            'Display and Decoration'
        ],
        'playing_time' => [
            1 => 'Minutes',
            'Hours',
            'Days',
            'Not Applicable'
        ],
        'playable_age' => [
            1 => 'Birth to 24 Months',
            '2 to 4 Years',
            '5 to 7 Years',
            '8 to 13 Years',
            '14 Years & Up'
        ],
        'product_game_difficulty' => [
            1 => 'Family',
            'Toddler',
            'Party',
            'Adult',
            'Children',
            'Executive',
            'Pet',
            'Sex',
            'Infant',
            'Teenager',
            'Tween',
            'Boys',
            'Girls'
        ],
        'classification_type' => [
            1 => 'Abstract Strategy Game',
            'Customizable Games',
            'Thematic Games',
            'Family Games (fun for kids and adults)',
            'Children \'s Games (best for younger kids)',
            'Party Games (few rules, lots of laughs)',
            'Strategy Games (more complex games)',
            'Wargames (conflict simulation, etc.)'
        ],
        'delivery_mechanism' => [
            1 => 'Video',
            'Card',
            'Board game',
            'Digital',
            'Electronic',
            'App',
            'Animal',
            'Figurine',
            'Doll',
            'Plush',
            'Model',
            'Puppet',
            'Instrument and Noisemaker',
            'Robot',
            'Weapon and Blaster',
            'Vehicle (Train, Aeroplanes, Automobiles, Bicycle, Carriage)',
            'Water',
            'Book',
            'Paper',
            'Crayon, Chalk,Marker, Pencil and Paint',
            'Playset',
            'Costume and Accessory',
            'Compounds (putty, dough, clay, sand)'
        ],
        'toy_type' => [
            1 => 'Designer Art',
            'Vinyl',
            'Room Déco',
            'Mechanical',
            'Mascot',
            'Construction',
            'Practical Jokes',
            'Physical Activity and Dexterity',
            'Action Figure',
            'Furniture',
            'Globes and Maps'
        ],
        'game_type' => [
            1 => 'Customizable',
            'Strategy',
            'Light Strategy',
            'Abstract',
            'Thematic',
            'Brainteaser',
            'Handheld'
        ],
        'language_dependence' => [
            1 => 'No necessary in-game text',
            'Some necessary text - easily memorized or small crib sheet',
            'Moderate in-game text - needs crib sheet or paste ups',
            'Extensive use of text - massive conversion needed to be playable',
            'Unplayable in another language'
        ],
        'collaborator_role' => [
            1 => 'Inventor',
            2 => 'Company',
            3 => 'Engineer'
        ],
        'gallery_meta_type' => [
            1 => 'Poster',
            'Publicity',
            'Still Frame',
            'Behind the Scene',
            'Event',
            'Product/Box Art',
            'Production Art'
        ],
        'blog_status' => [
            0 => 'Draft',
            1 => 'Published'
        ],
        'classified_status' => [
            0 => 'Draft',
            1 => 'Published'
        ],
        'dictionary_status' => [
            0 => 'In Review',
            1 => 'Approved'
        ],
        'home_page_type' => [
            0 => 'Video Section',
            1 => 'Product',
            2 => 'Event',
            3 => 'Latest News',
            4 => 'Birthdays and Anniversaries',
            5 => 'Polls',
            6 => 'User',
			7 => 'Brand',
			8 => 'Advertise'
        ],
        'award_type' => [
            1 =>  'Product',
            2 =>  'User'
        ],
        'drop_down_type' => [
            1 => 'toys',
            'games',
            'companies',
            'innovators',
            'events',
            'awards',
			'brands',
			'kids',
			'rip'
        ],
        'sidebar_type' => [
            1 => 'Ads 1',
            'Videos',
            'News',
            'Product',
            'innovators',
            'Company',
            'Interviews',
            'Ads 2'
        ],
        'poll_type' => [
            1 => 'Product',
            'Event',
            'Innovator',
            'Company',
        ],
        'newsletter_type' => [
            1 => 'Importance of Play',
            'Business of Play',
        ],
        'quiz_status' => [
            0 => 'Draft',
            1 => 'Published'
        ],
       
];
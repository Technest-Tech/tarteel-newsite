<?php

/*
|--------------------------------------------------------------------------
| Tarteel Academy editable content
|--------------------------------------------------------------------------
|
| Everything a non-developer is likely to want to change lives here: the
| contact placeholders, the marketing statistics, the testimonials, and the
| bilingual labels used for the enrollment enums. Nothing in this file is
| queried from the database, so the numbers below are content, not metrics.
|
*/

return [

    /*
    | The single admin account, created by the AdminUserSeeder. Values come
    | from .env so no password is ever committed to the repository.
    */
    'admin' => [
        'name' => env('ADMIN_NAME', 'Tarteel Academy Admin'),
        'email' => env('ADMIN_EMAIL', 'admin@tarteelacademy.com'),
        'password' => env('ADMIN_PASSWORD'),
    ],

    'contact' => [
        'email' => env('ACADEMY_EMAIL', 'tarteelacademy24@gmail.com'),
        'phone' => env('ACADEMY_PHONE', '+201120600803'),
        'phone_display' => env('ACADEMY_PHONE_DISPLAY', '+20 112 060 0803'),
        // A full wa.me URL. Empty hides the floating button and the chat links.
        'whatsapp' => env('ACADEMY_WHATSAPP', 'https://wa.me/201120600803'),
        // Still unknown, so they stay out of the structured data entirely.
        'address_locality' => env('ACADEMY_CITY', ''),
        'address_country' => env('ACADEMY_COUNTRY', ''),
    ],

    'social' => [
        // Leave a value empty to hide it from the footer and the JSON-LD block.
        'facebook' => env('ACADEMY_FACEBOOK', 'https://www.facebook.com/share/1JC9M2ehfm/'),
        'instagram' => env('ACADEMY_INSTAGRAM', ''),
        'youtube' => env('ACADEMY_YOUTUBE', ''),
        'x' => env('ACADEMY_X', ''),
    ],

    /*
    | Monthly plans, taken from the academy's published package sheets. Every
    | tier inside a package bills at the same per-class rate, so `per_class` is
    | stated once per package instead of being repeated on each row — and it is
    | the figure to re-check first if a price here ever changes.
    */
    'pricing' => [
        'currency' => 'USD',
        'symbol' => '$',

        'packages' => [
            [
                'key' => 'half-hour',
                'minutes' => 30,
                'name_ar' => 'الباقة الأولى',
                'name_en' => 'First package',
                'tagline_ar' => 'نصف ساعة لكل حصة',
                'tagline_en' => 'Half-hour lessons',
                'per_class' => '3.50',
                'featured' => false,
                'tiers' => [
                    ['week' => 3, 'month' => 12, 'price' => 42],
                    ['week' => 4, 'month' => 16, 'price' => 56],
                    ['week' => 5, 'month' => 20, 'price' => 70],
                ],
            ],
            [
                'key' => 'forty-five',
                'minutes' => 45,
                'name_ar' => 'الباقة الثانية',
                'name_en' => 'Second package',
                'tagline_ar' => '45 دقيقة لكل حصة',
                'tagline_en' => '45-minute lessons',
                'per_class' => '5.25',
                // Visual emphasis only: the middle card carries the filled
                // treatment the way the first program card does. It is not a
                // popularity claim, so it needs no badge.
                'featured' => true,
                'tiers' => [
                    ['week' => 2, 'month' => 8, 'price' => 42],
                    ['week' => 3, 'month' => 12, 'price' => 63],
                    ['week' => 4, 'month' => 16, 'price' => 84],
                    ['week' => 5, 'month' => 20, 'price' => 105],
                ],
            ],
            [
                'key' => 'full-hour',
                'minutes' => 60,
                'name_ar' => 'الباقة الثالثة',
                'name_en' => 'Third package',
                'tagline_ar' => 'ساعة كاملة لكل حصة',
                'tagline_en' => 'Full-hour lessons',
                'per_class' => '7.00',
                'featured' => false,
                'tiers' => [
                    ['week' => 2, 'month' => 8, 'price' => 56],
                    ['week' => 3, 'month' => 12, 'price' => 84],
                    ['week' => 4, 'month' => 16, 'price' => 112],
                    ['week' => 5, 'month' => 20, 'price' => 140],
                ],
            ],
        ],

        // Included with every package, whichever tier the family chooses.
        'includes' => [
            ['ar' => 'معلمون مؤهلون', 'en' => 'Qualified teachers'],
            ['ar' => 'تعلّم تفاعلي', 'en' => 'Interactive learning'],
            ['ar' => 'مواعيد مرنة', 'en' => 'Flexible schedule'],
            ['ar' => 'بيئة آمنة وداعمة', 'en' => 'Safe, supportive environment'],
            ['ar' => 'شهادة إتمام', 'en' => 'Certificate of completion'],
            ['ar' => 'متابعة دورية للتقدّم', 'en' => 'Regular progress tracking'],
        ],
    ],

    // Editable marketing figures. Update the numbers, keep the two labels.
    'stats' => [
        ['value' => '+500', 'value_en' => '500+', 'ar' => 'طالب وطالبة', 'en' => 'happy students'],
        ['value' => '+35', 'value_en' => '35+', 'ar' => 'معلماً ومعلمة', 'en' => 'expert teachers'],
        ['value' => '+20', 'value_en' => '20+', 'ar' => 'دولة حول العالم', 'en' => 'countries reached'],
        ['value' => '98%', 'value_en' => '98%', 'ar' => 'رضا أولياء الأمور', 'en' => 'parent satisfaction'],
    ],

    'rating' => [
        'score' => '4.9',
        'scale' => '5',
    ],

    /*
    | Real messages families sent the academy on WhatsApp, transcribed rather
    | than screenshotted: the originals carry contact names, profile photos and
    | phone numbers that have no business on a public page. Names are kept to
    | the form the sender used, and each quote is tidied only for punctuation.
    */
    'testimonials' => [
        [
            'initials_ar' => 'ه',
            'initials_en' => 'H',
            'name_ar' => 'حمودي',
            'name_en' => 'Hammudi',
            'role_ar' => 'رسالة عبر واتساب',
            'role_en' => 'Message via WhatsApp',
            'quote_ar' => 'والله المعلم هو الأفضل، يجعل كل خطوة أسهل ما تكون على الفهم.',
            'quote_en' => 'Wallahi, the teacher is the best — he makes every step the easiest to understand.',
        ],
        [
            'initials_ar' => 'أز',
            'initials_en' => 'UZ',
            'name_ar' => 'أم زينب',
            'name_en' => 'Umm Zainab',
            'role_ar' => 'رسالة عبر واتساب',
            'role_en' => 'Message via WhatsApp',
            'quote_ar' => 'أنا سعيدة بأسلوب المعلمة إسراء في التدريس، وبالإدارة كذلك. من الرائع أنكم سريعون في الرد على الرسائل ومتعاونون جداً.',
            'quote_en' => "I am pleased with teacher Esraa's teaching style, and with your admin too. It is great that you are prompt in replying to messages and quite accommodating.",
        ],
        [
            'initials_ar' => 'مع',
            'initials_en' => 'MO',
            'name_ar' => 'منى عمر',
            'name_en' => 'Muna Omer',
            'role_ar' => 'رسالة عبر واتساب',
            'role_en' => 'Message via WhatsApp',
            'quote_ar' => 'نعم، أنصح أكاديمية ترتيل لأصدقائي وأقاربي، لأن أسلوب التدريس عندهم متقدم ويجعل طفلي سعيداً.',
            'quote_en' => 'Yes, I would recommend Tarteel Academy to my friends and relatives, because their teaching is advanced and it makes my child happy.',
        ],
        [
            'initials_ar' => 'أص',
            'initials_en' => 'US',
            'name_ar' => 'أم صالح',
            'name_en' => 'Umm Saleh',
            'role_ar' => 'رسالة عبر واتساب',
            'role_en' => 'Message via WhatsApp',
            'quote_ar' => 'ما شاء الله، كلهم ممتازون، وتعاملهم مع أطفالي جميل وحنون. الله يسعدهم ويزيدهم علماً.',
            'quote_en' => 'Mashallah, they are all excellent, and they are kind and gentle with my children. May God grant them happiness and increase them in knowledge.',
        ],
        [
            'initials_ar' => 'ط',
            'initials_en' => 'T',
            'name_ar' => 'من طلاب الأكاديمية',
            'name_en' => 'A Tarteel student',
            'role_ar' => 'رسالة عبر واتساب',
            'role_en' => 'Message via WhatsApp',
            'quote_ar' => 'أعتبر نفسي محظوظاً لأن الأستاذة أسماء معلمتي. وأنا ممتن حقاً لدعمكم الأكاديمي.',
            'quote_en' => 'I consider myself a lucky person because I have Ms. Asma as my teacher. I am also really thankful for your academic support.',
        ],
        [
            'initials_ar' => 'ع',
            'initials_en' => 'AP',
            'name_ar' => 'ولي أمر علي',
            'name_en' => "Ali's parent",
            'role_ar' => 'رسالة عبر واتساب',
            'role_en' => 'Message via WhatsApp',
            'quote_ar' => 'يعجبنا كثيراً أسلوب المعلم في تدريس علي؛ فهو ودود وواضح. وقد رشّحناكم للكثيرين لدروس العربية والقرآن. شكراً لكم.',
            'quote_en' => 'We really like the approach the teacher uses to teach Ali — he is friendly and clear. We have referred many people to you for Arabic and Quran classes. Thank you.',
        ],
    ],

    /*
    | Enum values stored on the enrollments table, with their bilingual labels.
    | The keys are authoritative: validation rules and the admin filters are
    | both built from them, so adding a value here is the only change needed.
    */
    'enums' => [
        'status' => [
            'new' => ['ar' => 'جديد', 'en' => 'New'],
            'contacted' => ['ar' => 'تم التواصل', 'en' => 'Contacted'],
            'enrolled' => ['ar' => 'مُسجَّل', 'en' => 'Enrolled'],
            'closed' => ['ar' => 'مغلق', 'en' => 'Closed'],
        ],
        'student_type' => [
            'child' => ['ar' => 'طفل / طفلة', 'en' => 'Child'],
            'adult' => ['ar' => 'شخص بالغ', 'en' => 'Adult'],
        ],
        'program' => [
            'quran' => ['ar' => 'تلاوة القرآن', 'en' => 'Quran reading'],
            'tajweed' => ['ar' => 'التجويد', 'en' => 'Tajweed'],
            'memorization' => ['ar' => 'الحفظ والمراجعة', 'en' => 'Memorization'],
            'arabic' => ['ar' => 'اللغة العربية', 'en' => 'Arabic language'],
        ],
        'preferred_language' => [
            'arabic' => ['ar' => 'العربية', 'en' => 'Arabic'],
            'english' => ['ar' => 'الإنجليزية', 'en' => 'English'],
            'both' => ['ar' => 'كلاهما', 'en' => 'Both'],
        ],
        'source_locale' => [
            'ar' => ['ar' => 'العربية', 'en' => 'Arabic'],
            'en' => ['ar' => 'الإنجليزية', 'en' => 'English'],
        ],
    ],
];

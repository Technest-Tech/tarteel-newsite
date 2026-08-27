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

    // Testimonials use initials on purpose: no AI-generated faces.
    'testimonials' => [
        [
            'initials' => 'SA',
            'name_ar' => 'سارة أحمد',
            'name_en' => 'Sarah Ahmed',
            'role_ar' => 'والدة آدم · المملكة المتحدة',
            'role_en' => "Adam's mother · United Kingdom",
            'quote_ar' => 'ابني أصبح ينتظر موعد الحصة! أسلوب المعلم هادئ ومشجع، وتطوّره في القراءة واضح جداً خلال أسابيع.',
            'quote_en' => 'My son now looks forward to every lesson. His teacher is patient and encouraging, and the progress in his reading is already so clear.',
        ],
        [
            'initials' => 'MK',
            'name_ar' => 'مريم خالد',
            'name_en' => 'Mariam Khaled',
            'role_ar' => 'طالبة · كندا',
            'role_en' => 'Adult learner · Canada',
            'quote_ar' => 'كنت أخاف من أحكام التجويد، لكن الخطة البسيطة والتطبيق المستمر جعلاها مفهومة وممتعة.',
            'quote_en' => 'Tajweed used to feel intimidating. The simple plan and consistent practice have made it clear — and genuinely enjoyable.',
        ],
        [
            'initials' => 'OH',
            'name_ar' => 'عمر حسن',
            'name_en' => 'Omar Hassan',
            'role_ar' => 'والد ليان · أستراليا',
            'role_en' => "Layan's father · Australia",
            'quote_ar' => 'أكثر ما أعجبني هو المتابعة. أعرف دائماً أين وصلت ابنتي وما الذي نعمل عليه في الشهر القادم.',
            'quote_en' => 'The follow-up is what I value most. I always know where my daughter stands and what she is working toward next.',
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

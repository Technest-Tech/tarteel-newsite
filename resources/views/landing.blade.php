@php
    // English is the default render: the page ships as LTR and JavaScript only
    // switches it if the visitor previously chose Arabic.
    $canonical = rtrim(config('app.url'), '/').'/';
    $socialImage = rtrim(config('app.url'), '/').'/images/tarteel-academy-social.jpg';
    $successLocale = session('enrollment_success');

    // Structured data uses only facts we actually know. Phone, address and the
    // social profiles stay as configurable placeholders rather than invented.
    $jsonLd = json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'EducationalOrganization',
        'name' => 'Tarteel Academy',
        'alternateName' => 'أكاديمية ترتيل',
        'url' => $canonical,
        'logo' => rtrim(config('app.url'), '/').'/images/tarteel-academy-logo.png',
        'image' => $socialImage,
        'description' => 'Online academy teaching Quran recitation, Tajweed, memorization and the Arabic language to children and adults worldwide.',
        'email' => $contact['email'],
        'telephone' => $contact['phone'],
        'areaServed' => 'Worldwide',
        'sameAs' => array_values($social),
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
@endphp
<!DOCTYPE html>
<html lang="en" dir="ltr" data-locale="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tarteel Academy | Online Quran &amp; Arabic Lessons</title>
    <meta name="description" content="Tarteel Academy offers live one-to-one Quran, Tajweed, memorization and Arabic lessons for children and adults, with qualified teachers and flexible schedules. Book your free trial lesson.">
    <link rel="canonical" href="{{ $canonical }}">
    <meta name="theme-color" content="#123d2c">

    <meta property="og:site_name" content="Tarteel Academy | أكاديمية ترتيل">
    <meta property="og:title" content="Tarteel Academy | أكاديمية ترتيل">
    <meta property="og:description" content="دروس فردية مباشرة في القرآن والعربية مع معلمين مؤهلين — Live one-to-one Quran and Arabic lessons with qualified teachers.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:image" content="{{ $socialImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="800">
    <meta property="og:image:alt" content="A hijab-wearing student learning the Quran online with her teacher">
    <meta property="og:locale" content="en_US">
    <meta property="og:locale:alternate" content="ar_AR">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Tarteel Academy | أكاديمية ترتيل">
    <meta name="twitter:description" content="دروس فردية مباشرة في القرآن والعربية مع معلمين مؤهلين — Live one-to-one Quran and Arabic lessons with qualified teachers.">
    <meta name="twitter:image" content="{{ $socialImage }}">

    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="apple-touch-icon" href="{{ asset('images/tarteel-academy-logo-160.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=IBM+Plex+Sans+Arabic:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="preload" as="image" href="{{ asset('images/hero-quran-online-modest.webp') }}" type="image/webp" fetchpriority="high">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script type="application/ld+json">{!! $jsonLd !!}</script>
</head>
<body class="site-body">
    <a class="skip-link" href="#main" data-ar="تخطَّ إلى المحتوى" data-en="Skip to content">Skip to content</a>

    <div class="announcement">
        <div class="container announcement-inner">
            <p>
                <span class="live-dot" aria-hidden="true"></span>
                <span data-ar="التسجيل مفتوح الآن — احجز حصتك التجريبية المجانية" data-en="Enrollment is now open — book your free trial lesson">Enrollment is now open — book your free trial lesson</span>
            </p>
            <a href="#enroll"><span data-ar="ابدأ الآن" data-en="Start now">Start now</span><span aria-hidden="true">↗</span></a>
        </div>
    </div>

    <header class="site-header" id="top">
        <div class="container nav-wrap">
            <a href="#top" class="brand" data-label-ar="أكاديمية ترتيل — الصفحة الرئيسية" data-label-en="Tarteel Academy — home" aria-label="Tarteel Academy — home">
                <picture>
                    <source srcset="{{ asset('images/tarteel-academy-logo-160.webp') }}" type="image/webp">
                    <img src="{{ asset('images/tarteel-academy-logo-160.png') }}" width="160" height="160" alt="" aria-hidden="true">
                </picture>
                <span class="brand-copy">
                    <strong data-ar="أكاديمية ترتيل" data-en="Tarteel Academy">Tarteel Academy</strong>
                    <small data-ar="للقرآن واللغة العربية" data-en="Quran &amp; Arabic online">Quran &amp; Arabic online</small>
                </span>
            </a>

            <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-navigation"
                    data-label-ar="فتح القائمة" data-label-en="Open menu" aria-label="Open menu">
                <span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span>
            </button>

            <nav class="main-nav" id="primary-navigation" data-label-ar="التنقل الرئيسي" data-label-en="Main navigation" aria-label="Main navigation">
                <a href="#programs" data-ar="البرامج" data-en="Programs">Programs</a>
                <a href="#why-us" data-ar="لماذا ترتيل؟" data-en="Why Tarteel">Why Tarteel</a>
                <a href="#journey" data-ar="كيف نبدأ؟" data-en="How it works">How it works</a>
                <a href="#classroom" data-ar="من فصولنا" data-en="Our classes">Our classes</a>
                <a href="#pricing" data-ar="الأسعار" data-en="Pricing">Pricing</a>
                <a href="#stories" data-ar="آراء الطلاب" data-en="Stories">Stories</a>
                <a href="#faq" data-ar="الأسئلة الشائعة" data-en="FAQ">FAQ</a>
            </nav>

            <div class="nav-actions">
                <button class="language-switch" type="button" data-label-ar="التبديل إلى الإنجليزية" data-label-en="Switch to Arabic" aria-label="Switch to Arabic">
                    <span data-locale="ar">ع</span><span data-locale="en" class="lang-active">EN</span>
                </button>
                <a class="button button-small" href="#enroll" data-ar="احجز حصة مجانية" data-en="Book a free trial">Book a free trial</a>
            </div>
        </div>
    </header>

    <main id="main">
        {{-- C. Hero --------------------------------------------------------- --}}
        <section class="hero" aria-labelledby="hero-title">
            <div class="hero-pattern" aria-hidden="true"></div>
            <div class="container hero-grid">
                <div class="hero-copy reveal">
                    <p class="eyebrow">
                        <span class="eyebrow-star" aria-hidden="true">✦</span>
                        <span data-ar="تعليم متقن · أثر يدوم" data-en="Meaningful learning · Lasting impact">Meaningful learning · Lasting impact</span>
                    </p>
                    <h1 id="hero-title">
                        <span data-ar="رتّل بثقة،" data-en="Learn with heart.">Learn with heart.</span><br>
                        <em data-ar="وتعلّم بحُب." data-en="Grow with purpose.">Grow with purpose.</em>
                    </h1>
                    <p class="hero-lead" data-ar="رحلة تعليمية شخصية في القرآن الكريم واللغة العربية، مع معلمين مؤهلين يهتمون بتقدّمك خطوة بخطوة." data-en="A personal journey through Quran and Arabic with qualified teachers who care about your progress, one beautiful step at a time.">A personal journey through Quran and Arabic with qualified teachers who care about your progress, one beautiful step at a time.</p>

                    <div class="hero-actions">
                        <a href="#enroll" class="button button-large">
                            <span data-ar="احجز حصتك المجانية" data-en="Book your free trial">Book your free trial</span>
                            <span aria-hidden="true" data-ar="←" data-en="→">→</span>
                        </a>
                        <a href="#programs" class="text-link">
                            <span class="play-dot" aria-hidden="true">▶</span>
                            <span data-ar="اكتشف برامجنا" data-en="Explore our programs">Explore our programs</span>
                        </a>
                    </div>

                    <div class="trust-row">
                        <div class="avatars" aria-hidden="true"><span>م</span><span>س</span><span>ع</span><span>+</span></div>
                        <div>
                            <div class="stars" aria-hidden="true">★★★★★</div>
                            <p>
                                <strong>{{ $rating['score'] }}/{{ $rating['scale'] }}</strong>
                                <span data-ar="من عائلات حول العالم" data-en="from families worldwide">from families worldwide</span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="hero-visual reveal reveal-delay">
                    <div class="image-frame">
                        <picture>
                            <source srcset="{{ asset('images/hero-quran-online-modest.webp') }}" type="image/webp">
                            <img src="{{ asset('images/hero-quran-online-modest.png') }}"
                                 width="1536" height="1024" fetchpriority="high" decoding="async"
                                 data-alt-ar="طالبة ترتدي الحجاب تتعلّم القرآن الكريم أونلاين مع معلمتها عبر الحاسوب"
                                 data-alt-en="A hijab-wearing student learning the Quran online with her teacher"
                                 alt="A hijab-wearing student learning the Quran online with her teacher">
                        </picture>
                    </div>
                    <div class="floating-card teacher-card">
                        <span class="status-dot" aria-hidden="true"></span>
                        <div>
                            <strong data-ar="معلمون مختارون بعناية" data-en="Carefully selected teachers">Carefully selected teachers</strong>
                            <small data-ar="إجازات وخبرة تربوية" data-en="Qualified and experienced">Qualified and experienced</small>
                        </div>
                    </div>
                    <div class="floating-card schedule-card">
                        <span class="calendar-mark" aria-hidden="true">✓</span>
                        <div>
                            <strong data-ar="مواعيد مرنة" data-en="Flexible schedules">Flexible schedules</strong>
                            <small data-ar="تعلّم أينما كنت" data-en="Learn wherever you are">Learn wherever you are</small>
                        </div>
                    </div>
                    <p class="round-seal">
                        <span data-ar="حصة" data-en="FREE">FREE</span>
                        <strong data-ar="مجانية" data-en="TRIAL">TRIAL</strong>
                    </p>
                </div>
            </div>

            {{-- D. Trust / statistics strip ------------------------------------ --}}
            <div class="container stats-strip reveal">
                @foreach ($stats as $stat)
                    <div>
                        <strong data-ar="{{ $stat['value'] }}" data-en="{{ $stat['value_en'] }}">{{ $stat['value_en'] }}</strong>
                        <span data-ar="{{ $stat['ar'] }}" data-en="{{ $stat['en'] }}">{{ $stat['en'] }}</span>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- E. Programs ------------------------------------------------------ --}}
        <section class="section programs" id="programs" aria-labelledby="programs-title">
            <div class="container">
                <div class="section-heading reveal">
                    <div>
                        <span class="section-kicker" data-ar="برامجنا" data-en="Our programs">Our programs</span>
                        <h2 id="programs-title" data-ar="مسار يناسب كل هدف" data-en="A path for every goal">A path for every goal</h2>
                    </div>
                    <p data-ar="من أول حرف حتى الإتقان، نصمم تجربة تعليمية تناسب عمرك ومستواك ووتيرتك." data-en="From your first letter to confident mastery, every learning journey is shaped around your age, level, and pace.">From your first letter to confident mastery, every learning journey is shaped around your age, level, and pace.</p>
                </div>

                <div class="program-grid">
                    <article class="program-card program-featured reveal">
                        <span class="program-number" aria-hidden="true">01</span>
                        <div class="program-symbol" aria-hidden="true">۞</div>
                        <h3 data-ar="تلاوة القرآن وتجويده" data-en="Quran Reading &amp; Tajweed">Quran Reading &amp; Tajweed</h3>
                        <p data-ar="تعلّم القراءة الصحيحة وأحكام التجويد بتطبيق عملي وتغذية راجعة مستمرة في دروس فردية مباشرة." data-en="Build fluent, accurate recitation through practical Tajweed and thoughtful feedback in live one-to-one lessons.">Build fluent, accurate recitation through practical Tajweed and thoughtful feedback in live one-to-one lessons.</p>
                        <ul>
                            <li data-ar="جميع المستويات — أطفالاً وكباراً" data-en="All levels — children and adults">All levels — children and adults</li>
                            <li data-ar="دروس فردية مباشرة" data-en="Live one-to-one lessons">Live one-to-one lessons</li>
                        </ul>
                        <a href="#enroll" data-program="quran">
                            <span data-ar="اختر هذا المسار" data-en="Choose this path">Choose this path</span>
                            <span aria-hidden="true">↗</span>
                        </a>
                    </article>

                    <article class="program-card reveal">
                        <span class="program-number" aria-hidden="true">02</span>
                        <div class="program-symbol" aria-hidden="true">ح</div>
                        <h3 data-ar="حفظ القرآن ومراجعته" data-en="Quran Memorization &amp; Revision">Quran Memorization &amp; Revision</h3>
                        <p data-ar="خطة حفظ واقعية ومراجعة ذكية تثبّت المحفوظ وتبني عادة يومية جميلة تستمر معك." data-en="A realistic memorization and revision plan that makes progress steady, lasting, and part of your daily rhythm.">A realistic memorization and revision plan that makes progress steady, lasting, and part of your daily rhythm.</p>
                        <ul>
                            <li data-ar="خطة شخصية لكل طالب" data-en="A plan built per student">A plan built per student</li>
                            <li data-ar="متابعة أسبوعية للتقدّم" data-en="Weekly progress check-ins">Weekly progress check-ins</li>
                        </ul>
                        <a href="#enroll" data-program="memorization">
                            <span data-ar="اختر هذا المسار" data-en="Choose this path">Choose this path</span>
                            <span aria-hidden="true">↗</span>
                        </a>
                    </article>

                    <article class="program-card reveal">
                        <span class="program-number" aria-hidden="true">03</span>
                        <div class="program-symbol" aria-hidden="true">ض</div>
                        <h3 data-ar="اللغة العربية" data-en="Arabic Language">Arabic Language</h3>
                        <p data-ar="تحدّث واقرأ واكتب العربية بثقة من خلال دروس تفاعلية مباشرة مرتبطة بالحياة اليومية." data-en="Speak, read, and write Arabic with confidence through engaging live lessons rooted in real life.">Speak, read, and write Arabic with confidence through engaging live lessons rooted in real life.</p>
                        <ul>
                            <li data-ar="للناطقين وغير الناطقين بها" data-en="Native and non-native speakers">Native and non-native speakers</li>
                            <li data-ar="للأطفال والكبار" data-en="Children and adults">Children and adults</li>
                        </ul>
                        <a href="#enroll" data-program="arabic">
                            <span data-ar="اختر هذا المسار" data-en="Choose this path">Choose this path</span>
                            <span aria-hidden="true">↗</span>
                        </a>
                    </article>
                </div>
            </div>
        </section>

        {{-- F. Why Tarteel ---------------------------------------------------- --}}
        <section class="section why-us" id="why-us" aria-labelledby="why-title">
            <div class="container">
                <div class="why-grid">
                    <div class="why-copy reveal">
                        <span class="section-kicker light" data-ar="تعلّم مختلف" data-en="Learning, reimagined">Learning, reimagined</span>
                        <h2 id="why-title" data-ar="لأن كل طالب له حكاية" data-en="Because every learner has a story">Because every learner has a story</h2>
                        <p data-ar="لا نؤمن بالدروس الجاهزة للجميع. نبدأ بالتعرّف عليك، ثم نبني مساراً يساعدك على الاستمرار والاستمتاع والنجاح." data-en="We do not believe in one-size-fits-all lessons. We get to know you first, then shape a path that helps you stay inspired and succeed.">We do not believe in one-size-fits-all lessons. We get to know you first, then shape a path that helps you stay inspired and succeed.</p>
                        <a href="#enroll" class="button button-cream" data-ar="قابل معلمك المناسب" data-en="Meet your ideal teacher">Meet your ideal teacher</a>
                    </div>

                    <div class="benefit-grid">
                        <article class="benefit-card reveal">
                            <span aria-hidden="true">01</span>
                            <h3 data-ar="تعليم فردي" data-en="Truly personal">Truly personal</h3>
                            <p data-ar="تركيز كامل على احتياجاتك وسرعة تعلّمك في كل حصة." data-en="Full attention on your needs and your pace, every single lesson.">Full attention on your needs and your pace, every single lesson.</p>
                        </article>
                        <article class="benefit-card reveal">
                            <span aria-hidden="true">02</span>
                            <h3 data-ar="معلمون نثق بهم" data-en="Teachers we trust">Teachers we trust</h3>
                            <p data-ar="اختيار دقيق، كفاءة علمية، وقلب معلّم يهتم فعلاً." data-en="Carefully selected for knowledge, teaching skill, and genuine care.">Carefully selected for knowledge, teaching skill, and genuine care.</p>
                        </article>
                        <article class="benefit-card reveal">
                            <span aria-hidden="true">03</span>
                            <h3 data-ar="مرونة حقيقية" data-en="Real flexibility">Real flexibility</h3>
                            <p data-ar="مواعيد تناسب منطقتك الزمنية وحياتك اليومية." data-en="Lessons that fit your time zone and your everyday life.">Lessons that fit your time zone and your everyday life.</p>
                        </article>
                        <article class="benefit-card reveal">
                            <span aria-hidden="true">04</span>
                            <h3 data-ar="تقدّم واضح" data-en="Progress you can see">Progress you can see</h3>
                            <p data-ar="أهداف صغيرة قابلة للقياس وتقارير دورية تطمئنك." data-en="Small measurable goals and regular reports that keep you reassured.">Small measurable goals and regular reports that keep you reassured.</p>
                        </article>
                    </div>
                </div>

                <figure class="why-figure reveal">
                    <picture>
                        <source srcset="{{ asset('images/quran-arabic-study-flatlay.webp') }}" type="image/webp">
                        <img src="{{ asset('images/quran-arabic-study-flatlay.png') }}"
                             width="1448" height="1086" loading="lazy" decoding="async"
                             data-alt-ar="مصحف على رحل خشبي بجانب دفتر تدريبات عربية وقلم، في ركن دراسة هادئ"
                             data-alt-en="A Quran resting on a wooden rehal beside an Arabic practice notebook and pen in a calm study corner"
                             alt="A Quran resting on a wooden rehal beside an Arabic practice notebook and pen in a calm study corner">
                    </picture>
                    <figcaption>
                        <strong data-ar="طريقتنا في التعلّم" data-en="How our lessons feel">How our lessons feel</strong>
                        <span data-ar="مصحف مفتوح، دفتر تدريبات، ومعلّم يصغي: أدوات بسيطة وخطة واضحة تجعل كل حصة خطوة حقيقية إلى الأمام." data-en="An open Quran, a practice notebook, and a teacher who listens: simple tools and a clear plan that turn every lesson into real progress.">An open Quran, a practice notebook, and a teacher who listens: simple tools and a clear plan that turn every lesson into real progress.</span>
                    </figcaption>
                </figure>
            </div>
        </section>

        {{-- G. How it works --------------------------------------------------- --}}
        <section class="section journey" id="journey" aria-labelledby="journey-title">
            <div class="container">
                <div class="center-heading reveal">
                    <span class="section-kicker" data-ar="بداية سهلة" data-en="A simple beginning">A simple beginning</span>
                    <h2 id="journey-title" data-ar="ثلاث خطوات، ورحلتك تبدأ" data-en="Three steps. One beautiful journey.">Three steps. One beautiful journey.</h2>
                </div>
                <div class="steps">
                    <article class="step reveal">
                        <span class="step-index" aria-hidden="true">١</span>
                        <div class="step-line" aria-hidden="true"></div>
                        <h3 data-ar="أخبرنا عن هدفك" data-en="Tell us your goal">Tell us your goal</h3>
                        <p data-ar="املأ النموذج القصير وسنتعرّف على مستواك واحتياجك." data-en="Complete the short form so we understand your level and your needs.">Complete the short form so we understand your level and your needs.</p>
                    </article>
                    <article class="step reveal">
                        <span class="step-index" aria-hidden="true">٢</span>
                        <div class="step-line" aria-hidden="true"></div>
                        <h3 data-ar="جرّب حصتك المجانية" data-en="Enjoy a free trial">Enjoy a free trial</h3>
                        <p data-ar="قابل معلماً مناسباً واكتشف أسلوبنا دون أي التزام." data-en="Meet a matched teacher and experience our approach, commitment-free.">Meet a matched teacher and experience our approach, commitment-free.</p>
                    </article>
                    <article class="step reveal">
                        <span class="step-index" aria-hidden="true">٣</span>
                        <h3 data-ar="ابدأ مسارك الخاص" data-en="Begin your own path">Begin your own path</h3>
                        <p data-ar="نصمم جدولك وخطتك، ونبقى معك في كل خطوة." data-en="We shape your schedule and plan, then support every step forward.">We shape your schedule and plan, then support every step forward.</p>
                    </article>
                </div>
            </div>
        </section>

        {{-- H. Real lesson clips ---------------------------------------------- --}}
        <section class="section classroom" id="classroom" aria-labelledby="classroom-title">
            <div class="container">
                <div class="section-heading classroom-heading reveal">
                    <div>
                        <span class="section-kicker" data-ar="من داخل فصولنا" data-en="Inside our classrooms">Inside our classrooms</span>
                        <h2 id="classroom-title" data-ar="شاهد التعلّم كما يحدث" data-en="See learning in action">See learning in action</h2>
                    </div>
                    <p data-ar="لقطات حقيقية قصيرة من حصص القرآن واللغة العربية المباشرة، لتتعرّف على أسلوب معلمينا قبل أن تبدأ." data-en="A few short, real moments from our live Quran and Arabic lessons, so you can experience our teaching style before you begin.">A few short, real moments from our live Quran and Arabic lessons, so you can experience our teaching style before you begin.</p>
                </div>

                <div class="classroom-grid">
                    <article class="lesson-video-card reveal">
                        <div class="lesson-video-frame">
                            <video controls playsinline preload="none"
                                poster="{{ asset('images/arabic-reading-lesson-poster.jpg') }}"
                                data-label-ar="مقطع من حصة قراءة باللغة العربية"
                                data-label-en="A clip from a live Arabic reading lesson"
                                aria-label="A clip from a live Arabic reading lesson">
                                <source src="{{ asset('videos/arabic-reading-lesson.mp4') }}" type="video/mp4">
                                <span data-ar="متصفحك لا يدعم تشغيل الفيديو." data-en="Your browser does not support video playback.">Your browser does not support video playback.</span>
                            </video>
                            <span class="lesson-duration" aria-hidden="true">01:04</span>
                        </div>
                        <div class="lesson-video-copy">
                            <span class="lesson-type" data-ar="اللغة العربية" data-en="Arabic language">Arabic language</span>
                            <h3 data-ar="قراءة وتصحيح مباشر" data-en="Live reading and correction">Live reading and correction</h3>
                            <p data-ar="يتدرّب الطالب على القراءة بصوت واضح، مع تصحيح لطيف وفوري من المعلّم." data-en="The learner reads aloud while the teacher offers gentle, immediate guidance.">The learner reads aloud while the teacher offers gentle, immediate guidance.</p>
                        </div>
                    </article>

                    <article class="lesson-video-card reveal">
                        <div class="lesson-video-frame">
                            <video controls playsinline preload="none"
                                poster="{{ asset('images/quran-recitation-lesson-poster.jpg') }}"
                                data-label-ar="مقطع من حصة تلاوة القرآن"
                                data-label-en="A clip from a live Quran recitation lesson"
                                aria-label="A clip from a live Quran recitation lesson">
                                <source src="{{ asset('videos/quran-recitation-lesson.mp4') }}" type="video/mp4">
                                <span data-ar="متصفحك لا يدعم تشغيل الفيديو." data-en="Your browser does not support video playback.">Your browser does not support video playback.</span>
                            </video>
                            <span class="lesson-duration" aria-hidden="true">00:45</span>
                        </div>
                        <div class="lesson-video-copy">
                            <span class="lesson-type" data-ar="القرآن الكريم" data-en="Holy Quran">Holy Quran</span>
                            <h3 data-ar="تلاوة وتطبيق أحكام التجويد" data-en="Recitation with practical Tajweed">Recitation with practical Tajweed</h3>
                            <p data-ar="تطبيق عملي لأحكام التجويد من المصحف، خطوة بخطوة ومع متابعة فردية." data-en="Practical Tajweed directly from the Mushaf, taught step by step with personal attention.">Practical Tajweed directly from the Mushaf, taught step by step with personal attention.</p>
                        </div>
                    </article>

                    <article class="lesson-video-card reveal">
                        <div class="lesson-video-frame">
                            <video controls playsinline preload="none"
                                poster="{{ asset('images/arabic-interactive-lesson-poster.jpg') }}"
                                data-label-ar="مقطع من حصة عربية تفاعلية"
                                data-label-en="A clip from an interactive Arabic lesson"
                                aria-label="A clip from an interactive Arabic lesson">
                                <source src="{{ asset('videos/arabic-interactive-lesson.mp4') }}" type="video/mp4">
                                <span data-ar="متصفحك لا يدعم تشغيل الفيديو." data-en="Your browser does not support video playback.">Your browser does not support video playback.</span>
                            </video>
                            <span class="lesson-duration" aria-hidden="true">02:16</span>
                        </div>
                        <div class="lesson-video-copy">
                            <span class="lesson-type" data-ar="تعلّم تفاعلي" data-en="Interactive learning">Interactive learning</span>
                            <h3 data-ar="شرح ومشاركة على الشاشة" data-en="Guided on-screen practice">Guided on-screen practice</h3>
                            <p data-ar="تمارين مرئية ومشاركة مباشرة تجعل الحصة سهلة التركيز وأكثر تفاعلاً." data-en="Visual exercises and live participation keep every lesson focused and engaging.">Visual exercises and live participation keep every lesson focused and engaging.</p>
                        </div>
                    </article>
                </div>

                <div class="classroom-cta reveal">
                    <p data-ar="هل تريد تجربة الأسلوب بنفسك؟ حصتك الأولى مجانية." data-en="Ready to experience it yourself? Your first lesson is free.">Ready to experience it yourself? Your first lesson is free.</p>
                    <a href="#enroll" class="button button-small">
                        <span data-ar="احجز حصتك" data-en="Book your trial">Book your trial</span>
                        <span aria-hidden="true">←</span>
                    </a>
                </div>
            </div>
        </section>

        {{-- I. Pricing -------------------------------------------------------- --}}
        <section class="section pricing" id="pricing" aria-labelledby="pricing-title">
            <div class="container">
                <div class="section-heading reveal">
                    <div>
                        <span class="section-kicker" data-ar="الأسعار" data-en="Pricing">Pricing</span>
                        <h2 id="pricing-title" data-ar="خطط واضحة، بلا رسوم خفية" data-en="Clear plans, no hidden fees">Clear plans, no hidden fees</h2>
                    </div>
                    <p data-ar="اختر مدة الحصة التي تناسبك، ثم عدد الحصص أسبوعياً. الأسعار شهرية بالدولار الأمريكي، وكل حصة فردية مباشرة مع معلمك." data-en="Choose the lesson length that suits you, then how many lessons a week. Prices are monthly in US dollars, and every lesson is live and one-to-one.">Choose the lesson length that suits you, then how many lessons a week. Prices are monthly in US dollars, and every lesson is live and one-to-one.</p>
                </div>

                <div class="pricing-grid">
                    @foreach ($pricing['packages'] as $package)
                        <article class="pricing-card @if ($package['featured']) pricing-featured @endif reveal">
                            <div class="pricing-head">
                                <span class="pricing-minutes" aria-hidden="true">
                                    <strong>{{ $package['minutes'] }}</strong>
                                    <small data-ar="دقيقة" data-en="min">min</small>
                                </span>
                                <h3 data-ar="{{ $package['name_ar'] }}" data-en="{{ $package['name_en'] }}">{{ $package['name_en'] }}</h3>
                                <p class="pricing-tagline" data-ar="{{ $package['tagline_ar'] }}" data-en="{{ $package['tagline_en'] }}">{{ $package['tagline_en'] }}</p>
                                <p class="pricing-rate">
                                    <strong dir="ltr">{{ $pricing['symbol'] }}{{ $package['per_class'] }}</strong>
                                    <span data-ar="لكل حصة" data-en="per lesson">per lesson</span>
                                </p>
                            </div>

                            <ul class="pricing-tiers">
                                @foreach ($package['tiers'] as $tier)
                                    @php
                                        // Arabic counts its nouns differently either side of ten:
                                        // two takes the dual, three to ten the plural, eleven up
                                        // the singular. English just needs the plural.
                                        $weekAr = $tier['week'] === 2
                                            ? 'حصتان أسبوعياً'
                                            : $tier['week'] . ' حصص أسبوعياً';
                                        $monthAr = $tier['month'] <= 10
                                            ? $tier['month'] . ' حصص شهرياً'
                                            : $tier['month'] . ' حصة شهرياً';
                                    @endphp
                                    <li>
                                        <span class="tier-week" data-ar="{{ $weekAr }}" data-en="{{ $tier['week'] }} lessons a week">{{ $tier['week'] }} lessons a week</span>
                                        <span class="tier-month" data-ar="{{ $monthAr }}" data-en="{{ $tier['month'] }} lessons a month">{{ $tier['month'] }} lessons a month</span>
                                        <span class="tier-price">
                                            <strong dir="ltr">{{ $pricing['symbol'] }}{{ $tier['price'] }}</strong>
                                            <small data-ar="شهرياً" data-en="a month">a month</small>
                                        </span>
                                    </li>
                                @endforeach
                            </ul>

                            <a class="pricing-cta" href="#enroll">
                                <span data-ar="ابدأ بهذه الباقة" data-en="Start with this plan">Start with this plan</span>
                                <span aria-hidden="true">↗</span>
                            </a>
                        </article>
                    @endforeach
                </div>

                <div class="pricing-extras reveal">
                    <h3 class="pricing-extras-title" data-ar="ما الذي تحصل عليه في كل باقة؟" data-en="What every plan includes">What every plan includes</h3>
                    <ul class="pricing-includes">
                        @foreach ($pricing['includes'] as $include)
                            <li>
                                <span class="include-tick" aria-hidden="true">✓</span>
                                <span data-ar="{{ $include['ar'] }}" data-en="{{ $include['en'] }}">{{ $include['en'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <p class="pricing-note" data-ar="حصتك التجريبية الأولى مجانية دائماً، ولا يوجد رسم تسجيل. إن لم تجد ما يناسبك هنا، راسلنا ونرتّب خطة على مقاسك." data-en="Your first trial lesson is always free and there is no registration fee. If none of these fit, message us and we will arrange a plan around you.">Your first trial lesson is always free and there is no registration fee. If none of these fit, message us and we will arrange a plan around you.</p>
                </div>
            </div>
        </section>

        {{-- J. Testimonials --------------------------------------------------- --}}
        <section class="section stories" id="stories" aria-labelledby="stories-title">
            <div class="container">
                <div class="section-heading reveal">
                    <div>
                        <span class="section-kicker" data-ar="قصص حقيقية" data-en="Real stories">Real stories</span>
                        <h2 id="stories-title" data-ar="محبة نتشاركها" data-en="Learning families love">Learning families love</h2>
                    </div>
                    <div class="story-rating">
                        <strong>{{ $rating['score'] }}</strong>
                        <span aria-hidden="true">★★★★★</span>
                        <small data-ar="متوسط تقييم أولياء الأمور" data-en="Average parent rating">Average parent rating</small>
                    </div>
                </div>

                <div class="story-grid">
                    @foreach ($testimonials as $testimonial)
                        <blockquote class="story-card reveal">
                            <span class="quote-mark" aria-hidden="true">“</span>
                            <p data-ar="{{ $testimonial['quote_ar'] }}" data-en="{{ $testimonial['quote_en'] }}">{{ $testimonial['quote_en'] }}</p>
                            <footer>
                                <span class="person-avatar" aria-hidden="true"
                                      data-ar="{{ $testimonial['initials_ar'] }}"
                                      data-en="{{ $testimonial['initials_en'] }}">{{ $testimonial['initials_en'] }}</span>
                                <div>
                                    <strong data-ar="{{ $testimonial['name_ar'] }}" data-en="{{ $testimonial['name_en'] }}">{{ $testimonial['name_en'] }}</strong>
                                    <small data-ar="{{ $testimonial['role_ar'] }}" data-en="{{ $testimonial['role_en'] }}">{{ $testimonial['role_en'] }}</small>
                                </div>
                            </footer>
                        </blockquote>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- K. FAQ ------------------------------------------------------------ --}}
        <section class="section faq" id="faq" aria-labelledby="faq-title">
            <div class="container faq-grid">
                <div class="faq-intro reveal">
                    <span class="section-kicker" data-ar="لديك سؤال؟" data-en="Good to know">Good to know</span>
                    <h2 id="faq-title" data-ar="إجابات واضحة قبل أن تبدأ" data-en="Clear answers before you begin">Clear answers before you begin</h2>
                    <p data-ar="وإذا لم تجد إجابتك، أرسل طلب التسجيل وسيتواصل معك فريقنا." data-en="If you do not see your question, send an enrollment request and our team will help.">If you do not see your question, send an enrollment request and our team will help.</p>
                </div>
                <div class="accordion reveal">
                    <details open>
                        <summary data-ar="هل الحصة التجريبية مجانية فعلاً؟" data-en="Is the trial really free?">Is the trial really free?</summary>
                        <p data-ar="نعم، حصة تعارف وتقييم مجانية تماماً ودون التزام، نحدد خلالها مستواك ونقترح المسار الأنسب لك." data-en="Yes. It is a completely free, commitment-free introduction and assessment where we understand your level and recommend the right path.">Yes. It is a completely free, commitment-free introduction and assessment where we understand your level and recommend the right path.</p>
                    </details>
                    <details>
                        <summary data-ar="هل تقبلون الأطفال والمبتدئين تماماً؟" data-en="Do you teach children and complete beginners?">Do you teach children and complete beginners?</summary>
                        <p data-ar="بالتأكيد. برامجنا تبدأ من عمر 4 سنوات، ولدينا معلمون متخصصون في تعليم الصغار والمبتدئين من الصفر." data-en="Absolutely. Programs start from age four, and we have teachers who specialise in young learners and in complete beginners.">Absolutely. Programs start from age four, and we have teachers who specialise in young learners and in complete beginners.</p>
                    </details>
                    <details>
                        <summary data-ar="ما اللغات التي يستخدمها المعلمون؟" data-en="Which languages do teachers use?">Which languages do teachers use?</summary>
                        <p data-ar="يمكن تقديم الشرح بالعربية أو الإنجليزية أو كليهما، وتختار لغة الشرح المناسبة عند التسجيل." data-en="Lessons can be supported in Arabic, English, or both — you choose your preferred support language when you enrol.">Lessons can be supported in Arabic, English, or both — you choose your preferred support language when you enrol.</p>
                    </details>
                    <details>
                        <summary data-ar="هل يمكن تعديل المواعيد لاحقاً؟" data-en="Can schedules be changed later?">Can schedules be changed later?</summary>
                        <p data-ar="نعم، نوفر مواعيد مرنة ونساعدك في اختيار بديل مناسب عند تغيّر ظروفك أو منطقتك الزمنية." data-en="Yes. We keep schedules flexible and help you find a suitable alternative whenever your circumstances or time zone change.">Yes. We keep schedules flexible and help you find a suitable alternative whenever your circumstances or time zone change.</p>
                    </details>
                </div>
            </div>
        </section>

        {{-- L. Enrollment ------------------------------------------------------ --}}
        <section class="section enrollment-section" id="enroll" aria-labelledby="enroll-title">
            <div class="container enrollment-wrap">
                <div class="enrollment-copy reveal">
                    <span class="section-kicker light" data-ar="خطوتك الأولى" data-en="Your first step">Your first step</span>
                    <h2 id="enroll-title" data-ar="ابدأ رحلتك اليوم" data-en="Start your journey today">Start your journey today</h2>
                    <p data-ar="املأ النموذج وسيتواصل معك فريقنا خلال 24 ساعة لترتيب حصتك المجانية." data-en="Complete the form and our team will contact you within 24 hours to arrange your free trial.">Complete the form and our team will contact you within 24 hours to arrange your free trial.</p>
                    <div class="enrollment-promises">
                        <span><span aria-hidden="true">✓</span> <b data-ar="بدون رسوم تسجيل" data-en="No registration fee">No registration fee</b></span>
                        <span><span aria-hidden="true">✓</span> <b data-ar="بدون أي التزام" data-en="No commitment">No commitment</b></span>
                        <span><span aria-hidden="true">✓</span> <b data-ar="اختيار معلم مناسب لك" data-en="A thoughtful teacher match">A thoughtful teacher match</b></span>
                    </div>
                    <div class="contact-note">
                        <small data-ar="تفضّل التواصل مباشرة؟" data-en="Prefer to contact us directly?">Prefer to contact us directly?</small>
                        <a href="mailto:{{ $contact['email'] }}">{{ $contact['email'] }}</a>
                        @unless ($phoneIsPlaceholder)
                            <a href="tel:{{ $contact['phone'] }}" dir="ltr">{{ $contact['phone_display'] }}</a>
                        @endunless
                        @if ($whatsapp)
                            <a href="{{ $whatsapp }}" target="_blank" rel="noopener">
                                <span data-ar="راسلنا على واتساب" data-en="Message us on WhatsApp">Message us on WhatsApp</span>
                            </a>
                        @endif
                    </div>
                </div>

                <div class="enrollment-form-card reveal">
                    @if ($successLocale)
                        <div class="form-success" role="status">
                            <span aria-hidden="true">✓</span>
                            <div>
                                <strong data-ar="شكراً لك! تم استلام طلبك." data-en="Thank you! Your request is in.">{{ $successLocale === 'en' ? 'Thank you! Your request is in.' : 'شكراً لك! تم استلام طلبك.' }}</strong>
                                <p data-ar="سيتواصل معك فريقنا خلال 24 ساعة لترتيب حصتك التجريبية." data-en="Our team will be in touch within 24 hours to arrange your trial lesson.">{{ $successLocale === 'en' ? 'Our team will be in touch within 24 hours to arrange your trial lesson.' : 'سيتواصل معك فريقنا خلال 24 ساعة لترتيب حصتك التجريبية.' }}</p>
                            </div>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="form-errors" role="alert">
                            <strong data-ar="يرجى مراجعة الحقول التالية:" data-en="Please review the highlighted fields:">Please review the highlighted fields:</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('enrollments.store') }}" method="POST" id="enrollment-form" novalidate>
                        @csrf
                        <input type="hidden" name="source_locale" id="source_locale" value="{{ old('source_locale', 'en') }}">

                        <div class="form-heading">
                            <span aria-hidden="true">01</span>
                            <div>
                                <h3 data-ar="عرّفنا بك" data-en="Tell us about you">Tell us about you</h3>
                                <p data-ar="يستغرق أقل من دقيقة" data-en="It takes less than a minute">It takes less than a minute</p>
                            </div>
                        </div>

                        {{-- Anti-spam honeypot: hidden from people and screen readers alike. --}}
                        <div class="honeypot" aria-hidden="true">
                            <label for="website">Website</label>
                            <input type="text" name="website" id="website" tabindex="-1" autocomplete="off">
                        </div>

                        <div class="form-grid">
                            <label for="name">
                                <span data-ar="الاسم الكامل *" data-en="Full name *">Full name *</span>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required maxlength="120" autocomplete="name"
                                       @error('name') aria-invalid="true" aria-describedby="name-error" @enderror
                                       data-placeholder-ar="مثال: أحمد محمد" data-placeholder-en="e.g. Ahmed Mohamed" placeholder="e.g. Ahmed Mohamed">
                                @error('name')<span class="field-error" id="name-error">{{ $message }}</span>@enderror
                            </label>

                            <label for="email">
                                <span data-ar="البريد الإلكتروني *" data-en="Email address *">Email address *</span>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" required maxlength="180" autocomplete="email" dir="ltr"
                                       @error('email') aria-invalid="true" aria-describedby="email-error" @enderror
                                       placeholder="name@example.com">
                                @error('email')<span class="field-error" id="email-error">{{ $message }}</span>@enderror
                            </label>

                            <label for="phone">
                                <span data-ar="رقم الهاتف / واتساب *" data-en="Phone / WhatsApp *">Phone / WhatsApp *</span>
                                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required maxlength="40" autocomplete="tel" dir="ltr"
                                       @error('phone') aria-invalid="true" aria-describedby="phone-error" @enderror
                                       placeholder="+20 100 000 0000">
                                @error('phone')<span class="field-error" id="phone-error">{{ $message }}</span>@enderror
                            </label>

                            <label for="country">
                                <span data-ar="الدولة" data-en="Country">Country</span>
                                <input type="text" name="country" id="country" value="{{ old('country') }}" maxlength="100" autocomplete="country-name"
                                       @error('country') aria-invalid="true" aria-describedby="country-error" @enderror
                                       data-placeholder-ar="مثال: مصر" data-placeholder-en="e.g. Egypt" placeholder="e.g. Egypt">
                                @error('country')<span class="field-error" id="country-error">{{ $message }}</span>@enderror
                            </label>

                            <label for="student_type">
                                <span data-ar="التسجيل لـ *" data-en="Student is *">Student is *</span>
                                <select name="student_type" id="student_type" required @error('student_type') aria-invalid="true" @enderror>
                                    <option value="" data-ar="اختر" data-en="Select">Select</option>
                                    @foreach (config('tarteel.enums.student_type') as $value => $labels)
                                        <option value="{{ $value }}" @selected(old('student_type') === $value) data-ar="{{ $labels['ar'] }}" data-en="{{ $labels['en'] }}">{{ $labels['en'] }}</option>
                                    @endforeach
                                </select>
                                @error('student_type')<span class="field-error">{{ $message }}</span>@enderror
                            </label>

                            <label for="age">
                                <span data-ar="العمر" data-en="Age">Age</span>
                                <input type="number" name="age" id="age" value="{{ old('age') }}" min="4" max="100" inputmode="numeric" dir="ltr"
                                       @error('age') aria-invalid="true" aria-describedby="age-error" @enderror placeholder="12">
                                @error('age')<span class="field-error" id="age-error">{{ $message }}</span>@enderror
                            </label>

                            <label for="program">
                                <span data-ar="البرنامج المطلوب *" data-en="Program of interest *">Program of interest *</span>
                                <select name="program" id="program" required @error('program') aria-invalid="true" @enderror>
                                    <option value="" data-ar="اختر البرنامج" data-en="Select a program">Select a program</option>
                                    @foreach (config('tarteel.enums.program') as $value => $labels)
                                        <option value="{{ $value }}" @selected(old('program') === $value) data-ar="{{ $labels['ar'] }}" data-en="{{ $labels['en'] }}">{{ $labels['en'] }}</option>
                                    @endforeach
                                </select>
                                @error('program')<span class="field-error">{{ $message }}</span>@enderror
                            </label>

                            <label for="preferred_language">
                                <span data-ar="لغة الشرح *" data-en="Support language *">Support language *</span>
                                <select name="preferred_language" id="preferred_language" required @error('preferred_language') aria-invalid="true" @enderror>
                                    <option value="" data-ar="اختر" data-en="Select">Select</option>
                                    @foreach (config('tarteel.enums.preferred_language') as $value => $labels)
                                        <option value="{{ $value }}" @selected(old('preferred_language') === $value) data-ar="{{ $labels['ar'] }}" data-en="{{ $labels['en'] }}">{{ $labels['en'] }}</option>
                                    @endforeach
                                </select>
                                @error('preferred_language')<span class="field-error">{{ $message }}</span>@enderror
                            </label>

                            <label class="full-field" for="availability">
                                <span data-ar="الأوقات المناسبة" data-en="Preferred days and times">Preferred days and times</span>
                                <input type="text" name="availability" id="availability" value="{{ old('availability') }}" maxlength="120"
                                       @error('availability') aria-invalid="true" @enderror
                                       data-placeholder-ar="مثال: الأحد والثلاثاء مساءً" data-placeholder-en="e.g. Sunday and Tuesday evenings" placeholder="e.g. Sunday and Tuesday evenings">
                                @error('availability')<span class="field-error">{{ $message }}</span>@enderror
                            </label>

                            <label class="full-field" for="message">
                                <span data-ar="ملاحظات إضافية أو مستواك الحالي" data-en="Anything else we should know?">Anything else we should know?</span>
                                <textarea name="message" id="message" rows="3" maxlength="1500"
                                          @error('message') aria-invalid="true" @enderror
                                          data-placeholder-ar="أخبرنا عن المستوى الحالي أو أهدافك..." data-placeholder-en="Tell us about the current level or your goals..."
                                          placeholder="Tell us about the current level or your goals...">{{ old('message') }}</textarea>
                                @error('message')<span class="field-error">{{ $message }}</span>@enderror
                            </label>
                        </div>

                        <button class="button submit-button" type="submit">
                            <span data-ar="أرسل طلب الحصة المجانية" data-en="Request my free trial">Request my free trial</span>
                            <span aria-hidden="true" data-ar="←" data-en="→">→</span>
                        </button>
                        <p class="privacy-note">
                            <span aria-hidden="true">⌁</span>
                            <span data-ar="بياناتك آمنة ولن نشاركها مع أي جهة." data-en="Your information is private and never shared.">Your information is private and never shared.</span>
                        </p>
                    </form>
                </div>
            </div>
        </section>
    </main>

    {{-- M. Footer ------------------------------------------------------------ --}}
    <footer class="site-footer">
        <div class="container footer-main">
            <div class="footer-brand">
                <a href="#top" class="brand brand-light">
                    <picture>
                        <source srcset="{{ asset('images/tarteel-academy-logo-160.webp') }}" type="image/webp">
                        <img src="{{ asset('images/tarteel-academy-logo-160.png') }}" width="160" height="160" alt="" aria-hidden="true">
                    </picture>
                    <span class="brand-copy">
                        <strong data-ar="أكاديمية ترتيل" data-en="Tarteel Academy">Tarteel Academy</strong>
                        <small data-ar="للقرآن واللغة العربية" data-en="Quran &amp; Arabic online">Quran &amp; Arabic online</small>
                    </span>
                </a>
                <p data-ar="نصنع تجربة تعليمية تجمع بين الإتقان والرفق، وتصل إلى بيتك أينما كنت." data-en="Meaningful Quran and Arabic learning, taught with excellence and care — wherever you call home.">Meaningful Quran and Arabic learning, taught with excellence and care — wherever you call home.</p>
            </div>

            <div>
                <h4 data-ar="استكشف" data-en="Explore">Explore</h4>
                <a href="#programs" data-ar="البرامج" data-en="Programs">Programs</a>
                <a href="#why-us" data-ar="لماذا ترتيل؟" data-en="Why Tarteel">Why Tarteel</a>
                <a href="#classroom" data-ar="من فصولنا" data-en="Our classes">Our classes</a>
                <a href="#stories" data-ar="قصص الطلاب" data-en="Student stories">Student stories</a>
                <a href="#faq" data-ar="الأسئلة الشائعة" data-en="FAQ">FAQ</a>
            </div>

            <div>
                <h4 data-ar="تواصل معنا" data-en="Contact">Contact</h4>
                <a href="mailto:{{ $contact['email'] }}" dir="ltr">{{ $contact['email'] }}</a>
                @unless ($phoneIsPlaceholder)
                    <a href="tel:{{ $contact['phone'] }}" dir="ltr">{{ $contact['phone_display'] }}</a>
                @endunless
                @if ($whatsapp)
                    <a href="{{ $whatsapp }}" target="_blank" rel="noopener" data-ar="واتساب" data-en="WhatsApp">WhatsApp</a>
                @endif
                <span data-ar="متاحون عالمياً · عبر الإنترنت" data-en="Worldwide · Online">Worldwide · Online</span>
                @if ($social)
                    <div class="footer-social">
                        @foreach ($social as $network => $url)
                            <a href="{{ $url }}" rel="me noopener" target="_blank">{{ ucfirst($network) }}</a>
                        @endforeach
                    </div>
                @endif
            </div>

            <div>
                <h4 data-ar="جاهز للبدء؟" data-en="Ready to begin?">Ready to begin?</h4>
                <p data-ar="حصتك الأولى علينا." data-en="Your first lesson is on us.">Your first lesson is on us.</p>
                <a class="button button-small button-cream" href="#enroll" data-ar="احجز الآن" data-en="Book now">Book now</a>
            </div>
        </div>

        <div class="container footer-bottom">
            <p><span dir="ltr">© {{ date('Y') }} Tarteel Academy</span> · <span data-ar="جميع الحقوق محفوظة." data-en="All rights reserved.">All rights reserved.</span></p>
            <div class="footer-bottom-links">
                <a href="{{ route('admin.login') }}" rel="nofollow" data-ar="دخول الإدارة" data-en="Admin">Admin</a>
                <button class="footer-lang language-switch" type="button" data-label-ar="التبديل إلى الإنجليزية" data-label-en="Switch to Arabic" aria-label="Switch to Arabic">
                    <span data-locale="ar">ع</span><span data-locale="en" class="lang-active">EN</span>
                </button>
            </div>
        </div>
    </footer>

    @if ($whatsapp)
        {{-- Floating chat button. Mirrors to the inline-start corner in RTL. --}}
        <a class="whatsapp-fab" href="{{ $whatsapp }}" target="_blank" rel="noopener"
           data-label-ar="تواصل معنا عبر واتساب" data-label-en="Chat with us on WhatsApp"
           aria-label="Chat with us on WhatsApp">
            <svg class="whatsapp-fab-icon" viewBox="0 0 24 24" width="26" height="26" aria-hidden="true" focusable="false">
                <path fill="currentColor" d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2 22l5.25-1.38a9.9 9.9 0 0 0 4.79 1.22h.01c5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2Zm0 18.15h-.01a8.23 8.23 0 0 1-4.19-1.15l-.3-.18-3.12.82.83-3.04-.2-.31a8.2 8.2 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.25-8.24 2.2 0 4.27.86 5.83 2.42a8.19 8.19 0 0 1 2.41 5.83c0 4.54-3.7 8.23-8.24 8.23Zm4.52-6.16c-.25-.12-1.47-.72-1.69-.81-.23-.08-.39-.12-.56.13-.16.24-.64.8-.78.97-.15.16-.29.18-.54.06-.25-.12-1.05-.39-1.99-1.23-.74-.66-1.23-1.47-1.38-1.72-.14-.25-.01-.38.11-.5.11-.11.25-.29.37-.44.12-.15.16-.25.25-.42.08-.16.04-.31-.02-.43-.06-.12-.56-1.34-.76-1.84-.2-.48-.4-.42-.56-.43h-.47c-.16 0-.43.06-.65.31-.22.25-.85.84-.85 2.04s.87 2.37 1 2.53c.12.16 1.71 2.62 4.15 3.67.58.25 1.03.4 1.39.51.58.19 1.11.16 1.53.1.47-.07 1.47-.6 1.67-1.18.21-.58.21-1.07.15-1.18-.06-.11-.22-.17-.47-.29Z"/>
            </svg>
            <span class="whatsapp-fab-label" data-ar="راسلنا" data-en="Chat">Chat</span>
        </a>
    @endif
</body>
</html>

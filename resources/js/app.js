/**
 * Tarteel Academy — public page behaviour.
 *
 * Deliberately small and dependency-free: language switching, the mobile menu,
 * program pre-selection, and a light reveal-on-scroll effect. Every string the
 * visitor reads lives in the markup as `data-ar` / `data-en`, so nothing here
 * needs translating at runtime.
 */

const STORAGE_KEY = 'tarteel.locale';
const LOCALES = ['ar', 'en'];

const META = {
    ar: {
        title: 'أكاديمية ترتيل | تعليم القرآن واللغة العربية أونلاين',
        description:
            'أكاديمية ترتيل تقدّم دروساً فردية مباشرة في تلاوة القرآن والتجويد والحفظ واللغة العربية للأطفال والكبار، مع معلمين مؤهلين ومواعيد مرنة. احجز حصتك التجريبية المجانية.',
    },
    en: {
        title: 'Tarteel Academy | Online Quran & Arabic Lessons',
        description:
            'Tarteel Academy offers live one-to-one Quran, Tajweed, memorization and Arabic lessons for children and adults, with qualified teachers and flexible schedules. Book your free trial lesson.',
    },
};

/** Read the visitor's saved language, defaulting to English. */
function storedLocale() {
    try {
        const saved = window.localStorage.getItem(STORAGE_KEY);

        return LOCALES.includes(saved) ? saved : 'en';
    } catch {
        return 'en';
    }
}

function rememberLocale(locale) {
    try {
        window.localStorage.setItem(STORAGE_KEY, locale);
    } catch {
        /* Private browsing: the page still works, the choice just is not kept. */
    }
}

function applyLocale(locale) {
    const root = document.documentElement;

    root.lang = locale;
    root.dir = locale === 'ar' ? 'rtl' : 'ltr';
    root.dataset.locale = locale;

    document.title = META[locale].title;

    const description = document.querySelector('meta[name="description"]');
    if (description) {
        description.setAttribute('content', META[locale].description);
    }

    document.querySelectorAll('[data-ar][data-en]').forEach((node) => {
        node.textContent = node.dataset[locale];
    });

    document.querySelectorAll('[data-placeholder-ar][data-placeholder-en]').forEach((node) => {
        node.placeholder = locale === 'ar' ? node.dataset.placeholderAr : node.dataset.placeholderEn;
    });

    document.querySelectorAll('[data-alt-ar][data-alt-en]').forEach((node) => {
        node.alt = locale === 'ar' ? node.dataset.altAr : node.dataset.altEn;
    });

    document.querySelectorAll('[data-label-ar][data-label-en]').forEach((node) => {
        node.setAttribute('aria-label', locale === 'ar' ? node.dataset.labelAr : node.dataset.labelEn);
    });

    // Keep the toggles in sync and tell assistive tech which one is active.
    document.querySelectorAll('.language-switch').forEach((toggle) => {
        toggle.querySelectorAll('span[data-locale]').forEach((option) => {
            option.classList.toggle('lang-active', option.dataset.locale === locale);
        });
    });

    // The server renders validation and success messages in the language the
    // form was submitted in, so keep the hidden field aligned with the UI.
    const sourceLocale = document.getElementById('source_locale');
    if (sourceLocale) {
        sourceLocale.value = locale;
    }

    rememberLocale(locale);
}

function setUpLanguageToggles() {
    document.querySelectorAll('.language-switch').forEach((toggle) => {
        toggle.addEventListener('click', () => {
            applyLocale(document.documentElement.lang === 'ar' ? 'en' : 'ar');
        });
    });
}

function setUpMobileMenu() {
    const button = document.querySelector('.menu-toggle');
    const nav = document.querySelector('.main-nav');

    if (!button || !nav) {
        return;
    }

    const close = () => {
        nav.classList.remove('open');
        button.setAttribute('aria-expanded', 'false');
    };

    button.addEventListener('click', () => {
        const open = nav.classList.toggle('open');
        button.setAttribute('aria-expanded', open ? 'true' : 'false');
    });

    nav.addEventListener('click', (event) => {
        if (event.target.closest('a')) {
            close();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && nav.classList.contains('open')) {
            close();
            button.focus();
        }
    });

    document.addEventListener('click', (event) => {
        if (nav.classList.contains('open') && !event.target.closest('.site-header')) {
            close();
        }
    });
}

/** "Choose this path" pre-selects the matching program in the form. */
function setUpProgramLinks() {
    const select = document.getElementById('program');

    if (!select) {
        return;
    }

    document.querySelectorAll('[data-program]').forEach((link) => {
        link.addEventListener('click', () => {
            select.value = link.dataset.program;
            select.dispatchEvent(new Event('change', { bubbles: true }));
        });
    });
}

function setUpReveal() {
    const items = document.querySelectorAll('.reveal');
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (reducedMotion || !('IntersectionObserver' in window)) {
        items.forEach((item) => item.classList.add('visible'));

        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        },
        { rootMargin: '0px 0px -8% 0px', threshold: 0.08 },
    );

    items.forEach((item) => observer.observe(item));
}

/** Keep the lightweight lesson gallery calm: only one clip can play at once. */
function setUpLessonVideos() {
    const videos = document.querySelectorAll('.lesson-video-frame video');

    videos.forEach((video) => {
        video.addEventListener('play', () => {
            videos.forEach((otherVideo) => {
                if (otherVideo !== video && !otherVideo.paused) {
                    otherVideo.pause();
                }
            });
        });
    });
}

applyLocale(storedLocale());
setUpLanguageToggles();
setUpMobileMenu();
setUpProgramLinks();
setUpReveal();
setUpLessonVideos();

<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/config.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/profile.php?id=' . (int) $_SESSION['user_id']);
    exit;
}

$base = BASE_URL;
$logoFile = is_file(__DIR__ . '/images/ensiasd-logo.png') ? 'ensiasd-logo.png' : 'ensiasd-logo.svg';
$logoUrl = $base . '/images/' . $logoFile;
$pageTitle = 'Accueil — ' . SITE_NAME . ' · ' . SITE_PLACE;

$registerUrl = htmlspecialchars($base . '/auth/connexion.php?mode=inscription', ENT_QUOTES, 'UTF-8');
$loginUrl = htmlspecialchars($base . '/auth/connexion.php', ENT_QUOTES, 'UTF-8');
$profileUrl = !empty($_SESSION['user_id'])
    ? htmlspecialchars($base . '/profile.php?id=' . (int) $_SESSION['user_id'], ENT_QUOTES, 'UTF-8')
    : '';

$phoneLabel = htmlspecialchars(CONTACT_PHONE_LABEL, ENT_QUOTES, 'UTF-8');
$phoneTel   = htmlspecialchars(CONTACT_PHONE_TEL, ENT_QUOTES, 'UTF-8');
$emailContact = htmlspecialchars(CONTACT_EMAIL, ENT_QUOTES, 'UTF-8');
$wa = preg_replace('/\D+/', '', CONTACT_WHATSAPP);
$whatsappUrl = htmlspecialchars('https://wa.me/' . $wa, ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Remix Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800;900&family=Space+Grotesk:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- AOS Animations -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= htmlspecialchars($base, ENT_QUOTES, 'UTF-8') ?>/css/landing.css">
</head>

<body>

    <!-- ═══════════════════════ NAVBAR ═══════════════════════ -->
    <nav class="navbar navbar-expand-lg lp-navbar fixed-top" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand lp-brand d-flex align-items-center gap-2" href="<?= htmlspecialchars($base . '/index.php', ENT_QUOTES, 'UTF-8') ?>">
                <img src="<?= htmlspecialchars($logoUrl, ENT_QUOTES, 'UTF-8') ?>" width="40" height="40" alt="Logo" class="lp-brand-img">
                <div>
                    <span class="lp-brand-name"><?= htmlspecialchars(SITE_NAME, ENT_QUOTES, 'UTF-8') ?></span>
                    <small class="lp-brand-place d-block"><?= htmlspecialchars(SITE_PLACE, ENT_QUOTES, 'UTF-8') ?></small>
                </div>
            </a>

            <button class="navbar-toggler lp-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="ri-menu-3-line fs-4"></i>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav mx-auto gap-1">
                    <li class="nav-item"><a class="nav-link lp-nav-link" href="#home">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link lp-nav-link" href="#service">Fonctionnalités</a></li>
                    <li class="nav-item"><a class="nav-link lp-nav-link" href="#experience">Communauté</a></li>
                    <li class="nav-item"><a class="nav-link lp-nav-link" href="#contact">Contact</a></li>
                </ul>
                <div class="d-flex gap-2 mt-3 mt-lg-0">
                    <?php if (empty($_SESSION['user_id'])): ?>
                        <a href="<?= $registerUrl ?>" class="btn lp-btn-outline">S'inscrire</a>
                        <a href="<?= $loginUrl ?>" class="btn lp-btn-primary">Se connecter</a>
                    <?php else: ?>
                        <a href="<?= $profileUrl ?>" class="btn lp-btn-primary">
                            <i class="ri-user-3-fill me-1"></i> Mon profil
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- ═══════════════════════ HERO ═══════════════════════ -->
    <section class="lp-hero" id="home">
        <div class="lp-hero-bg-orb orb1"></div>
        <div class="lp-hero-bg-orb orb2"></div>
        <div class="lp-hero-bg-orb orb3"></div>
        <div class="container">
            <div class="row align-items-center min-vh-100 py-5">
                <div class="col-lg-6 order-2 order-lg-1 mt-4 mt-lg-0" data-aos="fade-right" data-aos-duration="900">
                    <div class="lp-badge mb-3">
                        <i class="ri-sparkling-2-fill me-1"></i> Réseau Officiel Étudiant
                    </div>
                    <h1 class="lp-hero-title">
                        Le réseau social officiel des étudiants
                        <span class="lp-gradient-text"><?= htmlspecialchars(SITE_NAME, ENT_QUOTES, 'UTF-8') ?></span>
                        à <?= htmlspecialchars(SITE_PLACE, ENT_QUOTES, 'UTF-8') ?>
                    </h1>
                    <p class="lp-hero-sub mt-3 mb-4">
                        Retrouvez les informations de l'école, votre profil membre et la communauté
                        <strong><?= htmlspecialchars(SITE_NAME, ENT_QUOTES, 'UTF-8') ?></strong> à <?= htmlspecialchars(SITE_PLACE, ENT_QUOTES, 'UTF-8') ?>.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <?php if (empty($_SESSION['user_id'])): ?>
                            <a href="<?= $registerUrl ?>" class="btn lp-btn-primary lp-btn-lg">
                                <i class="ri-user-add-fill me-2"></i>Créer un compte
                            </a>
                            <a href="<?= $loginUrl ?>" class="btn lp-btn-outline lp-btn-lg">
                                <i class="ri-login-circle-fill me-2"></i>Se connecter
                            </a>
                        <?php else: ?>
                            <a href="<?= $profileUrl ?>" class="btn lp-btn-primary lp-btn-lg">
                                <i class="ri-user-3-fill me-2"></i>Mon profil
                            </a>
                            <a href="#contact" class="btn lp-btn-outline lp-btn-lg">
                                <i class="ri-customer-service-2-fill me-2"></i>Contact
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="lp-hero-stats mt-5 d-flex flex-wrap gap-4">
                        <div class="lp-stat">
                            <span class="lp-stat-num" data-count="500">0</span><span class="lp-stat-num">+</span>
                            <small>Étudiants</small>
                        </div>
                        <div class="lp-stat-divider"></div>
                        <div class="lp-stat">
                            <span class="lp-stat-num" data-count="3">0</span><span class="lp-stat-num"> étapes</span>
                            <small>Pour rejoindre</small>
                        </div>
                        <div class="lp-stat-divider"></div>
                        <div class="lp-stat">
                            <span class="lp-stat-num">100%</span>
                            <small>Gratuit</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 text-center" data-aos="fade-left" data-aos-duration="900" data-aos-delay="200">
                    <div class="lp-hero-img-wrap">
                        <img src="<?= htmlspecialchars($base . '/images/landing-hero.svg', ENT_QUOTES, 'UTF-8') ?>" alt="Illustration <?= htmlspecialchars(SITE_NAME, ENT_QUOTES, 'UTF-8') ?>" class="lp-hero-img">
                        <div class="lp-floating-card card1">
                            <i class="ri-shield-check-fill text-success me-2"></i> Compte vérifié
                        </div>
                        <div class="lp-floating-card card2">
                            <i class="ri-notification-3-fill text-warning me-2"></i> Nouvelle annonce
                        </div>
                        <div class="lp-floating-card card3">
                            <i class="ri-group-fill text-primary me-2"></i> +12 membres aujourd'hui
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="lp-hero-wave">
            <svg viewBox="0 0 1440 80" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <path d="M0,40 C360,80 1080,0 1440,40 L1440,80 L0,80 Z" fill="var(--lp-bg)" />
            </svg>
        </div>
    </section>

    <!-- ═══════════════════════ STEPS ═══════════════════════ -->
    <section class="lp-section lp-section-light" id="steps">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="lp-section-tag">COMMENT ÇA MARCHE</span>
                <h2 class="lp-section-title mt-2">Trois étapes pour rejoindre le réseau</h2>
                <p class="lp-section-sub">Simple, rapide, et entièrement gratuit pour tous les étudiants.</p>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-12 col-md-4" data-aos="fade-up" data-aos-delay="0">
                    <div class="lp-step-card">
                        <div class="lp-step-num">01</div>
                        <div class="lp-step-icon"><i class="ri-user-add-fill"></i></div>
                        <h4><a href="<?= $registerUrl ?>">Créez un compte</a></h4>
                        <p>Inscrivez-vous en quelques minutes pour accéder à votre profil et au réseau.</p>
                        <div class="lp-step-arrow d-none d-md-block"><i class="ri-arrow-right-line"></i></div>
                    </div>
                </div>
                <div class="col-12 col-md-4" data-aos="fade-up" data-aos-delay="150">
                    <div class="lp-step-card">
                        <div class="lp-step-num">02</div>
                        <div class="lp-step-icon"><i class="ri-edit-2-fill"></i></div>
                        <h4>Complétez votre profil</h4>
                        <p>Présentez-vous à la communauté pour faciliter les échanges et les mises en relation.</p>
                        <div class="lp-step-arrow d-none d-md-block"><i class="ri-arrow-right-line"></i></div>
                    </div>
                </div>
                <div class="col-12 col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="lp-step-card lp-step-card--active">
                        <div class="lp-step-num">03</div>
                        <div class="lp-step-icon"><i class="ri-school-fill"></i></div>
                        <h4>Participez !</h4>
                        <p>Découvrez les infos du réseau et restez proche de la communauté de l'école.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ FEATURES ═══════════════════════ -->
    <section class="lp-section lp-section-white" id="service">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-5 text-center" data-aos="zoom-in" data-aos-duration="800">
                    <div class="lp-feature-img-wrap">
                        <img src="<?= htmlspecialchars($base . '/images/landing-service.svg', ENT_QUOTES, 'UTF-8') ?>" alt="Fonctionnalités" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-7" data-aos="fade-left" data-aos-duration="800">
                    <span class="lp-section-tag">AU CŒUR DU RÉSEAU</span>
                    <h2 class="lp-section-title mt-2 mb-4">Une expérience pensée pour la vie étudiante</h2>
                    <div class="lp-feature-list">
                        <div class="lp-feature-item" data-aos="fade-left" data-aos-delay="100">
                            <div class="lp-feature-icon">
                                <i class="ri-user-smile-fill"></i>
                            </div>
                            <div>
                                <h5>Profil membre</h5>
                                <p>Présentez-vous et retrouvez les informations de votre compte au sein du réseau.</p>
                            </div>
                        </div>
                        <div class="lp-feature-item" data-aos="fade-left" data-aos-delay="200">
                            <div class="lp-feature-icon">
                                <i class="ri-notification-3-fill"></i>
                            </div>
                            <div>
                                <h5>Infos &amp; annonces</h5>
                                <p>Centralisez les informations utiles pour votre scolarité et la vie du campus.</p>
                            </div>
                        </div>
                        <div class="lp-feature-item" data-aos="fade-left" data-aos-delay="300">
                            <div class="lp-feature-icon">
                                <i class="ri-links-fill"></i>
                            </div>
                            <div>
                                <h5>Liens entre promotions</h5>
                                <p>Connectez-vous avec vos camarades et anciens élèves facilement.</p>
                            </div>
                        </div>
                        <div class="lp-feature-item" data-aos="fade-left" data-aos-delay="400">
                            <div class="lp-feature-icon">
                                <i class="ri-award-fill"></i>
                            </div>
                            <div>
                                <h5>Mise en avant des projets</h5>
                                <p>Valorisez vos réalisations et découvrez celles de vos pairs.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ COMMUNITY ═══════════════════════ -->
    <section class="lp-section lp-section-dark" id="experience">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="lp-section-tag lp-section-tag--light">VIE DE CAMPUS</span>
                <h2 class="lp-section-title lp-section-title--light mt-2">Ce que le réseau vous apporte au quotidien</h2>
                <p class="lp-section-sub lp-section-sub--light">Tout ce dont vous avez besoin pour votre vie étudiante.</p>
            </div>
            <div class="row g-3 justify-content-center">
                <?php
                $cards = [
                    ['ri-shield-check-fill',        'Espace dédié à l\'école',   '#4caf50'],
                    ['ri-time-fill',                'Actualités en temps réel',  '#2196f3'],
                    ['ri-links-fill',               'Liens entre promotions',    '#9c27b0'],
                    ['ri-award-fill',               'Mise en avant des projets', '#ff9800'],
                    ['ri-customer-service-2-fill',  'Contact &amp; entraide',    '#f44336'],
                    ['ri-smartphone-fill',          'Accessible sur mobile',     '#00bcd4'],
                ];
                foreach ($cards as $i => [$icon, $label, $color]):
                ?>
                    <div class="col-6 col-sm-4 col-lg-2" data-aos="zoom-in" data-aos-delay="<?= $i * 80 ?>">
                        <div class="lp-exp-card" style="--card-accent:<?= $color ?>">
                            <i class="<?= $icon ?>"></i>
                            <p><?= $label ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ CTA ═══════════════════════ -->
    <section class="lp-section lp-section-white" id="cta-join">
        <div class="container" data-aos="fade-up">
            <div class="lp-cta-box">
                <div class="lp-cta-bg-orb"></div>
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <h2 class="lp-cta-title">Rejoignez la communauté<br><span class="lp-gradient-text"><?= htmlspecialchars(SITE_NAME, ENT_QUOTES, 'UTF-8') ?></span></h2>
                        <p class="lp-cta-sub">Accédez à votre espace membre. Un seul compte pour le réseau de l'école.</p>
                    </div>
                    <div class="col-lg-4 d-flex flex-column flex-sm-row flex-lg-column gap-2 align-items-lg-end">
                        <?php if (empty($_SESSION['user_id'])): ?>
                            <a href="<?= $registerUrl ?>" class="btn lp-btn-primary lp-btn-lg">
                                <i class="ri-rocket-2-fill me-2"></i>Créer un compte gratuitement
                            </a>
                            <a href="<?= $loginUrl ?>" class="btn lp-btn-outline lp-btn-lg">
                                <i class="ri-login-circle-fill me-2"></i>J'ai déjà un compte
                            </a>
                        <?php else: ?>
                            <a href="<?= $profileUrl ?>" class="btn lp-btn-primary lp-btn-lg">
                                <i class="ri-user-3-fill me-2"></i>Mon profil
                            </a>
                            <a href="#contact" class="btn lp-btn-outline lp-btn-lg">Contact</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ CONTACT ═══════════════════════ -->
    <section class="lp-section lp-section-light" id="contact">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="lp-section-tag">CONTACT</span>
                <h2 class="lp-section-title mt-2">L'école et le réseau</h2>
                <p class="lp-section-sub">Une question ? Contactez-nous directement.</p>
            </div>
            <div class="row justify-content-center g-4">
                <div class="col-12 col-sm-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
                    <div class="lp-contact-card">
                        <div class="lp-contact-icon" style="background:#e3f2fd">
                            <i class="ri-phone-fill" style="color:#1877f2"></i>
                        </div>
                        <h5>Téléphone</h5>
                        <a href="tel:<?= $phoneTel ?>"><?= $phoneLabel ?></a>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="lp-contact-card">
                        <div class="lp-contact-icon" style="background:#fce4ec">
                            <i class="ri-mail-fill" style="color:#e91e63"></i>
                        </div>
                        <h5>Email</h5>
                        <a href="mailto:<?= $emailContact ?>"><?= $emailContact ?></a>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="lp-contact-card">
                        <div class="lp-contact-icon" style="background:#e8f5e9">
                            <i class="ri-whatsapp-fill" style="color:#25d366"></i>
                        </div>
                        <h5>WhatsApp</h5>
                        <a href="<?= $whatsappUrl ?>" target="_blank" rel="noopener noreferrer" class="lp-whatsapp-btn">
                            <i class="ri-whatsapp-fill me-1"></i> Envoyer un message
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ FOOTER ═══════════════════════ -->
    <footer class="lp-footer">
        <div class="container">
            <div class="row g-4 py-5">
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <img src="<?= htmlspecialchars($logoUrl, ENT_QUOTES, 'UTF-8') ?>" width="36" height="36" alt="" class="rounded-circle">
                        <span class="fw-bold text-white"><?= htmlspecialchars(SITE_NAME, ENT_QUOTES, 'UTF-8') ?></span>
                    </div>
                    <p class="lp-footer-text">Le réseau social officiel des étudiants de l'école.</p>
                </div>
                <div class="col-6 col-lg-3">
                    <h6 class="lp-footer-heading">Compte</h6>
                    <ul class="list-unstyled lp-footer-links">
                        <li><a href="<?= $loginUrl ?>">Connexion</a></li>
                        <li><a href="<?= $registerUrl ?>">Inscription</a></li>
                        <?php if (!empty($_SESSION['user_id'])): ?>
                            <li><a href="<?= $profileUrl ?>">Mon profil</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="col-6 col-lg-3">
                    <h6 class="lp-footer-heading">Navigation</h6>
                    <ul class="list-unstyled lp-footer-links">
                        <li><a href="#home">Accueil</a></li>
                        <li><a href="#service">Fonctionnalités</a></li>
                        <li><a href="#experience">Communauté</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <h6 class="lp-footer-heading">Lieu</h6>
                    <p class="lp-footer-text"><?= htmlspecialchars(SITE_PLACE, ENT_QUOTES, 'UTF-8') ?>, Maroc</p>
                    <div class="lp-footer-socials mt-3">
                        <a href="<?= htmlspecialchars($base . '/index.php#home', ENT_QUOTES, 'UTF-8') ?>" aria-label="Accueil"><i class="ri-home-4-fill"></i></a>
                        <a href="mailto:<?= $emailContact ?>" aria-label="Email"><i class="ri-mail-fill"></i></a>
                        <a href="<?= $whatsappUrl ?>" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp"><i class="ri-whatsapp-fill"></i></a>
                    </div>
                </div>
            </div>
            <div class="lp-footer-bar">
                <p>&copy; <?= date('Y') ?> <?= htmlspecialchars(SITE_NAME, ENT_QUOTES, 'UTF-8') ?> · <?= htmlspecialchars(SITE_PLACE, ENT_QUOTES, 'UTF-8') ?></p>
                <p>Fait avec <i class="ri-heart-fill" style="color:#e91e63"></i> pour les étudiants</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <!-- Custom JS -->
    <script src="<?= htmlspecialchars($base, ENT_QUOTES, 'UTF-8') ?>/js/landing.js"></script>
</body>

</html>
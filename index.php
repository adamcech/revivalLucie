<?php

include_once $_SERVER['DOCUMENT_ROOT']."/php/Routes.php";
include_once $_SERVER['DOCUMENT_ROOT']."/php/ModelV2/DatabaseV2Include.php";

if (Routes::getRoutesLength() >= 2) { header("Location: /"); }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title, Favicon -->
    <title>Revival Lucie Morava</title>
    <link rel="shortcut icon" href="/img/favicon.png" />

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="author" content="Revival Lucie Morava, Adam Čech">
    <meta name="first_release" content="17.10.2020">

    <meta name="keywords" content="revivallucie, lucie revival, revival, lucie, morava, kozlovice, myslik, frydek-mistek, ostrava, rock, pop"/>
    <meta name="ROBOTS" content="index, follow">
    <meta name="description" content="Naše kapela vznikla ve Frýdku Místku a hrajeme pro Vás od roku 2012. Chcete si užít hity Lucie? Tak neváhejte a domluvte si náš koncert. „Nejlepší revival, který znáš“.">

    <meta property="og:title" content="Revival Lucie Morava" />
    <meta property="og:url" content="https://www.revivallucie.cz/" />
    <meta property="og:image" content="https://revivallucie.cz/img/uvod_thumb.jpg" />

    <!-- Stylesheet -->
    <link rel="stylesheet" href="/css/style.css">

    <!-- Custom scripting for UI -->
    <script src="/js/ui.js"></script>

    <!-- jQuery 2.2.4 -->
    <script src="/js/jquery.min.js"></script>

    <!-- reCAPTCHA -->
    <script src="/js/captcha.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<div style="display:none;">
    <img src="/img/uvod_desktop.jpg" alt="Revival Lucie Morava">
</div>

<body>
<!-- Preloader -->
<div id="preloader">
    <div class="loader"></div>
</div>
<!-- /Preloader -->

<!-- Header Area Start -->
<div id="anchor-uvod"></div>
<header id="header-area" class="header-area">
    <!-- Main Header Start -->
    <div class="main-header-area">
        <div class="classy-nav-container breakpoint-off">
            <div class="container">
                <!-- Classy Menu -->
                <nav class="classy-navbar justify-content-between" id="alimeNav">

                    <!-- Logo
                    <a class="nav-brand" href="./index.html"><span style="color: #ffc800;">Logo</span></a>
                    -->
                    <a class="small-logo nav-brand" href="#">
                        <img id="menu-logo" class="hidden" src="img/logo_small.png" alt="Logo"/>
                    </a>

                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>

                    <!-- Menu -->
                    <div class="classy-menu">
                        <!-- Menu Close Button -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>
                        <!-- Nav Start -->
                        <div class="classynav">
                            <ul id="nav">
                                <li><a id="link-uvod" href="#anchor-uvod"><div class="active_underline"></div>Úvod</a></li>
                                <li><a id="link-o-kapele" href="#anchor-o-kapele"><div class="active_underline"></div>O kapele</a></li>
                                <li><a id="link-koncerty" href="#anchor-koncerty"><div class="active_underline"></div>Koncerty</a></li>
                                <li><a id="link-pro-poradatele" href="#anchor-pro-poradatele"><div class="active_underline"></div>Pro pořadatele</a></li>
                                <li><a id="link-kontakt" href="#anchor-kontakt"><div class="active_underline"></div>Kontakt</a></li>
                                <li><a id="link-galerie" href="#anchor-galerie"><div class="active_underline"></div>Galerie</a></li>
                            </ul>
                        </div>
                        <!-- Nav End -->
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- Header Area End -->

<!-- Welcome Area Start -->
<section class="welcome-area only-desktop">
    <!-- Single Slide -->
    <div class="single-welcome-slide bg-img bg-overlay" style="background-image: url(img/uvod_desktop.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <!-- Welcome Text -->
                <div class="col-12 col-lg-8 col-xl-6">
                    <div id="welcome-text" class="welcome-text wow fadeInDown">
                        <img id="main-logo" src="img/logo_small.png" alt="Revival Lucie Morava">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Welcome Area End -->

<!-- Welcome Area Phone Start -->
<section class="welcome-phone-area only-phone">
    <!-- Single Slide -->
    <img class="welcome-phone-image" src="img/uvod_phone.jpg" alt="Revival Lucie Morava">
</section>
<!-- Welcome Area Phone End -->

<!-- About Us Area Start -->
<div id="anchor-o-kapele" class="about-us-area section-padding-40 clearfix">
    <div class="container">
        <div class="o-kapele row align-items-top wow fadeInDown">
            <div class="col-12 col-lg-6">
                <div class="about-us-content">
                    <h3>O Kapele</h3>
                    <div class="line"></div>
                    <p>
                        Vítejte na stránkách hudební skupiny Revival Lucie Morava.
                    </p>

                    <p>
                        Naše kapela vznikla ve Frýdku Místku a hrajeme pro Vás od roku 2012.
                    </p>

                    <p>
                        Chcete si užít hity Lucie? Tak neváhejte a domluvte si náš koncert. Přijedeme za Vámi kamkoliv.
                    </p>
                </div>
            </div>
            <div class="col-12 col-lg-6 only-desktop">
                <div>
                    <img src="img/o_kapele.jpg" alt="O Kapele">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About Us Area End -->

<!-- Why Choose Us Area Start -->
<section class="why-choose-us-area clearfix">
    <div class="container">
        <div class="row">
            <!-- Single Why Choose Area -->
            <div class="col-md-6 col-lg-4">
                <div class="why-choose-us-content text-center wow fadeInDown" data-wow-delay="150ms">
                    <div class="chosse-us-icon">
                        <i class="fa fa-flag" aria-hidden="true"></i>
                    </div>
                    <h4>Hrajeme již <script type="text/javascript">let age = (new Date().getFullYear() - 2012).toString(); document.write(age);</script> Let</h4>
                    <p>Opravdu to umíme, přijďte se přesvědčit na vlastní uši.</p>
                </div>
            </div>

            <!-- Single Why Choose Area -->
            <div class="col-md-6 col-lg-4">
                <div class="why-choose-us-content text-center wow fadeInDown" data-wow-delay="300ms">
                    <div class="chosse-us-icon">
                        <i class="fa fa-users" aria-hidden="true"></i>
                    </div>
                    <h4><span id="concert_counter"></span>+ Koncertů</h4>
                    <p>„Nejlepší revival, který znáš“</p>
                </div>
            </div>

            <!-- Single Why Choose Area -->
            <div class="col-md-6 col-lg-4">
                <div class="why-choose-us-content text-center wow fadeInDown" data-wow-delay="450ms">
                    <div class="chosse-us-icon">
                        <i class="fa fa-handshake-o" aria-hidden="true"></i>
                    </div>
                    <h4>Nabízíme</h4>
                    <ul>
                        <li>Městské a Obecní Slavnosti</li>
                        <li>Koncerty a Festivaly</li>
                        <li>Soukromé a Firemní Akce</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Why Choose  us Area End -->

<!-- Our Team Area Start -->
<section class="our-team-area section-padding-40">
    <div class="container">
        <div id="cards-members" class="row"></div>
    </div>
</section>
<!-- Our Team Area End -->

<section id="anchor-koncerty" class="section-padding-40-50 wow bg-gray fadeInDown" data-wow-delay="300ms">
    <div class="container">
        <div class="row">
            <div class="col">
                <h3 style="visibility: visible; animation-delay: 100ms; animation-name: fadeInUp;">
                    Koncerty
                </h3>
                <div class="line"></div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div id="concert-list-left" class="concerts-table"></div>
            </div>

            <div class="col">
                <div id="concert-list-right" class="concerts-table"></div>
            </div>
        </div>
    </div>
</section>

<section id="anchor-pro-poradatele" class="section-padding-40-50 wow fadeInDown" data-wow-delay="300ms">
    <div class="container">
        <div class="row">
            <div class="col">
                <h3 style="visibility: visible; animation-delay: 100ms; animation-name: fadeInUp;">
                    Pro pořadatele
                </h3>
                <div class="line"></div>
            </div>
        </div>

        <div class="row">
            <div class="col">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <h4 class="m-0">Playlist</h4>
                <a id="playlist-link" class="download-link" href="" target="_blank">Stáhnout <i class="fa fa-file-pdf-o"></i></a>
                <ol id="song-list"></ol>
            </div>
            <div class="col">
                <h4 class="pmt-30">Stageplan</h4>
                <a id="stageplan-link" class="download-link" href="" target="_blank">Stáhnout <i class="fa fa-file-pdf-o"></i></a>
                <p>
                    Naše kapela disponuje profesionální aparaturou značky - JBL, LEM s výkonem cca. 2Kwatt.
                    Tato aparatura ozvučí všechny sály v kulturních domech a dalších kulturních zařízeních.
                    Samozřejmostí je i světelný park.
                </p>
                <p>
                    Pro ozvučení venkovních akcí není problém použít aparaturu s vyšší výkoností - cca do 6Kwatt.
                </p>
            </div>
        </div>
    </div>
</section>

<section id="anchor-kontakt" class="wow bg-gray fadeInDown" data-wow-delay="300ms">
    <!-- Contact Area Start -->
    <div class="contact-area section-padding-40-50">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h3>Kontakt</h3>
                    <div class="line"></div>
                </div>
            </div>

            <div class="row">
                <p class="col">
                    Pokud Vás zajímají podrobnější informace, volné termíny, objednávky, či jiné dotazy,
                    neváhejte nás kontaktovat pomocí emailu, telefonu, nebo kontaktního formuláře.
                </p>
            </div>

            <div id="contacts-list"></div>


            <div class="alime-contact-form mt-40">
                <h4 class="mb-30">Napište nám</h4>

                <form id="contact-us-form" action="/contactus.php" method="POST" accept-charset="UTF-8">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <input id="message-name" type="text" name="message-name" class="form-control mb-20" placeholder="Jméno">
                        </div>
                        <div class="col-12 col-md-6">
                            <input id="message-phone" type="text" name="message-phone" class="form-control mb-20" placeholder="Telefon">
                        </div>
                        <div class="col-12">
                            <input id="message-email" type="text" name="message-email" class="form-control mb-20" placeholder="E-mail">
                        </div>
                        <div class="col-12">
                            <textarea id="message-content" name="message-content" class="form-control mb-20" placeholder="Zpráva"></textarea>
                        </div>
                        <div class="col-12">
                            <div  id="recaptcha" class="g-recaptcha" data-sitekey="6LcmM7YaAAAAAIAkDk7qmPRQ6zeM-tyUXIZ68rMe" data-callback="captcha_submit" data-size="invisible"></div>
                            <button id="contact-form-submit" class="btn alime-btn btn-2 mt-15">Odeslat</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>
</section>


<!-- Gallery Area Start -->
<div id="anchor-galerie" class="alime-portfolio-area section-padding-40 clearfix">
    <div class="container-fluid">
        <div class="row">
            <div class="col wow fadeInUp" data-wow-delay="100ms">
                <h3>Galerie</h3>
                <div class="line"></div>
            </div>
        </div>


        <?php
            $tagsMapper = new TagMapper();
            $tags = $tagsMapper->selectAll()->results;

            if (sizeof($tags) > 0) {
        ?>
        <div class="row">
            <div class="col-12">
                <!-- Projects Menu -->
                <div class="alime-projects-menu wow fadeInUp" data-wow-delay="100ms">
                    <div class="portfolio-menu text-center">
                        <button class="btn active" data-filter="*">Vše</button>
                        <?php
                        foreach ($tags as $tag) {
                            /** @var Tag $tag */
                            echo '<button class="btn" data-filter=".tag'.$tag->id.'">'.$tag->name.'</button>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
                 <?php } ?>

        <div class="row alime-portfolio">

            <?php
            $galleryMapper = new GalleryMapper();
            $gallery = $galleryMapper->selectAll()->results;

            foreach ($gallery as $g) {
                /** @var Gallery $g */
                ?>
                <div class="col-12 col-sm-6 col-lg-3 single_gallery_item tag<?php echo $g->tag->id; ?> mb-30 wow fadeInUp" data-wow-delay="<?php echo rand(50, 300); ?>ms">
                    <div class="single-portfolio-content">
                        <img src="/files/mini/<?php echo $g->file->idName; ?>" alt="<?php echo $g->file->name; ?>">
                        <div class="hover-content">
                            <a href="/files/<?php echo $g->file->idName; ?>" class="portfolio-img">+</a>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>

        <!--
        <div class="row">
            <div class="col-12 text-center wow fadeInUp" data-wow-delay="800ms">
                <a href="#" class="btn alime-btn btn-2 mt-15">Více</a>
            </div>
        </div>
        -->
    </div>
</div>
<!-- Gallery Area End -->

<!-- Footer Area Start -->
<footer class="footer-area">
    <div class="container">

        <div class="row">
            <div class="col">


                <div class="only-phone social-network-icons-phone">
                        <div>Sledujte nás:</div>

                        <a href="https://www.instagram.com/revivallucie/" target="_blank">
                            <img src="img/ig.png" alt="Instagram">
                        </a>

                        <a href="https://www.facebook.com/revivallucie/" target="_blank">
                            <img src="img/fb.png" alt="Facebook">
                        </a>

                        <a href="https://bandzone.cz/revivalluciemorava" target="_blank">
                            <img src="img/bz.png" alt="Bandzone">
                        </a>
                    </div>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <div class="footer-content d-flex align-items-center justify-content-between">
                    <div class="copywrite-text">
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                        Revival Lucie Morava, All rights reserved
                    </div>
                </div>
            </div>

            <div class="col footer-counter
            <?php
                if ($routes[0] !== "pocitadlo") {
                    echo "only-desktop";
                }
            ?>">
                <img src="http://toplist.cz/count.asp?id=1711644&amp;logo=mc" alt="Počítadlo" style="border-radius:3px;">
            </div>
        </div>

    </div>
</footer>
<!-- Footer Area End -->

<div class="social-network-icons only-desktop">
    <a href="https://www.instagram.com/revivallucie/" target="_blank">
        <img src="img/ig.png" alt="Instagram">
    </a>

    <a href="https://www.facebook.com/revivallucie/" target="_blank">
        <img src="img/fb.png" alt="Facebook">
    </a>

    <a href="https://bandzone.cz/revivalluciemorava" target="_blank">
        <img src="img/bz.png" alt="Bandzone">
    </a>
</div>

<!-- **** All JS Files ***** -->
<!-- Popper -->
<script src="js/popper.min.js"></script>
<!-- Bootstrap -->
<script src="js/bootstrap.min.js"></script>
<!-- All Plugins -->
<script src="js/template.bundle.js"></script>
<!-- Active -->
<script src="js/default-assets/active.js"></script>

<?php
$membersMapper = new MemberMapper();
$concertMapper = new ConcertMapper();
$playlistMapper = new PlaylistMapper();
$contactMapper = new ContactMapper();

$configurationMapper = new ConfigurationMapper();
?>

<script type="text/javascript">
    let playlistFile = <?php echo json_encode($configurationMapper->getPlaylist()); ?>;
    let stageplanFile = <?php echo json_encode($configurationMapper->getStageplan()); ?>;

    let upcoming = <?php echo json_encode($concertMapper->selectUpcoming()->results); ?>;
    let past = <?php echo json_encode($concertMapper->selectPast()->results); ?>;
    let members = <?php echo json_encode($membersMapper->selectAll()->results); ?>;
    let songs = <?php echo json_encode($playlistMapper->selectAll()->results); ?>;
    let contacts = <?php echo json_encode($contactMapper->selectAll()->results); ?>;

    print_concert_counter("concert_counter", (upcoming.length + past.length));
    set_href("playlist-link", playlistFile);
    set_href("stageplan-link", stageplanFile);

    print_members("cards-members", members, 150);
    print_songs("song-list", songs);
    print_concerts("concert-list-left", "concert-list-right", upcoming, past, 16);
    print_contacts("contacts-list", contacts);

    captcha_load();
</script>


</body>

</html>
<?php exit; ?>
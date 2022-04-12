<?php
header("Content-Type:text/css");
$color = "#f0f"; // Change your Color Here
$color2 = "#ff8"; // Change your Color Here

function checkhexcolor($color){
    return preg_match('/^#[a-f0-9]{6}$/i', $color);
}

if (isset($_GET['color']) AND $_GET['color'] != '') {
    $color = "#" . $_GET['color'];
}

if (!$color OR !checkhexcolor($color)) {
    $color = "#336699";
}


function checkhexcolor2($color2){
    return preg_match('/^#[a-f0-9]{6}$/i', $color2);
}

if (isset($_GET['color2']) AND $_GET['color2'] != '') {
    $color2 = "#" . $_GET['color2'];
}

if (!$color2 OR !checkhexcolor2($color2)) {
    $color2 = "#336699";
}
?>


.hero__search .search-btn, .account-menu .icon i, .cmn-btn, .bg--base, .choose-card:hover, .counter-item__content::after, .section-title.has--border::after, .pagination .page-item.active a, .how-it-works-menu li a.active, .work-card__icon .step-number, .work-card__icon, .cmn-btn:hover, .video-button::before, .video-button::after, .video-button, .testimonial-item .testimonial-thumb .shape, .client-slider .slick-arrow:hover, .client-slider .slick-arrow.active, .scroll-to-top, .table.style--two thead, body *::-webkit-scrollbar-button, body *::-webkit-scrollbar-thumb
{
    background-color: <?php echo $color ?>;

}

.choose-card:hover, .pagination .page-item.active a, .pagination .page-item a:hover, .rounded-author-icon{
	border-color: <?php echo $color ?>;
}

.pagination .page-item a:hover, .page-breadcrumb li:first-child::before, .header .main-menu li a:hover, .header .main-menu li a:focus, .about-item__icon, .post-item:hover .post-content .blog-header .title a, .footer .short-menu-list li a:hover, .footer .social-links li a:hover, .widget.widget-archive ul li a::before, .widget.widget-category ul li a::before, .widget.widget-archive ul li a:hover, .widget.widget-category ul li a:hover, .widget.widget-post ul li .content .meta a, .author-widget__list li a:hover {
	color:  <?php echo $color ?>;
}

.bg--base, .base--bg
{
	background-color: <?php echo $color ?> !important;
}


.footer, .header.menu-fixed .header__bottom , .header.menu-fixed .header__bottom, .work-card__icon, .overlay--one::before, .contact-item .contact-inner {
    background-color: <?php echo $color2 ?>;
}

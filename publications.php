<?php require 'header.php'; ?>
<style>
    .background_color1::after{
        display: none;
    }
    .background_color1{
        background: white;
    }
    a{
        text-decoration: none;
        color: inherit;
    }
    .padding_top_header{
        padding-top: 0 !important;
    }
</style>

<div class="blog-section">
    <div class="container">
        <div class="header_presentation">
            <h1>The BOTI Blog</h1>
            <p>Nous partageons notre expérience</p>
            <div class="filter-buttons">
                <button class="filter-btn active" data-filter="all">All</button>
                <button class="filter-btn" data-filter="education">Education</button>
                <button class="filter-btn" data-filter="digital">Digital</button>
                <button class="filter-btn" data-filter="technology">Technology</button>
                <button class="filter-btn" data-filter="announcement">Announcement</button>
                <button class="filter-btn" data-filter="finance">Finance</button>
                <button class="filter-btn" data-filter="launch">Launch</button>
    
            </div>
        </div>

        <div class="blog_sug">
            <div class="row">
                <div class="col-md-6 blog_sug_card">
                    <div class="blog-tag">
                        <button class="blog_tag_btn" >digital</button>
                    </div>
                    <p class="blog_sug_title ps-2">Lorem ipsum doonse ctetu adipiscing elit, sed do eiu modomom</p>
                    <div class="create-by">
                        <div class="d-flex ceo">
                            <img src="assets/images/alj.png" alt="Avatar" class="avatar">
                            <p><span class="author-name">Tahal El Alj</span> Co-founder BOTI School</p>
                        </div>
                        <div class="publish-time">
                            <span class="publish-date">Dec 03, 2025</span>
                            <span class="publish-date ms-2">6 min read</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="assets/images/sug_img_blog.png" alt="sug_img_blog" class="sug_img_blog">
                </div>
            </div>
        </div>

        <div class="newsletter_blog">
            <div class="row">
                <div class="col-md-2">
                    <img src="assets/images/email_box.png" alt="">
                </div>
                <div class="col-md-4 title_middle-newsletter">
                    <h3 >Suivez <br> nos publications :</h3>
                    <p>Inscrivez-vous à notre newsletter quotidienne gratuite</p>
                </div>
                <div class="col-md-6">
                    <div class="newsletter_form position-relative">
                        <input type="email" placeholder="Votre adresse e-mail" class="newsletter_input">
                        <button type="submit" class="newsletter_btn">S'abonner <img src="assets/images/subs_right.png" alt=""></button>
                        <p class="terms_newsletter">Nous serons dans votre boîte de réception tous les matins du lundi au samedi avec toutes les principales actualités économiques de la journée, des histoires inspirantes, les meilleurs conseils et des reportages exclusifs de Botischool <br> Je comprends que les données que je soumets seront utilisées pour me fournir les produits et/ou services décrits ci-dessus et les communications en rapport avec ceux-ci.
                            <br><br>
                              
                            Lisez notre politique de confidentialité pour plus d'informations.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="blogGrid">
            <div class="col-lg-4 col-md-6 blog-card" data-category="education">
                <div class="blog-card-inner">
                    <a href="blog_detail.php"><img src="assets/images/blog_img1.png" alt="Blog 1" class="blog-image" ></a>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span class="blog-tag education">Education</span>
                            <span class="blog-time">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                </svg>
                                5 Jan 2026
                            </span>
                        </div>
                        <a href="blog_detail.php"><h3 class="blog-title">La transformation numérique des écoles africaines</h3></a>
                    </div>
                </div>
            </div>

            <!-- Blog Card 2 -->
            <div class="col-lg-4 col-md-6 blog-card" data-category="digital">
                <div class="blog-card-inner">
                    <a href="blog_detail.php"><img src="assets/images/blog_img2.png" alt="Blog 2" class="blog-image" ></a>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span class="blog-tag digital">Digital</span>
                            <span class="blog-time">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                </svg>
                                10 Jan 2026
                            </span>
                        </div>
                        <a href="blog_detail.php"><h3 class="blog-title">Comment digitaliser votre établissement scolaire</h3></a>
                    </div>
                </div>
            </div>

            <!-- Blog Card 3 -->
            <div class="col-lg-4 col-md-6 blog-card" data-category="technology">
                <div class="blog-card-inner">
                    <a href="blog_detail.php"><img src="assets/images/blog_img3.png" alt="Blog 3" class="blog-image" ></a>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span class="blog-tag technology">Technology</span>
                            <span class="blog-time">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                </svg>
                                12 Jan 2026
                            </span>
                        </div>
                        <a href="blog_detail.php"><h3 class="blog-title">Les nouvelles technologies au service de l'éducation</h3></a>
                    </div>
                </div>
            </div>

            <!-- Blog Card 4 -->
            <div class="col-lg-4 col-md-6 blog-card" data-category="education">
                <div class="blog-card-inner">
                    <a href="blog_detail.php"><img src="assets/images/blog_img1.png" alt="Blog 4" class="blog-image" ></a>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span class="blog-tag education">Education</span>
                            <span class="blog-time">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                </svg>
                                15 Jan 2026
                            </span>
                        </div>
                        <a href="blog_detail.php"><h3 class="blog-title">BOTI School: Révolutionner la gestion scolaire</h3></a>
                    </div>
                </div>
            </div>

            <!-- Blog Card 5 -->
            <div class="col-lg-4 col-md-6 blog-card" data-category="innovation">
                <div class="blog-card-inner">
                    <a href="blog_detail.php"><img src="assets/images/blog_img2.png" alt="Blog 5" class="blog-image" ></a>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span class="blog-tag innovation">Innovation</span>
                            <span class="blog-time">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                </svg>
                                18 Jan 2026
                            </span>
                        </div>
                        <a href="blog_detail.php"><h3 class="blog-title">Innovation pédagogique: Les tendances de 2026</h3></a>
                    </div>
                </div>
            </div>

            <!-- Blog Card 6 -->
            <div class="col-lg-4 col-md-6 blog-card" data-category="management">
                <div class="blog-card-inner">
                    <img src="assets/images/blog_img3.png" alt="Blog 6" class="blog-image" >
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span class="blog-tag management">Management</span>
                            <span class="blog-time">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                </svg>
                                20 Jan 2026
                            </span>
                        </div>
                        <h3 class="blog-title">Gérer efficacement votre établissement scolaire</h3>
                    </div>
                </div>
            </div>

            <!-- Blog Card 7 -->
            <div class="col-lg-4 col-md-6 blog-card" data-category="digital">
                <div class="blog-card-inner">
                    <img src="assets/images/blog_img1.png" alt="Blog 7" class="blog-image" >
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span class="blog-tag digital">Digital</span>
                            <span class="blog-time">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                </svg>
                                22 Jan 2026
                            </span>
                        </div>
                        <h3 class="blog-title">BOTI Campus: La solution pour l'enseignement supérieur</h3>
                    </div>
                </div>
            </div>

            <!-- Blog Card 8 -->
            <div class="col-lg-4 col-md-6 blog-card" data-category="technology">
                <div class="blog-card-inner">
                    <img src="assets/images/blog_img2.png" alt="Blog 8" class="blog-image" >
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span class="blog-tag technology">Technology</span>
                            <span class="blog-time">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                </svg>
                                24 Jan 2026
                            </span>
                        </div>
                        <h3 class="blog-title">L'intelligence artificielle dans l'éducation</h3>
                    </div>
                </div>
            </div>

            <!-- Blog Card 9 -->
            <div class="col-lg-4 col-md-6 blog-card" data-category="innovation">
                <div class="blog-card-inner">
                    <img src="assets/images/blog_img3.png" alt="Blog 9" class="blog-image" >
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span class="blog-tag innovation">Innovation</span>
                            <span class="blog-time">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                </svg>
                                26 Jan 2026
                            </span>
                        </div>
                        <h3 class="blog-title">Le futur de l'éducation digitale en Afrique</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const blogCards = document.querySelectorAll('.blog-card');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filterValue = this.getAttribute('data-filter');

            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            blogCards.forEach(card => {
                const category = card.getAttribute('data-category');
                
                if (filterValue === 'all') {
                    card.classList.remove('hidden');
                } else if (category === filterValue) {
                    card.classList.remove('hidden');
                } else {
                    card.classList.add('hidden');
                }
            });
        });
    });
});
</script>

<?php require 'footer.php'; ?>
const videoThumbnail = document.getElementById('videoThumbnail');
const playButton = document.getElementById('playButton');
const videoPlayer = document.getElementById('videoPlayer');
const youtubeIframe = document.getElementById('youtubeIframe');
const fullscreenBtn = document.getElementById('fullscreenBtn');
const videoContainer = document.querySelector('.video-container');

const YOUTUBE_VIDEO_ID = 'iR5y3hA4aqs';

playButton.addEventListener('click', function() {
    videoThumbnail.style.display = 'none';
    videoPlayer.style.display = 'block';
    youtubeIframe.src = `https://www.youtube.com/embed/${YOUTUBE_VIDEO_ID}?autoplay=1`;
});

fullscreenBtn.addEventListener('click', function() {
    if (!document.fullscreenElement) {
        videoContainer.classList.add('fullscreen');
        if (videoContainer.requestFullscreen) {
            videoContainer.requestFullscreen();
        } else if (videoContainer.webkitRequestFullscreen) {
            videoContainer.webkitRequestFullscreen();
        } else if (videoContainer.msRequestFullscreen) {
            videoContainer.msRequestFullscreen();
        }
    } else {
        videoContainer.classList.remove('fullscreen');
        if (document.exitFullscreen) {
            document.exitFullscreen();
        }
    }
});

document.addEventListener('fullscreenchange', function() {
    if (!document.fullscreenElement) {
        videoContainer.classList.remove('fullscreen');
    }
});

// Video Carousel - Change Video Function (must be global for onclick)
window.changeVideo = function(videoId, element) {
    // 1. Update the Iframe Source
    const player = document.getElementById('mainFrame');
    if (player) {
        player.src = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
    }

    // 2. Update the "Active" styling on thumbnails
    document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
    if (element) {
        element.classList.add('active');
    }
}

// Video Carousel with Owl Carousel
document.addEventListener('DOMContentLoaded', function() {
    
    // Function to initialize a carousel
    function initializeCarousel(carouselId, mainThumbnailId, mainFrameId) {
        const mainThumbnail = document.getElementById(mainThumbnailId);
        const mainFrame = document.getElementById(mainFrameId);
        const carouselElement = $('#' + carouselId);
        
        if (!carouselElement.length) return;
        
        // Initialize Owl Carousel
        carouselElement.owlCarousel({
            loop: false,
            margin: 12,
            nav: true,
            dots: false,
            items: 3,
            navText: ['←', '→'],
            responsive: {
                0: {
                    items: 3
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                }
            }
        });
        
        // Initialize with first video
        const firstThumbItem = carouselElement.find('.thumb-item').first();
        if (firstThumbItem.length) {
            const firstVideoId = firstThumbItem.attr('data-video-id');
            const firstThumbnailUrl = firstThumbItem.attr('data-thumbnail');
            
            if (mainThumbnail && firstThumbnailUrl) {
                mainThumbnail.style.backgroundImage = `url('${firstThumbnailUrl}')`;
            }
            
            firstThumbItem.find('.thumb').addClass('active');
        }
        
        // Main thumbnail click to play
        if (mainThumbnail) {
            mainThumbnail.addEventListener('click', function() {
                const activeThumb = carouselElement.find('.thumb.active').first();
                if (activeThumb.length) {
                    const thumbItem = activeThumb.closest('.thumb-item');
                    const videoId = thumbItem.attr('data-video-id');
                    mainFrame.src = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
                    mainThumbnail.style.display = 'none';
                }
            });
        }
        
        // Thumbnail clicks
        carouselElement.find('.thumb-item').each(function() {
            $(this).on('click', function() {
                const videoId = $(this).attr('data-video-id');
                const thumbnailUrl = $(this).attr('data-thumbnail');
                const thumbDiv = $(this).find('.thumb');
                
                // Update active state within this carousel only
                carouselElement.find('.thumb').removeClass('active');
                thumbDiv.addClass('active');
                
                // Update main thumbnail
                if (mainThumbnail && thumbnailUrl) {
                    mainThumbnail.style.backgroundImage = `url('${thumbnailUrl}')`;
                    mainThumbnail.style.display = 'flex';
                }
                
                // Reset iframe
                mainFrame.src = '';
            });
        });
    }
    
    // Initialize both carousels
    initializeCarousel('thumbCarousel', 'mainThumbnail', 'mainFrame');
    initializeCarousel('thumbCarouselMobile', 'mainThumbnailMobile', 'mainFrameMobile');

    // Handle option buttons toggle
    document.querySelectorAll('.option-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            // Remove active styling from all buttons
            document.querySelectorAll('.option-btn').forEach(btn => {
                btn.style.borderColor = '';
                btn.style.color = '';
            });
            
            // Add active styling to clicked button
            this.style.borderColor = '#6f6af7';
            this.style.color = '#6f6af7';
            
            // Set the hidden objet field value
            const objetValue = this.getAttribute('data-objet');
            const objetInput = document.getElementById('objetSelected');
            if (objetInput && objetValue) {
                objetInput.value = objetValue;
            }
        });
    });

    // Handle enjoyia contact form submission
    const enjoyiaForm = document.getElementById('enjoyiaContactForm');
    if (enjoyiaForm) {
        enjoyiaForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            formData.append('op', 'enjoyia_contact');
            
            fetch('mail.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Merci ! Votre demande a été envoyée avec succès.');
                    enjoyiaForm.reset();
                    // Reset objet buttons styling
                    document.querySelectorAll('.option-btn').forEach(btn => {
                        btn.style.borderColor = '';
                        btn.style.color = '';
                    });
                } else {
                    alert('Erreur: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Une erreur est survenue lors de l\'envoi du formulaire.');
            });
        });
    }

    // Why-image carousel functionality
    const whyImages = [
        'assets/images_enjoy_ai/student_work.png',
        'assets/images_enjoy_ai/ia_robot.png',
    ];
    let currentWhyImageIndex = 0;
    let whyAutoRotate = null;
    const whyImageElement = document.querySelector('.why-image img');
    const whyDots = document.querySelectorAll('.why-image .dots span');

    function updateWhyImage(index) {
        if (whyImageElement) {
            whyImageElement.style.opacity = '0';
            setTimeout(() => {
                whyImageElement.src = whyImages[index];
                whyImageElement.style.opacity = '1';
            }, 150);
            
            whyDots.forEach((dot, i) => {
                if (i === index) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        }
    }

    whyDots.forEach((dot, index) => {
        dot.addEventListener('click', function() {
            currentWhyImageIndex = index;
            updateWhyImage(index);
            // Reset auto-rotation timer
            if (whyAutoRotate) {
                clearInterval(whyAutoRotate);
            }
            whyAutoRotate = setInterval(function() {
                currentWhyImageIndex = (currentWhyImageIndex + 1) % whyImages.length;
                updateWhyImage(currentWhyImageIndex);
            }, 5000);
        });
    });

    // Auto-rotate why images every 5 seconds
    whyAutoRotate = setInterval(function() {
        currentWhyImageIndex = (currentWhyImageIndex + 1) % whyImages.length;
        updateWhyImage(currentWhyImageIndex);
    }, 5000);

    // Media-container tabs functionality
    const mediaTabs = document.querySelectorAll('.media-container .tab');
    const logosGrid = document.querySelector('.media-container .logos-grid');
    
    const mediaContent = {
        'presse': [
            { src: 'hespress.png', href: 'https://fr.hespress.com/453260-453260.html' },
            { src: 'lematin.png', href: 'https://lematin.ma/hi-tech/des-jeunes-marocains-sur-le-podium-de-la-competition-enjoy-ai/318110' },
            { src: 'frame_11_2.png', href: 'https://aujourdhui.ma/economie/lenjoy-ai-global-final-2025-des-jeunes-marocains-sur-le-podium' },
            { src: 'linformation.png', href: 'https://www.linformation.ma/news/high-tech/chine-robotique-des-jeunes-marocains-sur-le-podium-de-la-competition-internationale-enjoy-ai/61855' },
            { src: 'lamap.jpg', href: 'https://www.lamap.ma' },
            { src: 'mrworld.png', href:'https://www.moroccoworldnews.com/2025/12/271230/moroccan-teams-win-top-awards-at-enjoy-ai-global-final-2025-in-china/' },
            { src: 'maroc_diplomatique.png', href: 'https://maroc-diplomatique.net/chine-robotique-des-jeunes-marocains-sur-le-podium-de-la-competition/' },
            { src: 'le360.png', href: 'https://ar.le360.ma/culture/ZIP7HWP2RFH2TOWFKOTP3C5ELI/' },
            { src: 'leseco.png', href: 'https://leseco.ma/maroc/robotique-ia-les-marocains-brillent-au-enjoy-ai-2025-en-chine.html' },
            { src: 'frame_11_5.png', href:'https://lobservateur.info/article/115164/video/enjoy-ai-de-jeunes-talents-a-la-conquete-du-monde-de-linnovation' }
        ],
        'reportages': [
            { src: 'tv_2m.jpg', href: 'https://www.facebook.com/share/p/1GcjAEv8Gb/' },
            { src: 'frame_11_1.png' },
            { src: 'aljazira.png', href: 'https://www.aljazeera.com' },
            { src: 'luxe.png' },
            { src: 'atlantic.png' },
            { src: 'snrt_news.png', href: 'https://snrtnews.com/article/142607' }
        ]
    };

    function updateMediaContent(tabKey) {
        const images = mediaContent[tabKey];
        if (logosGrid && images) {
            logosGrid.innerHTML = '';
            images.forEach(img => {
                const logoCard = document.createElement('div');
                logoCard.className = 'logo-card';
                if (img.href) {
                    logoCard.innerHTML = `<a href="${img.href}" target="_blank" rel="noopener noreferrer"><img src="assets/images_enjoy_ai/${img.src}" alt="Media"></a>`;
                } else {
                    logoCard.innerHTML = `<img src="assets/images_enjoy_ai/${img.src}" alt="Media">`;
                }
                logosGrid.appendChild(logoCard);
            });
        }
    }

    mediaTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            mediaTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            const tabKey = this.getAttribute('data-tab');
            if (tabKey) {
                updateMediaContent(tabKey);
            }
        });
    });
    updateMediaContent('reportages');
});


const header = document.getElementById('mainHeader');

window.addEventListener('scroll', () => {
if (window.scrollY > 50) {
    header.classList.add('scrolled');
} else {
    header.classList.remove('scrolled');
}
});
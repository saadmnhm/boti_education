    <div id="stepperModal" class="stepper-modal  ">
        <div class="stepper-container container ">
            <!-- Header with Previous and Close buttons -->
            <div class="stepper-header">
                <button id="prevBtn" class="icon-btn prev-btn">
                        <img src="assets/images/prev.png" alt="">
                </button>
                <button id="closeBtn" class="icon-btn close-btn">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Step 1 -->
            <div class="step step-1 active">
                <h2 class="step-title">Êtes-vous</h2>
                
                <div class="cards-container">
                    <div class="cards_stepper cards-first-step" data-value="option2">
                        <div>

                            <img src="assets/images/stp1_icon.png" alt="">
                        </div>
                        <p class="card-text">Tuteur d'un élève</p>
                    </div>
                    <div class="cards_stepper cards-first-step" data-value="option1">
                        <div>
                            <img src="assets/images/stp1_2icon.png" alt="">
                        </div>
                        <p class="card-text">Directeur / Fondateur</p>
                        <span class="card-text-span">( Nouveau client ) </span>
                    </div>
                </div>

                <p class="step-description">Choisissez l'une des deux options et appuyez sur <span>Continuer</span> pour terminer le processus.</p>

                <button class="btn-continue" id="continueStep1" disabled>Continuer</button>
            </div>

            <div class="step step-2a">
                <h3 class="step-2-header">Vous assurez quels cycles d'enseignement</h3>

                <div class="cards-container cards-4">
                    <div class="cards_stepper small-card" data-value="pref1">
                        <div>
                            <img src="assets/images/mater.png" alt="">
                        </div>
                        <p class="card-text">Maternelle</p>
                    </div>
                    <div class="cards_stepper small-card" data-value="pref2">
                        <div>
                            <img src="assets/images/school.png" alt="">
                        </div>
                        <p class="card-text">Primaire</p>
                    </div>
                    <div class="cards_stepper small-card" data-value="pref3">
                        <div>
                            <img src="assets/images/college.png" alt="">
                        </div>
                        <p class="card-text">Collège</p>
                    </div>
                    <div class="cards_stepper small-card" data-value="pref4">
                        <div>
                            <img src="assets/images/sup.png" alt="">
                        </div>
                        <p class="card-text">Lycée</p>
                    </div>
                </div>

                <h3 class="step-2-header">Quel est le nombre total d'élèves ?</h3>

                <div class="progress-container">
                    <span class="progress-min">0</span>
                    <input type="range" id="budgetRange" class="progress-bar" min="0" max="1000" value="0">
                    <span class="progress-max" id="budgetValue">0</span>
                </div>

                <h3 class="step-2-header">Votre informations</h3>

                <div class="form-row">
                    <div class="input-wrapper">
                        <input type="text" id="firstName" class="form-input" placeholder="Nom & Prénom * " required>
                        <div class="error-message"><img src="assets/images/warning.png" alt="" style="max-width: 20px;"> Champ obligatoire</div>
                    </div>
                    <div class="input-wrapper">
                        <input type="text" id="lastName" class="form-input" placeholder="Nom de votre école * " required>
                        <div class="error-message"><img src="assets/images/warning.png" alt="" > Champ obligatoire</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="input-wrapper">
                        <input type="tel" id="phone" class="form-input" placeholder="Numéro de Téléphone * " required>
                        <div class="error-message"><img src="assets/images/warning.png" alt="" > Champ obligatoire</div>
                    </div>
                    <div class="input-wrapper">
                        <input type="email" id="email" class="form-input" placeholder="Adresse E-mail *" required>
                        <div class="error-message"><img src="assets/images/warning.png" alt="" > Champ obligatoire</div>
                    </div>
                    <div class="input-wrapper">
                        <select id="address" class="form-input" placeholder="Adresse" required>
                            <option value="" disabled selected>Adresse *</option>
                            <option value="address1">Adresse 1</option>
                            <option value="address2">Adresse 2</option>
                            <option value="address3">Adresse 3</option>
                        </select>
                        <div class="error-message"><i class="fas fa-exclamation"></i> Champ obligatoire</div>
                    </div>
                </div>
                <p class="oblig-chmp">* pour les champs obligatoire</p>

                <button class="btn-continue" id="continueStep2a" disabled>Demander une présentation</button>
            </div>

            <div class="step step-2b">
                <h2 class="step-title">Vous recontrez des difficultés pour vous connecter a votre compte.</h2>
                
                <div class="choice-container">
                    <button class="choice-btn" id="choiceBtn1">
                        <img src="assets/images/stp1_icon.png" alt="">
                        <p>Contactez votre administration</p>
                        <p class="arabic-text">تواصل مباشرة مع الإدارة</p>
                    </button>
                    
                    <div class="choice-divider">
                        <div class="divider-line"></div>
                        <span class="divider-text">Ou</span>
                        <div class="divider-line"></div>
                    </div>
                    
                    <button class="choice-btn" id="choiceBtn2">
                        <img src="assets/images/stp1_2icon.png" alt="">
                        <p>Foire de question & Aide</p>
                        <p class="arabic-text">الأسئلة الشائعة والمساعدة</p>
                    </button>
                </div>
                
                <p class="step-description">Choisissez l'option qui vous convient le mieux.</p>
            </div>

            <!-- Step 3: FAQ and Contact/Video -->
            <div class="step step-3">
                <div class="step-3-container">
                    <!-- Left side: FAQ -->
                    <div class="step-3-left">
                        <h3 class="step-3-title">Questions fréquentes</h3>
                        
                        <div class="faq-container">
                            <div class="faq-item">
                                <div class="faq-question">
                                    <span>Comment fonctionne Boti School ?</span>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div class="faq-answer">
                                    <p>Boti School est une plateforme complète qui vous permet de gérer facilement votre établissement scolaire. Elle offre des outils pour la gestion des élèves, des notes, de la communication et bien plus encore.</p>
                                </div>
                            </div>
                            
                            <div class="faq-item">
                                <div class="faq-question">
                                    <span>Quels sont les tarifs ?</span>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div class="faq-answer">
                                    <p>Nos tarifs sont adaptés à la taille de votre établissement. Contactez-nous pour obtenir un devis personnalisé adapté à vos besoins spécifiques.</p>
                                </div>
                            </div>
                            
                            <div class="faq-item">
                                <div class="faq-question">
                                    <span>Est-ce que mes données sont sécurisées ?</span>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div class="faq-answer">
                                    <p>Absolument ! Nous utilisons les dernières technologies de sécurité pour protéger vos données. Toutes les informations sont cryptées et stockées de manière sécurisée.</p>
                                </div>
                            </div>
                            
                            <div class="faq-item">
                                <div class="faq-question">
                                    <span>Puis-je essayer avant d'acheter ?</span>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div class="faq-answer">
                                    <p>Oui ! Nous offrons une période d'essai gratuite de 30 jours pour que vous puissiez tester toutes les fonctionnalités de Boti School.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="step-3-right">
                        <p class="step-3-description">Notre équipe est là pour répondre à toutes vos questions et vous accompagner dans votre découverte de Boti School.</p>
                        
                        <div class="contact-buttons">
                            <a href="https://wa.me/1234567890" class="contact-btn whatsapp-btn" target="_blank">
                                <img src="assets/images/whatsapp.png" alt="WhatsApp">
                                <div>
                                    <p>WhatsApp</p>
                                    <span>06 XX XX XX XX</span>
                                </div>
                            </a>
                            <a href="tel:+1234567890" class="contact-btn call-btn">
                                <img src="assets/images/appel.png" alt="Appeler">
                                <div>
                                    <p>Appeler</p>
                                    <span>06 XX XX XX XX</span>
                                </div>

                            </a>
                        </div>
                        
                        <div class="video-section">
                            <div class="learn-vd">
                                <div class="video-thumbnail" id="videoThumbnail">
                                    <img src="assets/images/video-thumb.png" alt="Video">
                                    <div class="play-button">
                                        <i class="fas fa-play"></i>
                                    </div>
                                </div>
                                <div class="video-info">
                                    <h4 class="video-title">Découvrez Boti School en vidéo</h4>
                                    <p class="video-description">Une présentation complète de notre plateforme et de toutes ses fonctionnalités en quelques minutes.</p>
                                </div>
                            </div>
                            <div class="learn-vd">
                                <div class="video-thumbnail" id="videoThumbnail">
                                    <img src="assets/images/video-thumb.png" alt="Video">
                                    <div class="play-button">
                                        <i class="fas fa-play"></i>
                                    </div>
                                </div>
                                <div class="video-info">
                                    <h4 class="video-title">Découvrez Boti School en vidéo</h4>
                                    <p class="video-description">Une présentation complète de notre plateforme et de toutes ses fonctionnalités en quelques minutes.</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Success Step -->
            <div class="step step-success">
                <div class="success-content">
                    <i class="fas fa-check-circle success-icon"></i>
                    <h2 class="success-title">Votre demande a été envoyée.</h2>
                    <p class="success-message">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                    <button class="btn-continue" id="closeSuccess" style="max-width: 480px;">Fermer</button>
                </div>
            </div>
        </div>
    </div>
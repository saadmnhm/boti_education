let currentStep = 1;
let selectedOption = null;
let selectedPreference = null;
let formData = {
    firstName: '',
    lastName: '',
    email: '',
    phone: '',
    address: '',
    budget: 0
};

const openStepperBtn = document.querySelectorAll('.openStepperBtn');
const modal = document.getElementById('stepperModal');
const closeBtn_stepper = document.getElementById('closeBtn_stepper');
const prevBtn = document.getElementById('prevBtn');
const step1 = document.querySelector('.step-1');
const step2a = document.querySelector('.step-2a');
const step2b = document.querySelector('.step-2b');
const step3 = document.querySelector('.step-3');
const stepSuccess = document.querySelector('.step-success');

const step1Cards = document.querySelectorAll('.step-1 .cards_stepper');
const continueStep1Btn = document.getElementById('continueStep1');

const step2aCards = document.querySelectorAll('.step-2a .cards_stepper');
const continueStep2aBtn = document.getElementById('continueStep2a');
const choiceBtn1 = document.getElementById('choiceBtn1');
const choiceBtn2 = document.getElementById('choiceBtn2');
const budgetRange = document.getElementById('budgetRange');
const budgetValue = document.getElementById('budgetValue');
const firstNameInput = document.getElementById('firstName');
const lastNameInput = document.getElementById('lastName');
const emailInput = document.getElementById('email');
const phoneInput = document.getElementById('phone');
const addressInput = document.getElementById('address');

const closeSuccessBtn = document.getElementById('closeSuccess');

function init() {
    setupEventListeners();
    updatePrevButton();
}

function setupEventListeners() {
    // Fix: Add event listener to each button in the NodeList
    openStepperBtn.forEach(button => {
        button.addEventListener('click', openModal);
    });
    
    closeBtn_stepper.addEventListener('click', closeModal);
    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });

    prevBtn.addEventListener('click', goToPreviousStep);

    step1Cards.forEach(card => {
        card.addEventListener('click', () => selectCard(card, 'step1'));
    });
    continueStep1Btn.addEventListener('click', goToNextFromStep1);

    step2aCards.forEach(card => {
        card.addEventListener('click', () => selectCard(card, 'step2a'));
    });
    
    budgetRange.addEventListener('input', updateBudget);
    
    const inputs = [firstNameInput, lastNameInput, emailInput, phoneInput, addressInput];
    inputs.forEach(input => {
        input.addEventListener('input', validateForm);
        input.addEventListener('blur', () => validateInput(input));
    });
    
    continueStep2aBtn.addEventListener('click', submitForm);

    // Step 2b choice buttons
    if (choiceBtn1) {
        choiceBtn1.addEventListener('click', () => {
            // Go to Step 3 (FAQ)
            showStep('step3');
        });
    }
    
    if (choiceBtn2) {
        choiceBtn2.addEventListener('click', () => {
            // Go to Step 3 (FAQ)
            showStep('step3');
        });
    }

    closeSuccessBtn.addEventListener('click', closeModal);
    
    // FAQ collapse functionality
    initFAQ();
    
    // Video popup functionality
    initVideoPopup();
}

function openModal() {
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    modal.classList.remove('active');
    document.body.style.overflow = 'auto';
    resetStepper();
}

function resetStepper() {
    currentStep = 1;
    selectedOption = null;
    selectedPreference = null;
    
    document.querySelectorAll('.cards_stepper').forEach(card => {
        card.classList.remove('selected');
    });
    
    formData = {
        firstName: '',
        lastName: '',
        email: '',
        phone: '',
        address: '',
        budget: 0
    };
    
    firstNameInput.value = '';
    lastNameInput.value = '';
    emailInput.value = '';
    phoneInput.value = '';
    addressInput.value = '';
    budgetRange.value = 0;
    budgetValue.textContent = '0';
    
    continueStep1Btn.disabled = true;
    continueStep2aBtn.disabled = true;
    
    showStep('step1');
}

function showStep(stepName) {
    currentStep = stepName;
    
    step1.classList.remove('active');
    if (step2a) step2a.classList.remove('active');
    if (step2b) step2b.classList.remove('active');
    if (step3) step3.classList.remove('active');
    stepSuccess.classList.remove('active');
    
    if (stepName === 'step1') {
        step1.classList.add('active');
    } else if (stepName === 'step2a') {
        if (step2a) step2a.classList.add('active');
    } else if (stepName === 'step2b') {
        if (step2b) step2b.classList.add('active');
    } else if (stepName === 'step3') {
        if (step3) step3.classList.add('active');
    } else if (stepName === 'success') {
        stepSuccess.classList.add('active');
    }
    
    updatePrevButton();
}

function updatePrevButton() {
    if (currentStep === 'step1') {
        prevBtn.disabled = true;
        prevBtn.style.visibility = 'hidden';
    } else {
        prevBtn.disabled = false;
        prevBtn.style.visibility = 'visible';
    }
}

function goToPreviousStep() {
    if (currentStep === 'step2a' || currentStep === 'step2b') {
        showStep('step1');
    } else if (currentStep === 'step3') {
        // Go back to step2b if user came from Directeur path
        if (selectedOption === 'option2') {
            showStep('step2b');
        } else {
            showStep('step1');
        }
    } else if (currentStep === 'success') {
        showStep('step2a');
    }
}

function goToNextFromStep1() {
    if (selectedOption) {
        // If option1 (Tuteur), go to step2a
        // If option2 (Directeur), go to step2b
        if (selectedOption === 'option1') {
            showStep('step2a');
        } else if (selectedOption === 'option2') {
            showStep('step2b');
        }
    }
}

function selectCard(card, step) {
    if (step === 'step1') {
        step1Cards.forEach(c => c.classList.remove('selected'));
        card.classList.add('selected');
        selectedOption = card.dataset.value;
        continueStep1Btn.disabled = false;
    } else if (step === 'step2a') {
        step2aCards.forEach(c => c.classList.remove('selected'));
        card.classList.add('selected');
        selectedPreference = card.dataset.value;
        validateForm();
    }
}

function updateBudget() {
    const value = budgetRange.value;
    budgetValue.textContent = value;
    formData.budget = parseInt(value);
    
    const percentage = (value / budgetRange.max) * 100;
    budgetRange.style.background = `linear-gradient(to right, #F8539F 0%, #F8539F ${percentage}%, #e0e0e0 ${percentage}%, #e0e0e0 100%)`;
    
    validateForm();
}

function validateInput(input) {
    const value = input.value.trim();
    
    if (input.hasAttribute('required')) {
        if (value === '') {
            input.classList.add('invalid');
            input.classList.remove('valid');
            return false;
        } else {
            if (input.type === 'email') {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(value)) {
                    input.classList.add('invalid');
                    input.classList.remove('valid');
                    return false;
                }
            }
            
            if (input.type === 'tel') {
                const phoneRegex = /^[0-9+\-\s()]+$/;
                if (!phoneRegex.test(value) || value.length < 8) {
                    input.classList.add('invalid');
                    input.classList.remove('valid');
                    return false;
                }
            }
            
            input.classList.remove('invalid');
            input.classList.add('valid');
            return true;
        }
    }
    
    return true;
}

function validateForm() {
    const isFirstNameValid = firstNameInput.value.trim() !== '';
    const isLastNameValid = lastNameInput.value.trim() !== '';
    const isEmailValid = emailInput.value.trim() !== '' && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value);
    const isPhoneValid = phoneInput.value.trim() !== '' && phoneInput.value.trim().length >= 8;
    const isAddressValid = addressInput.value.trim() !== '';
    const isPreferenceSelected = selectedPreference !== null;
    
    const allValid = isFirstNameValid && isLastNameValid && isEmailValid && isPhoneValid && isAddressValid && isPreferenceSelected;
    
    continueStep2aBtn.disabled = !allValid;
}

function submitForm() {
    const inputs = [firstNameInput, lastNameInput, emailInput, phoneInput, addressInput];
    let allValid = true;
    
    inputs.forEach(input => {
        if (!validateInput(input)) {
            allValid = false;
        }
    });
    
    if (allValid && selectedPreference) {
        formData.firstName = firstNameInput.value.trim();
        formData.lastName = lastNameInput.value.trim();
        formData.email = emailInput.value.trim();
        formData.phone = phoneInput.value.trim();
        formData.address = addressInput.value.trim();
        
        // Prepare email data
        const emailData = {
            step1: selectedOption,
            step2: selectedPreference,
            ...formData
        };
        
        // Send data by email using mailto
        sendEmail(emailData);
        
        showStep('success');
    }
}

function sendEmail(data) {
    // Create email body with formatted data
    const subject = encodeURIComponent('Nouvelle soumission de formulaire Stepper');
    const body = encodeURIComponent(
        `Nouvelle soumission de formulaire:\n\n` +
        `Étape 1 - Êtes-vous: ${data.step1}\n\n` +
        `Étape 2 - Type de local: ${data.step2}\n` +
        `Nombre d'élèves: ${data.budget}\n\n` +
        `Informations:\n` +
        `Nom & Prénom: ${data.firstName}\n` +
        `Nom de l'école: ${data.lastName}\n` +
        `Email: ${data.email}\n` +
        `Téléphone: ${data.phone}\n` +
        `Adresse: ${data.address}\n\n` +
        `Date: ${new Date().toLocaleString('fr-FR')}`
    );
    
}

init();

function openModal() {
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
    
    const offcanvasElement = document.getElementById('offcanvasExample');
    if (offcanvasElement) {
        const offcanvasInstance = bootstrap.Offcanvas.getInstance(offcanvasElement);
        if (offcanvasInstance) {
            offcanvasInstance.hide();
        }
    }
}

// FAQ Collapse functionality
function initFAQ() {
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        
        question.addEventListener('click', () => {
            const isActive = item.classList.contains('active');
            
            // Close all other FAQ items
            faqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                }
            });
            
            // Toggle current item
            if (isActive) {
                item.classList.remove('active');
            } else {
                item.classList.add('active');
            }
        });
    });
}

// Video Popup functionality
function initVideoPopup() {
    // Create video popup element
    const videoPopup = document.createElement('div');
    videoPopup.className = 'video-popup';
    videoPopup.innerHTML = `
        <div class="video-popup-content">
            <button class="video-popup-close">
                <i class="fas fa-times"></i>
            </button>
            <iframe id="videoIframe" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    `;
    document.body.appendChild(videoPopup);
    
    const videoThumbnail = document.getElementById('videoThumbnail');
    const videoIframe = document.getElementById('videoIframe');
    const videoPopupClose = videoPopup.querySelector('.video-popup-close');
    
    // YouTube video ID (replace with actual video ID)
    const videoId = 'dQw4w9WgXcQ'; // Example YouTube video ID
    
    if (videoThumbnail) {
        videoThumbnail.addEventListener('click', () => {
            videoPopup.classList.add('active');
            videoIframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
            document.body.style.overflow = 'hidden';
        });
    }
    
    if (videoPopupClose) {
        videoPopupClose.addEventListener('click', closeVideoPopup);
    }
    
    videoPopup.addEventListener('click', (e) => {
        if (e.target === videoPopup) {
            closeVideoPopup();
        }
    });
    
    function closeVideoPopup() {
        videoPopup.classList.remove('active');
        videoIframe.src = '';
        document.body.style.overflow = 'auto';
    }
}
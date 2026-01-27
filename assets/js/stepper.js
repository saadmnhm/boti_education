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

const openBtn_stepper = document.querySelector('#openStepperBtn, .openStepperBtn');
const modal = document.querySelector('#stepperModal');
const closeBtn_stepper = document.querySelector('#closeBtn_stepper');
const prevBtn = document.querySelector('#prevBtn');
const step1 = document.querySelector('.step-1');
const step2 = document.querySelector('.step-2');
const stepSuccess = document.querySelector('.step-success');

const step1Cards = document.querySelectorAll('.step-1 .card');
const continueStep1Btn = document.querySelector('#continueStep1');

const step2Cards = document.querySelectorAll('.step-2 .card');
const continueStep2Btn = document.querySelector('#continueStep2');
const budgetRange = document.querySelector('#budgetRange');
const budgetValue = document.querySelector('#budgetValue');
const firstNameInput = document.querySelector('#firstName');
const lastNameInput = document.querySelector('#lastName');
const emailInput = document.querySelector('#email');
const phoneInput = document.querySelector('#phone');
const addressInput = document.querySelector('#address');

const closeSuccessBtn = document.querySelector('#closeSuccess');

function init() {
    setupEventListeners();
    updatePrevButton();
}

function setupEventListeners() {
    // Support multiple open buttons
    const openButtons = document.querySelectorAll('#openStepperBtn, .openStepperBtn');
    openButtons.forEach(btn => {
        btn.addEventListener('click', openModal);
    });
    
    closeBtn_stepper.addEventListener('click', closeModal);
    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });

    prevBtn.addEventListener('click', goToPreviousStep);

    step1Cards.forEach(card => {
        card.addEventListener('click', () => selectCard(card, 'step1'));
    });
    continueStep1Btn.addEventListener('click', goToStep2);

    step2Cards.forEach(card => {
        card.addEventListener('click', () => selectCard(card, 'step2'));
    });
    
    budgetRange.addEventListener('input', updateBudget);
    
    const inputs = [firstNameInput, lastNameInput, emailInput, phoneInput, addressInput];
    inputs.forEach(input => {
        input.addEventListener('input', validateForm);
        input.addEventListener('blur', () => validateInput(input));
    });
    
    continueStep2Btn.addEventListener('click', submitForm);

    closeSuccessBtn.addEventListener('click', closeModal);
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
    
    document.querySelectorAll('.card').forEach(card => {
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
    continueStep2Btn.disabled = true;
    
    showStep(1);
}

function showStep(stepNumber) {
    currentStep = stepNumber;
    
    step1.classList.remove('active');
    step2.classList.remove('active');
    stepSuccess.classList.remove('active');
    
    if (stepNumber === 1) {
        step1.classList.add('active');
    } else if (stepNumber === 2) {
        step2.classList.add('active');
    } else if (stepNumber === 3) {
        stepSuccess.classList.add('active');
    }
    
    updatePrevButton();
}

function updatePrevButton() {
    if (currentStep === 1) {
        prevBtn.disabled = true;
        prevBtn.style.visibility = 'hidden';
    } else {
        prevBtn.disabled = false;
        prevBtn.style.visibility = 'visible';
    }
}

function goToPreviousStep() {
    if (currentStep > 1) {
        showStep(currentStep - 1);
    }
}

function goToStep2() {
    if (selectedOption) {
        showStep(2);
    }
}

function selectCard(card, step) {
    if (step === 'step1') {
        step1Cards.forEach(c => c.classList.remove('selected'));
        card.classList.add('selected');
        selectedOption = card.dataset.value;
        continueStep1Btn.disabled = false;
    } else if (step === 'step2') {
        step2Cards.forEach(c => c.classList.remove('selected'));
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
    
    continueStep2Btn.disabled = !allValid;
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
        
        const submitData = {
            op: 'stepper',
            step1: selectedOption,
            step2: selectedPreference,
            firstName: formData.firstName,
            lastName: formData.lastName,
            email: formData.email,
            phone: formData.phone,
            address: formData.address,
            budget: formData.budget
        };
        
        // Send email to admin
        fetch('mail.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams(submitData)
        })
        .then(response => response.text())
        .then(data => {
            console.log('Server response:', data);
            try {
                const jsonData = JSON.parse(data);
                if (jsonData.status === 'success') {
                    console.log('Email sent successfully');
                } else {
                    console.error('Email sending failed:', jsonData.message);
                }
            } catch(e) {
                console.log('Response (not JSON):', data);
            }
        })
        .catch(error => {
            console.error('Error sending email:', error);
        });
        
        showStep(3);
    }
}

init();
function validateForm() {
    // Get form elements
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var phone = document.getElementById("phone").value;
    var age = document.getElementById("age").value;
    var products = document.getElementsByName("products[]");
    var satisfaction = document.getElementsByName("satisfaction");
    var feedbackType = document.getElementById("feedbackType").value;
    var feedback = document.getElementById("feedback").value;

    // Validate name
    if (name.trim() === "" || name.trim().length < 2) {
        alert("Name is required.");
        return false;
    }

    // Validate email
    if (email.trim() === "") {
        alert("Email is required.");
        return false;
    } else {
        var emailReg = /^\S+@\S+\.\S+$/;
        if (!emailReg.test(email)) {
            alert("Please enter a valid email address.");
            return false;
        }
    }

    // Validate phone
    if (phone.trim() === "") {
        alert("Phone number is required.");
        return false;
    } else if (!/^\d{10}$/.test(phone)) {
        alert("Phone number must be 10 digits.");
        return false;
    }

    // Validate age if provided
    if (age.trim() !== "") {
        if (isNaN(age) || age < 15 || age > 100) {
            alert("Age must be between 13 and 120.");
            return false;
        }
    }

    // Validate products (checkboxes)
    var productsSelected = false;
    for (var i = 0; i < products.length; i++) {
        if (products[i].checked) {
            productsSelected = true;
            break;
        }
    }
    if (!productsSelected) {
        alert("Please select at least one product.");
        return false;
    }

    // Validate satisfaction
    var satisfactionSelected = false;
    for (var i = 0; i < satisfaction.length; i++) {
        if (satisfaction[i].checked) {
            satisfactionSelected = true;
            break;
        }
    }
    if (!satisfactionSelected) {
        alert("Please select your satisfaction level.");
        return false;
    }

    // Validate feedback type
    if (feedbackType === "") {
        alert("Please select a feedback type.");
        return false;
    }

    // Validate feedback comments
    if (feedback.trim().length < 10) {
        alert("Feedback must be at least 10 characters.");
        return false;
    }

    return true;
}

//-----------------------------------------------------------------------------------

// Validate for the Admin page 

function validateAdminForm() {
    const name = document.querySelector('input[name="admin_name"]').value.trim();
    const email = document.querySelector('input[name="admin_email"]').value.trim();
    const password = document.querySelector('input[name="admin_password"]').value;

    if (name.length < 2) {
        alert('Name must be at least 2 characters');
        return false;
    }

    if (!email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
        alert('Please enter a valid email');
        return false;
    }

    if (password.length < 6) {
        alert('Password must be at least 6 characters');
        return false;
    }

    return true;
}

// for product update

function validateProductUpdate(formId) {
    let errors = [];
    
    // Get form inputs
    const price = document.getElementById('price_' + formId).value;
    const description = document.getElementById('description_' + formId).value.trim();
    
    // Price validation
    if (!price || isNaN(price) || parseFloat(price) <= 0) {
        errors.push("Price must be greater than 0");
        document.getElementById('price_' + formId).classList.add('error');
    }
    
    // Description validation
    if (description.length < 10) {
        errors.push("Description must be at least 10 characters");
        document.getElementById('description_' + formId).classList.add('error');
    }
    
    // If there are errors, show them and prevent form submission
    if (errors.length > 0) {
        alert(errors.join('\n'));
        return false;
    }
    
    return true;
}
//---------------------------------------------------------------------

//login and singup Validation
 

// Utility functions
function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function validatePassword(password) {
    // At least 6 characters
    return password.length >= 6;
}

function validateName(name) {
    // At least 2 characters, only letters and spaces
    const nameRegex = /^[A-Za-z\s]{2,}$/;
    return nameRegex.test(name.trim());
}
//---------------------------------------------------------------------


// Login form validation --only need to validate email and see if there is a password
function validateLoginForm() {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    let isValid = true;
    let errorMessage = '';

    // Email validation
    if (!email.trim()) {
        errorMessage += 'Email is required\n';
        isValid = false;
    } else if (!validateEmail(email)) {
        errorMessage += 'Please enter a valid email address\n';
        isValid = false;
    }

    // Password validation
    if (!password) {
        errorMessage += 'Password is required\n';
        isValid = false;
    }

    if (!isValid) {
        alert(errorMessage);
        return false;
    }

    return true;
}

// Signup form validation
function validateSignupForm() {
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm-password').value;
    let isValid = true;
    let errorMessage = '';

    // Name validation
    if (!name.trim()) {
        errorMessage += 'Name is required\n';
        isValid = false;
    } else if (!validateName(name)) {
        errorMessage += 'Name should only contain letters and be at least 2 characters long\n';
        isValid = false;
    }

    // Email validation
    if (!email.trim()) {
        errorMessage += 'Email is required\n';
        isValid = false;
    } else if (!validateEmail(email)) {
        errorMessage += 'Please enter a valid email address\n';
        isValid = false;
    }

    // Password validation
    if (!password) {
        errorMessage += 'Password is required\n';
        isValid = false;
    } else if (!validatePassword(password)) {
        errorMessage += 'Password must be at least 6 characters long\n';
        isValid = false;
    }

    // Confirm password validation
    if (password !== confirmPassword) {
        errorMessage += 'Passwords do not match\n';
        isValid = false;
    }

    if (!isValid) {
        alert(errorMessage);
        return false;
    }

    return true;
}
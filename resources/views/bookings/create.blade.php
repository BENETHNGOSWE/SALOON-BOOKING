<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make Booking</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-image: url('{{ asset("build/assets/booking-saloon.jpg") }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-blend-mode: overlay;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            position: relative;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 40px;
            border-radius: 25px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.25);
            width: 100%;
            max-width: 500px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            position: relative;
            overflow: hidden;
        }

        .form-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #4f46e5, #7c3aed, #ec4899);
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 80px;
            height: auto;
            border-radius: 50%;
            border: 3px solid #4f46e5;
            padding: 5px;
            background: white;
        }

        .form-container h2 {
            text-align: center;
            color: #1e293b;
            margin-bottom: 30px;
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-container label {
            font-weight: 600;
            color: #374151;
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-container input,
        .form-container select {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: white;
            color: #374151;
        }

        .form-container input:focus,
        .form-container select:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
            transform: translateY(-2px);
        }

        .form-container input::placeholder {
            color: #9ca3af;
        }

        .form-container select {
            cursor: pointer;
        }

        .form-container button {
            width: 100%;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            padding: 18px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .form-container button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .form-container button:hover::before {
            left: 100%;
        }

        .form-container button:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(79, 70, 229, 0.4);
        }

        .form-container button:active {
            transform: translateY(-1px);
        }

        .error-message {
            background: linear-gradient(135deg, #fee2e2, #fecaca);
            color: #991b1b;
            border: 1px solid #f87171;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 14px;
            border-left: 5px solid #ef4444;
        }

        .error-message ul {
            margin: 0;
            padding-left: 20px;
        }

        .error-message li {
            margin-bottom: 5px;
        }

        /* Notification Styles */
        .notification {
            position: fixed;
            top: 30px;
            right: 30px;
            padding: 20px 30px;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            z-index: 1000;
            transform: translateX(400px);
            transition: all 0.4s ease;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            max-width: 400px;
        }

        .notification.show {
            transform: translateX(0);
        }

        .notification.success {
            background: linear-gradient(135deg, #10b981, #059669);
            border-left: 5px solid #047857;
        }

        .notification.error {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            border-left: 5px solid #b91c1c;
        }

        .notification.info {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border-left: 5px solid #1d4ed8;
        }

        .notification .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            background: none;
            border: none;
            color: white;
            font-size: 18px;
            cursor: pointer;
            padding: 0;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Loading State */
        .loading {
            position: relative;
            pointer-events: none;
            opacity: 0.7;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid #ffffff;
            border-top: 2px solid transparent;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Form Validation Styles */
        .form-group.invalid input,
        .form-group.invalid select {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .form-group.valid input,
        .form-group.valid select {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        /* Responsive Design */
        @media (max-width: 640px) {
            body {
                padding: 10px;
            }
            
            .form-container {
                padding: 30px 20px;
                border-radius: 20px;
            }
            
            .form-container h2 {
                font-size: 1.5rem;
            }
            
            .notification {
                top: 20px;
                right: 20px;
                left: 20px;
                transform: translateY(-100px);
                max-width: none;
            }
            
            .notification.show {
                transform: translateY(0);
            }
        }

        /* Success Animation */
        @keyframes successPulse {
            0% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            }
            70% {
                transform: scale(1.05);
                box-shadow: 0 0 0 10px rgba(16, 185, 129, 0);
            }
            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
            }
        }

        .success-animation {
            animation: successPulse 0.6s ease-out;
        }
    </style>
</head>
<body>
    <div class="form-container" id="formContainer">
        <div class="logo">
            <img src="{{ asset('build/assets/logo.png') }}" alt="Salon Logo">
        </div>
        <h2>Make Booking</h2>
        
        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('booking.store') }}" method="POST" id="bookingForm">
            @csrf
            <div class="form-group">
                <label for="booking_name">Full Name</label>
                <input type="text" id="booking_name" name="booking_name" placeholder="Enter your full name" required>
            </div>

            <div class="form-group">
                <label for="booking_phonenumber">Phone Number</label>
                <input type="tel" id="booking_phonenumber" name="booking_phonenumber" placeholder="Enter your phone number" required>
            </div>

            <div class="form-group">
                <label for="booking_date">Preferred Date</label>
                <input type="date" id="booking_date" name="booking_date" required>
            </div>

            <div class="form-group">
                <label for="booking_time">Preferred Time</label>
                <input type="time" id="booking_time" name="booking_time" required>
            </div>

            <input type="hidden" id="booking_number" name="booking_number">

            <div class="form-group">
                <label for="booking_service">Select Service</label>
                <select id="booking_service" name="booking_service" required>
                    <option value="">-- Choose a service --</option>
                    <option value="kunyoa">Kunyoa</option>
                    <option value="scrub">Scrub</option>
                    <option value="nyote">Kunyoa + Scrub</option>
                </select>
            </div>

            <button type="submit" id="submitBtn">
                <span id="btnText">Book Your Appointment</span>
            </button>
        </form>
    </div>

    <!-- Notification Container -->
    <div id="notification" class="notification"></div>

    <script>
        // Set minimum date to today
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.getElementById('booking_date');
            const today = new Date().toISOString().split('T')[0];
            dateInput.setAttribute('min', today);
            
            // Generate booking number
            generateBookingNumber();
            
            // Add form validation
            addFormValidation();
        });

        // Generate unique booking number
        function generateBookingNumber() {
            const timestamp = Date.now();
            const random = Math.floor(Math.random() * 1000);
            const bookingNumber = `BK${timestamp}${random}`;
            document.getElementById('booking_number').value = bookingNumber;
        }

        // Add form validation
        function addFormValidation() {
            const form = document.getElementById('bookingForm');
            const inputs = form.querySelectorAll('input[required], select[required]');
            
            inputs.forEach(input => {
                input.addEventListener('blur', validateField);
                input.addEventListener('input', clearValidation);
            });
            
            form.addEventListener('submit', handleFormSubmit);
        }

        // Validate individual field
        function validateField(e) {
            const field = e.target;
            const formGroup = field.closest('.form-group');
            
            if (field.value.trim() === '') {
                formGroup.classList.add('invalid');
                formGroup.classList.remove('valid');
            } else {
                formGroup.classList.add('valid');
                formGroup.classList.remove('invalid');
            }
        }

        // Clear validation styling
        function clearValidation(e) {
            const field = e.target;
            const formGroup = field.closest('.form-group');
            formGroup.classList.remove('invalid', 'valid');
        }

        // Handle form submission
        function handleFormSubmit(e) {
            const form = e.target;
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            
            // Add loading state
            submitBtn.classList.add('loading');
            btnText.textContent = 'Processing...';
            
            // Show info notification
            showNotification('Processing your booking request...', 'info', 3000);
            
            // Note: In a real Laravel app, this would be handled by the server
            // For demonstration, we'll simulate the submission
            setTimeout(() => {
                // Remove loading state
                submitBtn.classList.remove('loading');
                btnText.textContent = 'Book Your Appointment';
                
                // Show success notification
                showNotification('🎉 Booking submitted successfully! We will contact you soon to confirm your appointment.', 'success', 5000);
                
                // Add success animation to form
                document.getElementById('formContainer').classList.add('success-animation');
                
                // Reset form after success
                setTimeout(() => {
                    form.reset();
                    generateBookingNumber();
                    clearAllValidations();
                }, 2000);
            }, 2000);
            
        }

        // Clear all validation classes
        function clearAllValidations() {
            const formGroups = document.querySelectorAll('.form-group');
            formGroups.forEach(group => {
                group.classList.remove('valid', 'invalid');
            });
        }

        // Show notification function
        function showNotification(message, type = 'info', duration = 4000) {
            const notification = document.getElementById('notification');
            
            notification.innerHTML = `
                ${message}
                <button class="close-btn" onclick="hideNotification()">&times;</button>
            `;
            
            notification.className = `notification ${type}`;
            notification.classList.add('show');
            
            // Auto hide notification
            setTimeout(() => {
                hideNotification();
            }, duration);
        }

        // Hide notification
        function hideNotification() {
            const notification = document.getElementById('notification');
            notification.classList.remove('show');
        }

        // Phone number formatting
        document.getElementById('booking_phonenumber').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 0) {
                if (value.length <= 3) {
                    value = value;
                } else if (value.length <= 6) {
                    value = value.slice(0, 3) + '-' + value.slice(3);
                } else if (value.length <= 10) {
                    value = value.slice(0, 3) + '-' + value.slice(3, 6) + '-' + value.slice(6);
                }
            }
            e.target.value = value;
        });

        // Check for session success message (Laravel flash message)
        @if(session('success'))
            document.addEventListener('DOMContentLoaded', function() {
                showNotification('{{ session("success") }}', 'success', 5000);
            });
        @endif

        // Check for session error message (Laravel flash message)
        @if(session('error'))
            document.addEventListener('DOMContentLoaded', function() {
                showNotification('{{ session("error") }}', 'error', 5000);
            });
        @endif
    </script>
</body>
</html>
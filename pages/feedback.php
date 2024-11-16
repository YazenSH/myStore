<?php include '../includes/header.php'; ?>

<div class="container">
    <h2>Customer Feedback</h2>
    <form class="feedback-form" id="feedbackForm" action="../php_actions/process_feedback.php" method="post" onsubmit="return validateForm()">
        <fieldset>
            <legend>Personal Information</legend>
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name"/>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email"/>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone"/>
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="text" id="age" name="age"/>
            </div>
        </fieldset>

        <fieldset>
            <legend>Product Information</legend>
            <div class="form-group">
                <label>Products Purchased:</label>
                <div class="checkbox-group">
                    <div class="checkbox-item">
                        <input type="checkbox" id="cameras" name="products[]" value="cameras"/>
                        <label for="cameras">Cameras</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="lenses" name="products[]" value="lenses"/>
                        <label for="lenses">Lenses</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="accessories" name="products[]" value="accessories"/>
                        <label for="accessories">Accessories</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Satisfaction Level:</label>
                <div class="radio-group">
                    <div class="radio-item">
                        <input type="radio" id="satisfied" name="satisfaction" value="satisfied"/>
                        <label for="satisfied">Satisfied</label>
                    </div>
                    <div class="radio-item">
                        <input type="radio" id="neutral" name="satisfaction" value="neutral"/>
                        <label for="neutral">Neutral</label>
                    </div>
                    <div class="radio-item">
                        <input type="radio" id="dissatisfied" name="satisfaction" value="dissatisfied"/>
                        <label for="dissatisfied">Dissatisfied</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="feedbackType">Type of Feedback:</label>
                    <select id="feedbackType" name="feedbackType" >
                        <option value="">Select feedback type</option>
                        <option value="General">General</option>
                        <option value="Product Quality">Product Quality</option>
                        <option value="Customer Service">Customer Service</option>
                        <option value="Website">Website Experience</option>
                        <option value="Shipping">Shipping & Delivery</option>
                    </select>
            </div>
        </fieldset>

        <fieldset>
            <legend>Your Feedback</legend>
            <div class="form-group">
                <label for="feedback">Comments:</label>
                <textarea id="feedback" name="feedback" ></textarea>
            </div>
        </fieldset>

        <div class="form-group">
            <button type="submit" class="submit-btn">Submit Feedback</button>
        </div>
    </form>
</div>

<script src="../js/validation.js" type="text/javascript"></script>

<?php include '../includes/footer.php'; ?>
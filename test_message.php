<form role="form" action="views/Visitor_Message/Vmessage.php"  id="contactForm" method="post">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Name *" name="visitor_name" id="visitor_name" required data-validation-required-message="Please enter your name.">
                <p class="help-block text-danger"></p>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" placeholder="Your Email *" name="visitor_email" id="visitor_email" required data-validation-required-message="Please enter your email address.">
                <p class="help-block text-danger"></p>
            </div>
            <div class="form-group">
                <input type="tel" class="form-control" placeholder="Your Phone *" name="visitor_phone" id="visitor_phone" required data-validation-required-message="Please enter your phone number.">
                <p class="help-block text-danger"></p>
            </div>

            <div class="form-group">
                <label class="sr-only" for="form-email">Your City</label>
                <select  type="text" name="district_cd" class="form-control" id="form-email" required>
                    <option selected>Select Your City</option>
                    <?php
                    $i=0;
                    foreach ($alcity as $city){
                        echo "<option value=\"".$city['district_cd']."\">".$city['district_name']."</option>";
                    }
                    ?>
                </select>
                <p class="help-block text-danger"></p>
            </div>



        </div>
        <div class="col-md-6">
            <div class="form-group">
                <textarea class="form-control" placeholder="Your Message *" name="visitor_message" id="message" required data-validation-required-message="Please enter a message."></textarea>
                <p class="help-block text-danger"></p>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-lg-12 text-center">
            <div id="success"></div>
            <button type="submit" class="btn btn-xl">Send Message</button>
        </div>
    </div>
</form>
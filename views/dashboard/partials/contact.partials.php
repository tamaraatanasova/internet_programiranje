<section id="contact" class="py-5">
    <div class="container">
        <h2 class="section-title">Контакт</h2>
        <p class="text-center">Доколку имате прашања, слободно контактирајте не преку формуларот подолу.</p>
        <form action="/sendEmail" method="POST" class="mx-auto" style="max-width: 600px;">
            <div class="mb-3">
                <label for="name" class="form-label">Вашето име</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Вашиот email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Вашата порака</label>
                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
            </div>
            <!-- Add a hidden field with the user's email -->
            <input type="hidden" name="user_email" value="<?php echo htmlspecialchars($user_email); ?>">
            <button type="submit" class="btn btn-primary w-100">Испрати порака</button>
        </form>
    </div>
</section>
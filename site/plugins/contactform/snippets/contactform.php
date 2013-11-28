<?php

$form = new contactform(array(
  'to'       => 'John <john@yourdomain.com>',
  'from'     => 'Contact Form <contact@yourdomain.com>',
  'subject'  => 'New contact form request',
  'goto'     => $page->url() . '/status:thank-you'
));

?>
<section id="contactform">

	<?php if(param('status') == 'thank-you'): ?>

	<h1>Thank you very much for your request</h1>

	<p class="contactform-text">We will get in contact as soon as possible</p>

	<?php else: ?>

	<h1>Get in contact</h1>

	<form class="Form" action="#contactform" method="post">

		<fieldset>

			<?php if($form->isError('send')): ?>
			<div>The email could not be sent. Please try again later.</div>
			<?php elseif($form->isError()): ?>
			<div>The form could not be submitted. Please fill in all fields correctly.</div>
			<?php endif; ?>

			<ol class="Form-fields">

				<li class="Form-item Form-item--stacked<?php if($form->isError('name')) echo ' is-error'; ?>">
					<label for="contactform-name" class="Form-label">Name</label>
					<input type="text" rel="persist" id="contactform-name" name="name" class="Form-input<?php if($form->isError('name')) echo ' is-error'; ?>" value="<?php echo $form->htmlValue('name'); ?>" autofocus="autofocus" spellcheck="false"/>
					<?php if($form->isError('name')): ?><small class="Form-helperError">Please enter a name</small><?php endif; ?>
				</li>

				<li class="Form-item Form-item--stacked<?php if($form->isError('email')) echo ' is-error'; ?>">
					<label for="contactform-email" class="Form-label">Email address</label>
					<input type="email" id="contactform-email" name="email" class="Form-input<?php if($form->isError('email')) echo ' is-error'; ?>" value="<?php echo $form->htmlValue('email'); ?>" spellcheck="false" />
					<?php if($form->isError('name')): ?><small class="Form-helperError">Please enter a valid email address</small><?php endif; ?>
				</li>

				<li class="Form-item Form-item--stacked<?php if($form->isError('text')) echo ' is-error'; ?>">
					<label for="contactform-text" class="Form-label">Text</label>
					<?php if($form->isError('name')): ?><small class="Form-helperError">Please enter your message</small><?php endif; ?>
					<textarea id="contactform-text" name="text" class="Form-input Form-input--full<?php if($form->isError('text')) echo ' is-error'; ?>" rows="6" cols="26" spellcheck="true"><?php echo $form->htmlValue('text'); ?></textarea>
				</li>

			</ol>

			<input type="submit" name="submit" class="Button" value="Send" />

		</fieldset>

	</form>

<?php endif; ?>

</section>

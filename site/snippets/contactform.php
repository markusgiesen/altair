<?php ///////////////////////////////////////////////////////
// ----------------------------------------------------------
// SNIPPET
// ----------------------------------------------------------
/////////////////////////////////////////////////////////////

$form = new contactform(array(
	'to'       => $page->contact_to(),
	'from'     => $page->contact_from(),
	'subject'  => smartypants($page->contact_subject()),
	'goto'     => $page->url() . '/status:thank-you'
));

/////////////////////////////////////////////////////////////
?>

<form action="#contactform" method="post" id="contactform" class="Form">

	<fieldset>

		<?php if(param('status') == 'thank-you'): ?>
			<script>
				push_message.push({status: 'succes', type: 'bar', text: 'Voila, your message is succesfully send! You will hear from us soon.'<?php if($_SESSION['isDesktop']){ echo ' , timeout: 6000';} ?>});
			</script>
			<noscript>
				<div class="Alert Alert--inline Alert--succes">
					<div class="Alert-message">
						<p>Voila, your message is succesfully send! You will hear from us soon.</p>
					</div>
					<button type="button" class="Alert-close" data-dismiss="Alert" aria-hidden="true" role="presentation">&times;</button>
				</div>
			</noscript>
		<?php endif; ?>

		<?php if($form->isError('send')): ?>
			<script>
				push_message.push({status: 'error', type: 'bar', text: 'The email could not be sent. Please try again later.'});
			</script>
			<noscript>
				<div class="Alert Alert--inline Alert--warning js-dismissable">
					<div class="Alert-message">
						<p>The email could not be sent. Please try again later.</p>
					</div>
					<button type="button" class="Alert-close" data-dismiss="Alert" aria-hidden="true" role="presentation">&times;</button>
				</div>
			</noscript>
		<?php elseif($form->isError()): ?>
			<script>
				push_message.push({status: 'error', type: 'bar', text: 'The form could not be submitted. Please fill in all fields correctly.'});
			</script>
			<noscript>
				<div class="Alert Alert--inline Alert--error js-dismissable">
					<div class="Alert-message">
						<p>The form could not be submitted. Please fill in all fields correctly.</p>
					</div>
					<button type="button" class="Alert-close" data-dismiss="Alert" aria-hidden="true" role="presentation">&times;</button>
				</div>
			</noscript>
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

			<li class="Form-item Form-item--stacked">
				<label for="contactform-subject" class="Form-label">Subject</label>
				<input type="text" id="contactform-subject" name="subject" class="Form-input" value="<?php echo $form->htmlValue('subject'); ?>" />
			</li>

			<li class="Form-item Form-item--stacked<?php if($form->isError('text')) echo ' is-error'; ?>">
				<label for="contactform-text" class="Form-label">Message</label>
				<?php if($form->isError('name')): ?><small class="Form-helperError">Please enter your message</small><?php endif; ?>
				<textarea id="contactform-text" name="text" class="Form-input Form-input--full<?php if($form->isError('text')) echo ' is-error'; ?>" rows="8" cols="26" spellcheck="true"><?php echo $form->htmlValue('text'); ?></textarea>
			</li>

		</ol>

	</fieldset>

	<input type="submit" name="submit" value="Send request" class="Button Button--primary" />

</form>

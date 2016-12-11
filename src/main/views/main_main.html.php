Hello from PHP template system.

<?php $user = _make('user'); ?>

<?php if ($user->isAnonymous()) { ?>
You are not logged in.
<?php } ?>

<?php if (!$user->isAnonymous()) { ?>
You are logged in.
<?php } ?>

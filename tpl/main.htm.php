<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="?">
		<img src="creender-top.png" height="30" alt="">
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav">
			<li class="nav-item active">
				<a class="nav-link" href="?">Home</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="?action=statistics">Statistiche</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="?action=logout">Logout</a>
			</li>
		</ul>
	</div>
</nav>

<div id="content">
    <?php

    if ($_SESSION['message']) {
        ?>
            <div class="alert alert-<?php echo $_SESSION['message_kind']; ?>" role="alert">
                <?php echo $_SESSION['message']; ?>
            </div>
        <?php
    }

    ?>
	<?php echo $Content; ?>
</div>
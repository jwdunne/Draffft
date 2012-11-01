    <?php require_once $public->render('meta'); ?>
		<?=$application->stylesheet();?>
		<?=$public->jscript($uri->create_uri('plugins', 'texteditors', 'souleedit', 'sf-edit.js'));?>
		<script>
		$(d).ready(function() {
			$('textarea').sfedit({
				ajaxURL: 		'campr/ajax/thread_post_preview',
				hasForm:		false,
				hideOrShow:		'show',
				bgColorOrClass:	'sf-edit-uiux3-style'
			}).scmf_scroll({height: '250px'});
		});
		</script>
		</head>
	<body>
	<?php require_once $public->render('header'); ?>
	<div class="draffft-title-wrapper">
			<div class="draffft-title-container">
				<h1>Authoring a new post</h1>
				<p></p>
			</div>
			<div class="shadow"></div>
		</div>
		<div class="page-wrapper">
			<div class="page-container">
				<form action="<?=$uri->create_uri('draffft', 'new')?>" method="post">
					<div class="table">
						<div class="tr">
							<div class="td">
								<label for="title">Title</label>
							</div>
						</div>
						<div class="tr">
							<div class="td">
								<input type="text" id="title" name="title" class="txt_input"/>
							</div>
						</div>
						<div class="tr">
							<div class="td">
								<label for="desc">Description</label>
							</div>
						</div>
						<div class="tr">
							<div class="td">
								<input type="text" id="desc" name="desc" class="txt_input"/>
							</div>
						</div>
						<div class="tr">
							<div class="td">
								<label for="cat">Category</label>
							</div>
						</div>
						<div class="tr">
							<div class="td">
								<input type="text" id="cat" name="cat" class="txt_input"/>
							</div>
						</div>
						<div class="tr">
							<div class="td">
								<label for="body">Body</label>
							</div>
						</div>
						<div class="tr">
							<div class="td">
								<textarea id="body" name="body"></textarea>
							</div>
						</div>
						<div class="tr">
							<div class="td">
								<input type="hidden" name="action" value="new_article" />
								<input type="submit" class="sf-uix-button color-android" style="margin-top:5px;" />
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	<?php require_once $public->render('footer');
<?php
	require_once(__DIR__."./header.view.php");

	if ( !isset( $_SESSION['user']['id'] ) )
		header("Location: home")
?>


<div class='text-right'>
	<!-- Show or not DeleteAll button -->
	<?php if ( isset($pageData['selected']) && count( $pageData['selected'] ) > 0 ):?>

		<form action="dataDelAll" method="post" class='dellAllForm'>
			<button class="btn red accent-2 btnDellAll"  type="submit">Удалить Всё</button>
		</form>

	<?php endif;?>

</div>

<div class='clearfix'></div>

<!-- [ Contacts data output ] -->
	<div class='text-center'>
		<ul class='text-center contactsWrapper'>
			<?php if ( isset($pageData['selected']) ):?>
				<?php foreach ($pageData['selected'] as $key=>$val):?>

					<li  class=item_Form_Wrap text-center'>

						<form  class="itemForm" method="POST" action='dataDelete'>

							<input type="hidden" name="delContact_id" value=<?=$val['id']?>>

							<div class="form-group">
								<input id="<?= 'item_email '.$key?>" class='item_email'  type="text" value="<?=$val['email']?>"  >
							</div>

							<button class="btn btn-danger" type="submit" name="photoDel" formaction="dataDelete" >Удалить</button>
						</form>

					</li>
				<?php endforeach; ?>
			<?php endif;?>
		</ul>
	</div>

<!-- [ Pagination ] -->

	<?php if($pageData['total'] > $pageData['perPage']):?>

		<div class="container pagination text-center">
			<ul class="pagination ">

					<li><?php echo $pageData['nextArow']; ?></li>

					<li><?= $pageData['refStart']?></li>
					<li><a>...</a></li>

					<?php echo $pageData['num']; ?>

					<li><a>...</a></li>
					<li><?= $pageData['refEnd']?></li>

					<li><?php echo $pageData['prevArow']; ?></li>
			</ul>
		</div>

		<script>
			if(document.querySelector('.pagination'))
				{

					var str    = window.location.search;
					var liPage = document.querySelectorAll('.pagination li a');

					liPage.forEach( function(el, index)
						{
							if( el.href.indexOf(str) != -1 && str)
								{
									if(index === 0)
										{
											liPage[2].parentNode.classList.add("active")
										}
									else if(index === liPage.length - 1)
										{
											liPage[liPage.length - 3].parentNode.classList.add("active")
										}
									else
										{
											el.parentNode.classList.add("active");
										}

								}

							if(!str || str.indexOf('page') === -1)
								{
									if(index === 2 )
										{
											el.parentNode.classList.add("active");

										}
								}
						});

				}
		</script>
	<?php endif;?>





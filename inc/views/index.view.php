<?php
	require_once(__DIR__."./header.view.php");
?>


<?php if ( !isset( $_SESSION['user']['id'] ) ):?>

	<form  class="loginForm text-center" method="POST" action = 'signin'>

		<?php  !isset( $_GET['erNotcorrect'] )?:
			print_r('<br/><label  class="alert alert-danger">'.htmlspecialchars( $_GET['erNotcorrect'] ).'</label>');
		?>

		<br/>
		<div class="form-group">
			<label for="email">Эл.Почта</label>
			<input id="email" type="text" placeholder="Email" name="email" class='form-control' value="<?= isset($_GET['email']) ? $_GET['email'] : '' ?>" >
		</div>

		<?php  !isset( $_GET['erEmail'] )?:
			print_r('<label  class="alert alert-danger">'.htmlspecialchars( $_GET['erEmail'] ).'</label><br/>');
		?>

		<div class="form-group">
			<label for="pass">Пароль</label>
			<input id="pass" type="password" placeholder="Введите Пароль" name="pass"  class='form-control'>
		</div>

		<?php  !isset( $_GET['erPass'] )?:
			print_r('<label  class="alert alert-danger">'.htmlspecialchars( $_GET['erPass'] ).'</label><br/>');
		?>

		<button class="singin btn btn-success" type="submit" name="singin">Войти</button>

		<a href="registration" class='btn btn-primary' style='color:white'>Зарегистрироваться</a>
		<br>

	</form>
<?php endif;?>

<?php if ( isset( $_SESSION['user']['id'] ) ):?>
	<!-- error || success messages -->
	<?php if (  isset( $_GET['err'] )  ):?>

		<div class="msgError">
			<script>
				M.toast({html: '<?= $_GET['err']?>',  classes: 'red accent-2'})
			</script>
		</div>


		<?php elseif (  isset( $_GET['msgSuccesss'] )  ):?>

		<div class="msgSuccesss">
			<script>
				M.toast({html: '<?= $_GET['msgSuccesss']?>', classes: 'cyan  accent-4'})
			</script>
		</div>

	<?php endif;?>

	<!-- [ Users data output ] -->
		<div class='text-center'>
			<ul class='text-center contactsWrapper'>
				<?php if ( isset($pageData['selected']) ):?>
					<?php foreach ($pageData['selected'] as $key=>$val):?>

						<li  class='item_Form_Wrap text-center'>

							<form  class="itemForm" method="POST" action='addContact'>

								<input type="hidden" name="contact_id" value=<?=$val['id']?>>

								<div class="form-group">
									<input id="<?= 'item_email '.$key?>" class='item_email'  type="text" value="<?=$val['email']?>"  >
								</div>

								<button class="btn btn-success"type="submit" name="add"  >Добавить контакт</button>

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
		<?php endif;?>
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



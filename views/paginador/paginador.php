


<?php if(isset($this->_paginacion)): ?>

	<div class="row">
		<div class="col-lg-12  col-md-12  col-sm-12 col-xs-3">
			<div class="paginadores">


					<ul class="pagination pagination-sm" >
						<?php if($this->_paginacion['primero']): ?>

							<li><a href="<?php echo $link . $this->_paginacion['primero']; ?> "><span class="glyphicon glyphicon-fast-backward"></span></a></li>

						<?php else: ?>

							<li class="disabled"> <span class="glyphicon glyphicon-fast-backward"></span> </li>

						<?php endif; ?>

						<?php if($this->_paginacion['anterior']): ?>

							<li><a href="<?php echo $link . $this->_paginacion['anterior']; ?>"><span class="glyphicon glyphicon-step-backward"></span></a></li>

						<?php else: ?>

							<li class="disabled"> <span class="glyphicon glyphicon-step-backward"></span></li>

						<?php endif; ?>

						<?php for($i = 0; $i < count($this->_paginacion['rango']); $i++): ?>

							<?php if($this->_paginacion['actual'] == $this->_paginacion['rango'][$i]): ?>

								<li class="active"><span><?php echo $this->_paginacion['rango'][$i]; ?></span></li>

							<?php else: ?>

								<li>
									<a href="<?php echo $link . $this->_paginacion['rango'][$i]; ?>">
										<?php echo $this->_paginacion['rango'][$i]; ?>
									</a>
								</li>

							<?php endif; ?>

						<?php endfor; ?>

						<?php if($this->_paginacion['siguiente']): ?>

							<li><a href="<?php echo $link . $this->_paginacion['siguiente']; ?>"><span class="glyphicon glyphicon-step-forward"></span></a></li>

						<?php else: ?>

							<li class="disabled"><span class="glyphicon glyphicon-step-forward"></span></li>

						<?php endif; ?>

						<?php if($this->_paginacion['ultimo']): ?>

							<li><a href="<?php echo $link . $this->_paginacion['ultimo']; ?>"><span class="glyphicon glyphicon-fast-forward"></span></a></li>

						<?php else: ?>

							<li class="disabled"><span><span class="glyphicon glyphicon-fast-forward"></span></span></li>

						<?php endif; ?>
					</ul>
				</div>


		</div>
	</div>
 <?php endif; ?>

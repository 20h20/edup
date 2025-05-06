<section class="cbo-keynumbers">
	<div class="keynumbers-inner cbo-container">
		<div class="keynumbers-list">
			<?php
				if( have_rows('keynumbers_list') ):
				while ( have_rows('keynumbers_list') ) : the_row();
				$number	= get_sub_field('number');
				$content = get_sub_field('content');
			?>
				<div class="list-el">
					<div class="el-inner">
						<div class="inner-content">
							<?php if($number): ?>
								<div class="inner-number cbo-title-1 slide-up">
									<?php echo $number ?>
								</div>
							<?php endif; ?>

							<?php if($content): ?>
								<div class="inner-text cbo-chapo slide-up">
									<?php echo $content ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php
				endwhile;
				endif;
			?>
		</div>
	</div>
</section>
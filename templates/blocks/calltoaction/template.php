<section class="cbo-calltoaction">
	<div class="calltoaction-inner cbo-container container--padding container--nomargin">
		<div class="calltoaction-list">
			<?php
				if( have_rows('calltoaction_list') ):
				while ( have_rows('calltoaction_list') ) : the_row();
				$title	= get_sub_field('title');
				$content = get_sub_field('content');
				$bturl = get_sub_field('bturl');
			?>
				<div class="list-el">
					<a class="el-inner slide-up" href="<?php echo $bturl ?>">
						<span class="inner-content">
							<span class="inner-title cbo-title-3">
								<?php echo $title ?>
							</span>
							<span class="inner-text">
								<?php echo $content ?>
							</span>
						</span>
						<i class="icon icon--arrow-next"></i>
					</a>
				</div>
			<?php
				endwhile;
				endif;
			?>
		</div>
	</div>
</section>
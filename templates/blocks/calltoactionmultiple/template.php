<?php
	$maintitle	= get_field('calltoactionmultiple_title');
?>
<section class="cbo-calltoactionmultiple">
	<div class="calltoactionmultiple-inner cbo-container container--padding container--nomargin">

		<div class="calltoactionmultiple-box">
			<?php if($maintitle): ?>
				<div class="calltoactionmultiple-title cbo-title-2 slide-up" itemprop="headline">
					<?php echo $maintitle ?>
				</div>
			<?php endif; ?>

			<div class="calltoactionmultiple-list">
				<?php
					if( have_rows('calltoactionmultiple_list') ):
					while ( have_rows('calltoactionmultiple_list') ) : the_row();
					$title	= get_sub_field('title');
					$content = get_sub_field('content');
					$bturl = get_sub_field('bturl');
				?>
					<div class="list-el">
						<a class="el-inner slide-up" href="<?php echo $bturl ?>">
							<span class="inner-title cbo-title-3">
								<?php echo $title ?>
								<i class="icon icon--arrow-next"></i>
							</span>
							<span class="inner-text">
								<?php echo $content ?>
							</span>
						</a>
					</div>
				<?php
					endwhile;
					endif;
				?>
			</div>
		</div>
	</div>
</section>
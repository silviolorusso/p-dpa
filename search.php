<?php get_header(); ?>
			<div id="content">
				<div id="inner-content" class="wrap clearfix">
					<div id="main" class="clearfix main-index" role="main">
						<h5 class="mini-title">Search: <?php echo esc_attr(get_search_query()); ?></h5>
						<?php if ( $wp_query->have_posts() ) : ?>
						<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
							<article id="post-<?php the_ID(); ?>" class="fourcol home-article" role="article">
								<a href="<?php echo the_permalink();?>">
									<table class="table">
										<tbody>
											<tr>
												<td><h3>Title</h3></td>
												<td><h3><?php the_title(); ?></h3></td>
											</tr>
											<?php
											$first_image = catch_that_image();
											if ($first_image != '') { ?>
											<tr>
												<td colspan="2" class="img">
													<img src="<?php echo $first_image;?>" alt="<?php the_title(); ?>" />
												</td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								</a>
							</article>
						<?php endwhile; ?>						
						<?php else:  ?>
						  <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
						<?php endif; ?>
					</div>
					<nav class="page-navigation">
					<?php
					$big = 999999999; // need an unlikely integer
					 echo paginate_links( array(
					    'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
					    'current' => max( 1, get_query_var('paged') ),
					    'prev_text'    => __('« Previous'),
					    'next_text'    => __('Next »'),
					    'total' => $wp_query->max_num_pages
					) );
					?>
					<?php wp_reset_query(); ?>
					</nav>
				</div>
			</div>
<?php get_footer(); ?>
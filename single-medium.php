<?php get_header(); ?>
			<div id="content">
				<div id="inner-content" class="wrap clearfix">
					<div id="main" class="clearfix main-index" role="main">
						<h5 class="mini-title">Medium: <?php the_title(); ?></h5>
						<?php
						require_once'wp-content/themes/p-dpa/rdfa/lib/arc2/ARC2.php';
						include_once('wp-content/themes/p-dpa/rdfa/connect_to_store.php');
						$query = '
							'.my_vocabs_query().'
							SELECT distinct ?url ?id
							WHERE	{
								?url dcterms:medium <'.get_permalink().'> .
								?url dcterms:identifier ?id .
							}
						';
						$result = $store->query($query, 'rows');
						$ids = array();
						foreach ($result as $row) {
							array_push($ids, $row['id']);
						}
						$args = array('post_type' => 'work', 'paged' => $paged, 'post__in' => $ids );
						$the_query = new WP_Query( $args ); 
						?>
						<?php if ( $the_query->have_posts() ) : ?>
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							<article id="post-<?php the_ID(); ?>" class="fourcol home-article" role="article">
								<a href="<?php echo the_permalink();?>">
									<table class="table">
										<tbody>
											<tr>
												<td><p>Title</p></td>
												<td><h3><?php the_title(); ?></h3></td>
											</tr>
											<tr>
												<td><h3>Author</h3></td>
												<?php
												// All Authors					
												$query = '
													'.my_vocabs_query().'
													SELECT distinct ?url ?name 
													WHERE	{
														<'.get_permalink().'> dcterms:creator ?url .
														?url foaf:name ?name
													}
												';
												$result = $store->query($query, 'rows'); ?>
												<td>
												<?php
												if (!empty($result)) {
													echo '<h3>';
													$names = array();
													foreach ($result as $row) {
														array_push($names, $row['name']);
													}
													echo implode(', ', $names);
												} ?>
												</td>
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
					    'total' => $the_query->max_num_pages
					) );
					?>
					<?php wp_reset_query(); ?>
					</nav>
				</div>
			</div>
<?php get_footer(); ?>
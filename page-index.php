<?php
/*
Template Name: Index
*/
?>

<?php get_header(); ?>
			<div id="content">
				<div id="inner-content" class="wrap clearfix">
						<div id="main" class="twelvecol first clearfix" role="main">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
								<header class="article-header">
									<h5 class="mini-title"><?php the_title(); ?></h5>
								</header>
								<section class="entry-content clearfix" itemprop="articleBody">
									<div class="twocol first clearfix">
									<?php
										require_once'wp-content/themes/p-dpa/rdfa/lib/arc2/ARC2.php';
										include_once('wp-content/themes/p-dpa/rdfa/connect_to_store.php');
										// All Artists						
										$query = '
											'.my_vocabs_query().'
											SELECT ?url ?name 
											WHERE	{
												?url foaf:name ?name
											}
											ORDER BY ?name
										';
										$result = $store->query($query, 'rows');
										if (!empty($result)) : ?>
										<table class="table">
											<tbody>
												<tr>
													<td><h3>Authors</h3></td>
												</tr>
												<?php foreach ($result as $row) : ?>
												<tr>
													<td>
														<p><a href="<?php echo $row['url'] ?>"><?php echo $row['name'] ?></span></p></a>
													</td>
												</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
										<?php endif; ?>
									</div>
									<div class="twocol clearfix">
									<?php				
										// All Works						
										$query = '
											'.my_vocabs_query().'
											SELECT ?url ?title 
											WHERE	{
												?url <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> dcterms:MediaType .
												?url dcterms:title ?title
											}
											ORDER BY ?title
										';
										$result = $store->query($query, 'rows');
										if (!empty($result)) : ?>
										<table class="table">
											<tbody>
												<tr>
													<td><h3>Works</h3></td>
												</tr>
												<?php foreach ($result as $row) : ?>
												<tr>
													<td>
														<p><a href="<?php echo $row['url'] ?>"><?php echo $row['title'] ?></span></p></a>
													</td>
												</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
										<?php endif; ?>
									</div>
									<div class="twocol clearfix">
									<?php				
										// All Media						
										$query = '
											'.my_vocabs_query().'
											SELECT DISTINCT ?url2 ?name 
											WHERE	{
												?url dcterms:medium ?url2 .
												?url2 dcterms:title ?name .
											}
											ORDER BY ?name
										';
										$result = $store->query($query, 'rows');
										if (!empty($result)) : ?>
										<table class="table">
											<tbody>
												<tr>
													<td><h3>Media</h3></td>
												</tr>
												<?php foreach ($result as $row) : ?>
												<tr>
													<td>
														<p><a href="<?php echo $row['url2'] ?>"><?php echo $row['name'] ?></span></p></a>
													</td>
												</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
										<?php endif; ?>
									</div>
									<div class="twocol clearfix">
									<?php				
										// All Technologies						
										$query = '
											'.my_vocabs_query().'
											SELECT DISTINCT ?url2 ?name 
											WHERE	{
												?url pdpa:technology ?url2 .
												?url2 dcterms:title ?name .
											}
											ORDER BY ?name
										';
										$result = $store->query($query, 'rows');
										if (!empty($result)) : ?>
										<table class="table">
											<tbody>
												<tr>
													<td><h3>Technologies</h3></td>
												</tr>
												<?php foreach ($result as $row) : ?>
												<tr>
													<td>
														<p><a href="<?php echo $row['url2'] ?>"><?php echo $row['name'] ?></span></p></a>
													</td>
												</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
										<?php endif; ?>
									</div>
									<div class="twocol clearfix">
									<?php				
										// All Platforms						
										$query = '
											'.my_vocabs_query().'
											SELECT DISTINCT ?url2 ?name 
											WHERE	{
												?url pdpa:platform ?url2 .
												?url2 dcterms:title ?name .
											}
										';
										$result = $store->query($query, 'rows');
										if (!empty($result)) : ?>
										<table class="table">
											<tbody>
												<tr>
													<td><h3>Platforms</h3></td>
												</tr>
												<?php foreach ($result as $row) : ?>
												<tr>
													<td>
														<p><a href="<?php echo $row['url2'] ?>"><?php echo $row['name'] ?></span></p></a>
													</td>
												</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
										<?php endif; ?>
									</div>
									<div class="twocol clearfix">
										<table class="table">
											<tbody>
												<tr>
													<td><h3>Keywords</h3></td>
												</tr>
												<?php 
												$args = array(
													'format' 		=> 'array',
													'smallest'		=> 1, 
												    'largest'		=> 1,
												    'unit'			=> 'em',
												); 
												$the_tags = wp_tag_cloud( $args );
												foreach ($the_tags as $tag) {
													echo '<tr><td><p>'.$tag.'</p></td></tr>';
												}?>
												</tr>
											</tbody>
										</table>
									</div>
								</section>
								<footer class="article-footer">
									<p class="clearfix"><?php the_tags( '<span class="tags">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '' ); ?></p>
								</footer>
								<?php comments_template(); ?>
							</article>
							<?php endwhile; else : ?>
									<article id="post-not-found" class="hentry clearfix">
											<header class="article-header">
												<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
											<section class="entry-content">
												<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the page-custom.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>
							<?php endif; ?>
						</div>
				</div>
			</div>
<?php get_footer(); ?>
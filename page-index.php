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
											PREFIX foaf: <http://xmlns.com/foaf/0.1/>
											SELECT distinct ?url ?name 
											WHERE	{
												?url foaf:name ?name
											}
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
														<h3><a href="<?php echo $row['url'] ?>"><?php echo $row['name'] ?></span></h3></a>
													</td>
												</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
										<?php endif; ?>
									</div>
									<div class="twocol clearfix">
									<?php
										require_once'wp-content/themes/p-dpa/rdfa/lib/arc2/ARC2.php';
										include_once('wp-content/themes/p-dpa/rdfa/connect_to_store.php');					
										// All Works						
										$query = '
											PREFIX dcterms: <http://purl.org/dc/terms/>
											SELECT distinct ?url ?title 
											WHERE	{
												?url <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> dcterms:MediaType .
												?url dcterms:title ?title
											}
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
														<h3><a href="<?php echo $row['url'] ?>"><?php echo $row['title'] ?></span></h3></a>
													</td>
												</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
										<?php endif; ?>
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
<?php get_header(); ?>
			<div id="content">
				<div id="inner-content" class="wrap clearfix">
					<div id="main" class="eightcol first clearfix" role="main">
						<h5 class="mini-title">Author</h5>
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
								<section id="metadata" class="entry-content clearfix" prefix="<?php my_vocabs(); ?>" about="<?php the_permalink(); ?>" typeof="foaf:Person">
									<table class="table">
										<tbody>
											<tr>
												<td><h3>Who</p></td>
												<td><h3 property="foaf:name"><?php the_title(); ?></h3></td>
											</tr>
											<tr>
												<td><p>Bio</p></td>
												<td><p property="foaf:bio"><?php the_content(); ?></p></td>
											</tr>
										</tbody>
									</table>
									<span property="dcterms:identifier" content="<?php the_ID(); ?>"></span>
								</section>
								<footer class="article-footer">
									<?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>
								</footer>
								<?php comments_template(); ?>
							</article>
						<?php endwhile; ?>
						<?php else : ?>
							<article id="post-not-found" class="hentry clearfix">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( 'This is the error message in the single.php template.', 'bonestheme' ); ?></p>
									</footer>
							</article>
						<?php endif; ?>
					</div>
					<div class="sidebar fourcol last">
					<?php
					require_once'wp-content/themes/p-dpa/rdfa/lib/arc2/ARC2.php';
					include_once('wp-content/themes/p-dpa/rdfa/connect_to_store.php');
					// Related works				
					$query = '
						PREFIX dcterms: <http://purl.org/dc/terms/>
						SELECT distinct ?url ?title ?date
						WHERE	{
							?url dcterms:creator <'.get_permalink().'> .
							?url dcterms:title ?title .
							?url dcterms:date ?date .
						}
					';
					$result = $store->query($query, 'rows');
					if (!empty($result)) : ?>
						<h5>By <?php the_title(); ?></h5>
						<?php foreach ($result as $row) : ?>
							<a href="<?php echo $row['url'] ?>">
								<table class="table">
									<tbody>
										<tr>
											<td><p>Title</p></td>
											<td><p><?php echo $row['title'] ?></p></td>
										</tr>
										<tr>
											<td><p>Date</p></td>
											<td><p><?php echo $row['date'] ?></p></td>
										</tr>
									</tbody>
								</table>
							</a>
						<?php endforeach; ?>						
					<?php endif; ?>
					</div>
				</div>
			</div>
<?php get_footer(); ?>
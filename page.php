<?php get_header(); ?>
			<div id="content">
				<div id="inner-content" class="wrap clearfix">
					<div id="main" class="eightcol first clearfix" role="main">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
							<header class="article-header">
								<table class="table">
									<tbody>
										<tr>
											<td><h3>Title</h3></td>
											<td><h3 class="page-title" itemprop="headline"><?php the_title(); ?></h3></td>
										</tr>
										<tr>
											<td><p>Date</p></td>
											<td>
												<p class="byline vcard"><?php
										printf( __( '<time class="updated" datetime="%1$s" pubdate>%2$s</time>', 'bonestheme' ), get_the_time( 'Y-m-j' ), get_the_time( __( 'F jS, Y', 'bonestheme' ) ));
									?>			</p>
											</td>
										</tr>
									</tbody>
								</table>
							</header>
							<section class="entry-content clearfix" itemprop="articleBody">
								<?php the_content(); ?>
						</section>
							<footer class="article-footer">
								<?php the_tags( '<span class="tags">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '' ); ?>
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
											<p><?php _e( 'This is the error message in the page.php template.', 'bonestheme' ); ?></p>
									</footer>
								</article>
						<?php endif; ?>
					</div>
				</div>
			</div>
<?php get_footer(); ?>
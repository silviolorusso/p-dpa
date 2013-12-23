<?php
/*
Template Name: Index Slow
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="eightcol first clearfix" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="page-title"><?php the_title(); ?></h1>
									<p class="byline vcard"><?php
										printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>.', 'bonestheme' ), get_the_time( 'Y-m-j' ), get_the_time( __( 'F jS, Y', 'bonestheme' ) ), bones_get_the_author_posts_link() );
									?></p>


								</header>

								<section class="entry-content clearfix" itemprop="articleBody">
									
									<?php
									require('rdfa/lib/arc2/ARC2.php');
									
									echo '<h5>All Authors</h5>';
									
/*
									PREFIX foaf: <http://xmlns.com/foaf/0.1/>
									SELECT distinct ?url ?name 
									WHERE {
									    ?url foaf:name ?name.
									}
*/
									$authors=simplexml_load_file("http://localhost:8888/p-dpa/wp/wp-content/themes/p-dpa/rdfa/my_controls/endpoint.php?query=PREFIX+foaf%3A+%3Chttp%3A%2F%2Fxmlns.com%2Ffoaf%2F0.1%2F%3E%0D%0ASELECT+distinct+%3Furl+%3Fname+%0D%0AWHERE+%7B%0D%0A++++%3Furl+foaf%3Aname+%3Fname.%0D%0A%7D&output=xml");				
									foreach ($authors->results->result as $result) {
										$url = $result->binding[0]->uri;
										$name = $result->binding[1]->literal;
										echo "<p><a href=\"".$url."\">".$name."</a></p>";
									}


									echo '<h5>All Works</h5>';									
/*
									PREFIX dcterms: <http://purl.org/dc/terms/>
									SELECT  ?url ?title
									WHERE {
									    ?url ?p dcterms:MediaType .
									    ?url dcterms:title ?title
									}
*/
									$works=simplexml_load_file("http://localhost:8888/p-dpa/wp/wp-content/themes/p-dpa/rdfa/my_controls/endpoint.php?query=PREFIX+dcterms%3A+%3Chttp%3A%2F%2Fpurl.org%2Fdc%2Fterms%2F%3E%0D%0ASELECT++%3Furl+%3Ftitle%0D%0AWHERE+%7B%0D%0A++++%3Furl+%3Fp+dcterms%3AMediaType+.%0D%0A++++%3Furl+dcterms%3Atitle+%3Ftitle%0D%0A%7D&output=xml");
									foreach ($works->results->result as $result) {
										$url = $result->binding[0]->uri;
										$title = $result->binding[1]->literal;
										echo "<p><a href=\"".$url."\">".$title."</a></p>";
									}
									?>
									
									<?php the_content(); ?>
									
									
									
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

						<?php get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>

<?php get_header(); ?>
			
			<!-- featured panels -->
<div id="featured" class="clearfix row-fluid">	
    		<?php
// Get IDs of sticky posts
$sticky = get_option('sticky_posts');
// first loop to display only my single, 
// MOST RECENT sticky post
$most_recent_sticky_post = new WP_Query( array( 
    // Only sticky posts
    'post__in' => $sticky, 
    // Treat them as sticky posts
    'ignore_sticky_posts' => 0, 
    // Order by ID
    'orderby' => ID, 
    // Get only the one most recent
    'showposts' => 3
) );
while ( $most_recent_sticky_post->have_posts() ) : $most_recent_sticky_post->the_post(); ?>

		<div class="span4">
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('wpbs-featured'); ?></a>	
			<h3><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
<?php the_excerpt(); ?>
		</div>
<?php endwhile; wp_reset_query(); ?>
</div>
<!-- end featured panels -->

<!-- main content -->

<div id="content" class="clearfix row-fluid">
			
				<div id="main" class="span8 clearfix" role="main">

<?php query_posts(array("post__not_in" =>get_option("sticky_posts"), 'paged' => get_query_var('paged'))); ?>	
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
		
		
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						
						<header>
						
							<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'wpbs-featured' ); ?></a>
							
							<div class="page-header"><h1 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1></div>
							
							<p class="meta"><?php _e("Posted", "bonestheme"); ?> <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_date(); ?></time> <?php _e("by", "bonestheme"); ?> <?php the_author_posts_link(); ?> <span class="amp">&</span> <?php _e("filed under", "bonestheme"); ?> <?php the_category(', '); ?>.</p>
						
						</header> <!-- end article header -->
					
						<section class="post_content clearfix">
							<?php the_content( __("Read more &raquo;","bonestheme") ); ?>
						</section> <!-- end article section -->
						
						<footer>
			
							<p class="tags"><?php the_tags('<span class="tags-title">' . __("Tags","bonestheme") . ':</span> ', ' ', ''); ?></p>
							
						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
					
					<?php comments_template(); ?>		
		<?php endwhile; ?>
		
		<?php if (function_exists('page_navi')) { // if expirimental feature is active ?>
						
						<?php page_navi(); // use the page navi function ?>
						
					<?php } else { // if it is disabled, display regular wp prev & next links ?>
						<nav class="wp-prev-next">
							<ul class="clearfix">
								<li class="prev-link"><?php next_posts_link(_e('&laquo; Older Entries', "bonestheme")) ?></li>
								<li class="next-link"><?php previous_posts_link(_e('Newer Entries &raquo;', "bonestheme")) ?></li>
							</ul>
						</nav>
					<?php } ?>		
					
					<?php else : ?>
					
					<article id="post-not-found">
					    <header>
					    	<h1><?php _e("Not Found", "bonestheme"); ?></h1>
					    </header>
					    <section class="post_content">
					    	<p><?php _e("Sorry, but the requested resource was not found on this site.", "bonestheme"); ?></p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
	
</div> <!-- end #main -->
    
				<?php get_sidebar(); // sidebar 1 ?>
    
			</div> <!-- end #content -->

<?php get_footer(); ?>

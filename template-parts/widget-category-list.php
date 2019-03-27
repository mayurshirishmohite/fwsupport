			<!--******************************* Lists *******************************-->
				<div class="pt-20">
					<div class="widget widget_categories">
						<span class="icon icon-folder"></span>
						<h4>Tutorial Categories</h4>
							<?php
							global $this_category;
							$categories = get_categories(array(
								'child_of' => $this_category->term_id,
								'taxonomy' => 'category'
							));
							if ($categories):
							?>
							<ul>
								<?php foreach($categories as $value): ?>
									<li><a href="https://feed.mikle.com/support/category/<?php echo $value->slug; ?>"><?= esc_html($value->name) ?></a></li>
								<?php endforeach; ?>
							</ul>
							<?php endif; // $categories ?>
					</div>
				</div>

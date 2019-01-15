		<div id="sticky-anchor"></div>
<section class="navigation-area" id="navigation-area">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<nav class="navbar custom_navbar" role="navigation">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header">
								<button class="navbar-toggle" data-toggle="collapse" data-target="#navbarCollapse" type="button">
									<span class="sr-only">Toggle navigation</span>
									
									<i class="fa fa-bars">  Menu</i>
								</button>
							</div>
							<!-- Collection of nav links and other content for toggling -->
							<div class="collapse navbar-collapse" id="navbarCollapse">
						<?php

						if (function_exists('wp_nav_menu')) {

							wp_nav_menu(array('theme_location' => 'wpj-main-menu', 'menu_class' => 'nav navbar-nav', 'fallback_cb' => 'wpj_default_menu'));

						}

						else {

							wpj_default_menu();

						}

						?>
							</div>
						</nav>
					</div>
				</div>
			</div>
		</section>
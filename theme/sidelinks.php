<!-- Necessary markup, do not remove -->
		<div id="mws-sidebar-stitch"></div>
		<div id="mws-sidebar-bg"></div>
        
        <!-- Sidebar Wrapper -->
        <div id="mws-sidebar">
        
        	<!-- Searchbox -->
        	<!--
        	<div id="mws-searchbox" class="mws-inset">
            	<form action="typography.html">
                	<input type="text" class="mws-search-input" />
                    <input type="submit" class="mws-search-submit" />
                </form>
            </div>
            -->
            
            <!-- Main Navigation -->
            <div id="mws-navigation">
            	<ul>
                	<li><a href="index.php" class="mws-i-24 i-home">Dashboard</a></li>
                	<li>
                    	<a href="#" class="mws-i-24 i-list">{appName}</a>
                        <ul>
                        {appLinks}
                        	<li><a href="editPage.php?id={pageID}">{pageTitle}</a></li>
                        {/appLinks}
                        </ul>
                    </li>
                    
                	<li><a href="stats.php" class="mws-i-24 i-chart">Statistics</a></li>
                	<li class="active"><a href="send.php" class="mws-i-24 i-day-calendar">Push Notifications</a></li>
                	<li><a href="#" class="mws-i-24 i-cog">Settings</a></li>
                	<li><a href="#" class="mws-i-24 i-text-styling">Support</a></li>
                	<!-- <li><a href="grids.html" class="mws-i-24 i-blocks-images">Grids &amp; Panels</a></li>
                	<li><a href="gallery.html" class="mws-i-24 i-polaroids">Gallery</a></li>
                	<li><a href="error.html" class="mws-i-24 i-alert-2">Error Page</a></li>-->
                	<li>
                    	<a href="logout.php" class="mws-i-24 i-pacman">
                        	Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>